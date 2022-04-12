<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlanInventory;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\SiteDetails;
use Validator, DateTime, Config, Hash, DB, Session, Auth, Redirect, Uuid;
use App\Traits\{
    HelperTrait,
    UserTrait,
    EmailTrait,
    StripeTrait
};
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;

class RegisterController extends Controller {
    use HelperTrait, UserTrait, EmailTrait, StripeTrait;

    private $authProxy;
    private $tenantMgmtRepository;

    public function __construct(
            \App\Http\Proxies\Api\V1\AuthProxy $authProxy,
            \App\Http\Repositories\Api\V1\TenantMgmtRepositoryInterface $tenantMgmtRepository
            ) {
        $this->authProxy = $authProxy;
        $this->tenantMgmtRepository = $tenantMgmtRepository;
    }
    /**
     * Steps to register:
     * - Get email and password. Note: check if verified tenant exists.
     * - Verify token.
     * - Save tenant detail. 
     *   What we've received (email, password, token)?
     * 
     * - If not free ask for payment else no
     * - Then create database and go ahead.
     * 
     * Needs to send request_type == register, login
     * 
     */

    public function registerRequest(Request $request) {
        $email = $request->input('tenant_email');
        $name = $request->input('name');
        $storeRules = [
            'name' => 'required',
            'tenant_email' => 'required|email|unique:tenants_mgmt',
            'password' => 'required|min:6|max:15',
        ];
        
        $validator = Validator::make($request->all(), $storeRules);
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Response()->json(['status'=>false, 'message' => 'The email must be a valid email address.', 'response' => [] ],401);
        }
        
        $otpCode = $this->sendEmailOTP($email,$name);
        if ($otpCode == 'empty') {
            return Response()->json(['status'=>false, 'message' => 'Something went wrong. Please try again letter.', 'response' => [] ],401);
        }
        
