<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\AuthRequest;
use \App\Http\Resources\Api\V1\AuthResource;
use App\Models\User;
use App\Models\TanantUser;
use App\Models\SiteDetails;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Traits\{
    EmailTrait,
    UserTrait
};

class AuthController extends Controller {
    use EmailTrait,UserTrait;

    private $authProxy;

    public function __construct(\App\Http\Proxies\Api\V1\AuthProxy $authProxy) {
        $this->authProxy = $authProxy;
    }

    public function login(AuthRequest $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        
        /* headers detail */
        $tenant_id = $request->header('tenantId');
        $response = $this->authProxy->attemptLogin($email,$password,$tenant_id);
        $response = json_decode(json_encode($response), false);

        return (new AuthResource($response))->setStatusCode($response->status_code);
    }

    public function refresh(Request $request) {
        $refreshToken = $request->get('refresh_token');
        $response = $this->authProxy->attemptRefresh($refreshToken);
        $response = json_decode(json_encode($response), false);
        return (new AuthResource($response))->setStatusCode($response->status_code);
    }

    public function logout() {
        $this->authProxy->logout();
        return $this->response(null, 204);
    }
    public function users() {
        return User::all();
    }

    public function verifyLoginEmail(Request $request){
        $email = $request->input('email');
        $tenants = TanantUser::where('email', $email)->with('tanants')->get();
        if(count($tenants)){
            $response = [];
            foreach ($tenants as $key => $tenant) {
                $response[] = [
                    'tanant_id' => $tenant->tanants->uid,
                    'email' => $tenant->email,
                    'company_name'=>$tenant->tanants->company_name,
                ];
            }
            return Response()->json([
                'status' => true, 
                'message' => 'Email is exist!', 
                'response' => $response
            ], 200);
        }
        return Response()->json(['status' => false, 'message' => 'Sorry! Email is not exist.', 'response' => []], 200);
    }

    public function checkTenantPlanExpire(Request $request){
        $tenantId = $request->header('tenantId');
        $status = true;
        $expired = false;
        $message = '';
        $data = [];
        if($tenantId != 'fleet_admin' && $tenantId){
            // if(!DB::statement('SHOW DATABASES LIKE '.$tenantId)){
            //    return Response()->json(['status' => false, 'message' => 'Sorry! Acount Not Exist.', 'response' => [
            //     'tenant_not_exist' => false
            //    ]], 200);
            // }else{
                $site = SiteDetails::where('tenant_uid', $tenantId)->first();
                $end_date = Carbon::parse($site->valid_till);
                // $now = Carbon::parse('2021-02-12T13:27:09.000000Z');
                $now = Carbon::now();
                $daysDiff = $end_date->diffInDays($now);
                $data = [
                    'tenant_id' => $site->tenant_id,
                    'tenant_uid' => $site->tenant_uid,
                    'plan_valid_date' => $end_date,
                ];
                if($now <= $end_date){
                    if($daysDiff <= 3){
                        $days = $daysDiff > 1 ? $daysDiff.' days' : $daysDiff.' day';
                        $message = $daysDiff > 0 ? 'Your Plan will Expire after '.$days : 'Your Plan will Expire today, please update your plan.';
                        $data['plan_expire_days'] = $daysDiff;                    
                    }else{
                        $data = [];
                    }
                }else{
                    $status = false;
                    $message = 'Your plan has been expired from '.$end_date->toFormattedDateString();
                    $data['plan_due_days'] = $daysDiff;
                    $expired = true;
                }
            // }
        }
        return Response()->json(['status' => $status, 'message' => $message, 'response' => compact('expired', 'data')], 200);
    }

    public function Resetpassword(Request $request) {
        $email = $request->input('email');
        if(User::where('email',$email)->first())
        {
            $otpCode = $this->sendPasswordVerificationOtpmail($email);
            if ($otpCode == 'empty') {
                return Response()->json(['status'=>false, 'message' => 'Something went wrong. Please try again letter.', 'response' => [] ],401);
            }
            return Response()->json(['status'=>true, 'message' => 'We will sent you otp for email verification. Please check you email', 'response' => []],200);
        }
        
        return Response()->json(['status'=>false, 'message' => 'Email is not exist!', 'response' => [] ],401); 
    }

    public function forgotpasswordupdate(Request $request) {
        $email = $request->input('email');
        $user = $this->getUserByEmail($email);
        if($user){
            $request->merge(['type'=>'password']);
            $this->saveUserDetail($request, $user->id);
            return Response()->json(['status'=>true, 'message' => 'Your password is updated successfully!', 'response' => []],200);
        }
        return Response()->json(['status'=>false, 'message' => 'Email is invalid!', 'response' => [] ],401); 
    }

    public function Optverify(Request $request) {
        $email = $request->input('email');
        $storeRules = [
            'email' => 'required|email',
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
        
        return Response()->json(['status'=>true, 'message' => 'OTP verified successfully' ],200);
    }
}