        return Response()->json(['status'=>true, 'message' => 'We will sent you otp for email verification. Please check you email. - ' . $otpCode, 'response' => [] ],200);
    }
    
    public function registerComplete(Request $request) {
        $email = $request->input('tenant_email');
        $storeRules = [
            'name' => 'required',
            'tenant_email' => 'required|email|unique:tenants_mgmt',
            'password' => 'required|min:6|max:15',
            'otp_code' => 'required|numeric'
        ];
        
        $validator = Validator::make($request->all(), $storeRules);
        
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }        
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Response()->json(['status'=>false, 'message' => 'The email must be a valid email address.', 'response' => [] ],200);
        }    
        
        $otpVerify = $this->verifyEmailOTP($email, $request->input('otp_code'));
        
        if ($otpVerify == 'emptyOTP' || $otpVerify == 'emptyEmail') {
            return Response()->json(['status'=>false, 'message' => 'Something went wrong. Please try again letter.', 'response' => [] ],401);
        } 
        
        if ($otpVerify == 'otpCodeInvalid') {
            return Response()->json(['status'=>false, 'message' => 'OTP Code invalid.', 'response' => [] ],401);
        }
        
        # Save in Tenant MGMT (management).
        $this->tenantMgmtRepository->addNewTenant($request);
        $user = [
            'email' => $email,
            'name' => $request->get('name')
        ];
        return Response()->json(['status'=>true, 'message' => 'OTP verified successfully, Please complete you site details.', 'response' => compact('user') ],200);
    }
    public function completeSiteDetails(Request $request)
    {
        $storeRules = [
            'name' => 'required',
            'tenant_email' => 'required|email',
            'client_number' => 'required|numeric',
            'company_name' => 'required',
            'fleet_size' => 'required',
            'industry' => 'required',
            'time_zone' => 'required',
            'plan_id' => 'required|numeric',
            'free_trial' => 'required',
            'currency' => 'required',
            'tagline' => 'required'
        ];
        $validator = Validator::make($request->all(), $storeRules);
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }
        $planDetails = PlanInventory::find($request->input('plan_id'));
        if (!$planDetails) {
            return Response()->json(['status'=>false,'message'=>'Requested plan not exist in our system.', 'response'=>[]], 401);
        }
        
        $free_trial = $request->input('free_trial');
        $email = $request->input('tenant_email');
        if(strtolower($free_trial) == 'free'){
            preg_match_all('!\d+!', $planDetails->description, $valid_days);
            $valid_days = isset($valid_days[0][0]) && $valid_days[0][0] ? $valid_days[0][0] : 14; 
            $request->merge(['valid_days' => $valid_days]); 
            $request->merge(['tenant_status' => 4]);
            $tenantData = $this->tenantMgmtRepository->addNewTenant($request);
            $password = $tenantData['password'];
            $uid = $tenantData['uid'];
            $request->merge(['password' => $password]);
            $request->merge(['email' => $email]);
            if(!empty($uid)){
                \Artisan::call('make:tenant',[
                    'user' => $request->all(),
                    'dbname' => $uid
                ]);

                $user = $this->getUserData(NULL, $email, $uid);
                $response = $this->authProxy->attemptLogin($email, $password, $uid);
                
                $access_tokens = $response['data']['access_token'];
                $refresh_token = $response['data']['refresh_token'];
                $tenant_id = $response['data']['tenant_id'];

                return Response()->json(['status'=>true, 'message' => 'Account created successfully.', 'response' => compact('access_tokens','refresh_token','user', 'tenant_id') ],200);
            }
            return Response()->json(['status'=>false, 'message' => 'Something went wrong. Please try again later.', 'response' => [] ],401);

            
        }
        $this->tenantMgmtRepository->addNewTenant($request);
           $user = [
            'email' => $email,
            'name' => $request->get('name')
        ];
        return Response()->json(['status'=>true, 'message' => 'Site details inserted successfully!', 'response' => ['user'=>$user] ],200); 
    }

    public function completeSitePayment(Request $request){
        $rules = [
            'tenant_email' => 'required|email',
            'amount' => 'required|numeric',
            'plan_id' => 'required|numeric',
            'card_number' => 'required',
            'exp_year' => 'required|date_format:Y',
            'exp_month' => 'required|date_format:m',
            'cvv' => 'required|numeric',
            'term_and_condition' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }

        $planInventory = PlanInventory::find($request->input('plan_id'));
        if (!$planInventory) {
            return Response()->json(['status'=>false,'message'=>'Requested plan not exist in our system.', 'response'=>[]], 401);
        }
        $email = $request->get('tenant_email');
        $response = $this->doStripPayment($request);
        if (isset($response['status']) && $response['status'] == true){
            $request->merge(['email' => $email]);
            $request->merge(['transaction_id' => $response['transaction_id']]);
            if($request->get('renew_plan')){
                return $this->updateTenantSitePlan($request);
            }else{
                return $this->createNewTenantSite($request);
            }

        }
        return Response()->json(['status'=>false, 'message' => 'Something went wrong. Please try again later.', 'response' => [] ],401);
    }

    private function createNewTenantSite($request){
        $planInventory = PlanInventory::find($request->input('plan_id'));
        $email = $request->get('tenant_email');
        $request->merge(['valid_days' => date('t')]);
        $request->merge(['is_paid' => 1]);
        $request->merge(['tenant_status' => 4]);
        $tenantData = $this->tenantMgmtRepository->addNewTenant($request);
        $password = $tenantData['password'];
        $uid = $tenantData['uid'];
        $request->merge(['name' => $tenantData['name']]);
        $request->merge(['password' => $password]);

        if($tenantData['id']) {
            $this->saveFleetPayment($request, $tenantData['id']);
        }

        if(!empty($uid)){
            \Artisan::call('make:tenant',[
                'user' => $request->all(),
                'dbname' => $uid
            ]);
        }

        $user = $this->getUserData(NULL, $email, $uid);
        $response = $this->authProxy->attemptLogin($email, $password, $uid);

        $access_tokens = $response['data']['access_token'];
        $refresh_token = $response['data']['refresh_token'];
        $tenant_id = $response['data']['tenant_id'];

        $request->merge(['expiry_date' => $tenantData['valid_till']]);
        $request->merge(['plan_name' => $planInventory['heading']]);
        $this->send_PlanDetails_Email($request->all());
        return Response()->json(['status'=>true, 'message' => 'Account created successfully, Please complete you extra details.', 'response' => compact('access_tokens','refresh_token','user', 'tenant_id') ],200);
    }

    private function updateTenantSitePlan($request){
        $tenantId = $request->header('tenantId');
        $planInventory = PlanInventory::find($request->input('plan_id'));
        $email = $request->get('tenant_email');
        $plan_id = $request->get('plan_id');
        $user = $this->getUserData(NULL, $email, $tenantId);
        $tenantId = $user['company']['tenant_id'];
        $valid_from = $user['company']['valid_till'];
        if($tenantId) {
            $orderCount = Payment::where('tenant_id', $tenantId)->count();
            if($orderCount > 0){
                $request->merge(['valid_till' => $valid_from]);
                $request->merge(['valid_days' => date('t', strtotime($valid_from))]);
            }else{
                $request->merge(['valid_days' => date('t')]);
            }
            $request->merge(['is_paid' => 1]);
            $request->merge(['tenant_status' => 4]);
            $request->merge(['tenant_id' => $tenantId]);
            $tenantData = $this->tenantMgmtRepository->addNewTenant($request);
            $this->saveFleetPayment($request, $tenantId);
            $siteDetail = SiteDetails::where('tenant_id', $tenantId)->first();
            $siteDetail->plan_id = $plan_id;
            $siteDetail->valid_from = $valid_from;
            $siteDetail->valid_till = $tenantData['valid_till'];
            if($siteDetail->save()){
                $permissions = $this->getPlanPermissions($plan_id);
                DB::table('permissions')->truncate();
                Permission::insert($permissions);
            }
        }
        $request->merge(['name' => $tenantData['name']]);
        $request->merge(['password' => $tenantData['password']]);
        $request->merge(['expiry_date' => $tenantData['valid_till']]);
        $request->merge(['plan_name' => $planInventory['heading']]);
        
        $user = $this->getUserData(NULL, $email, $tenantId);

        $this->send_PlanUpdateDetail_Email($request->all());
        return Response()->json(['status'=>true, 'message' => 'Your Plan Updated Successfully!.', 'response' => compact('user') ],200);
    }

}