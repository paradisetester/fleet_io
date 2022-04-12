<?php

namespace App\Http\Controllers\Api\V1;

use Validator, Auth, Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TenantMgmt;
use App\Models\SiteDetails;
use App\Traits\UserTrait;

class ProfileController extends Controller {
    use UserTrait;

    public function loginUserUpdate(Request $request) {
        $user_id = $this->getCurrentUserID();
        $type = $request->get('type');
        switch ($type) {
            case 'company':
                return $this->updateFleetComapnyDetails($request, $user_id);
                break;
            case 'password':
                return $this->updatePassword($request, $user_id);
                break;
        }
        
    }

    private function updateFleetComapnyDetails($request, $user_id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'company_name' => 'required|min:3',
            'mobile' => 'required',
            'fleet_size' => 'required',
            'currency' => 'required',
            'industry' => 'required',
            'time_zone' => 'required',
            'tagline' => 'required|min:3',
        ]);
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }else{
            $tenantId = $request->header('tenantId');
            $user = $this->getUser($user_id);
            $user->name = $request->get('name');
            if($user->save()){
                $siteDetails = SiteDetails::first();
                $siteDetails->tenant_number = $request->get('mobile');
                $siteDetails->company_name = $request->get('company_name');
                $siteDetails->tagline = $request->get('tagline');
                $siteDetails->fleet_size = $request->get('fleet_size');
                $siteDetails->industry = $request->get('industry');
                $siteDetails->time_zone = $request->get('time_zone');
                $siteDetails->currency = $request->get('currency');
                $siteDetails->save();

                $tenant = TenantMgmt::where('uid', $request->header('tenantId'))->first();
                $tenant->tenant_name = $request->get('name');
                $tenant->tenant_number = $request->get('mobile');
                $tenant->company_name = $request->get('company_name');
                $tenant->tagline = $request->get('tagline');
                $tenant->fleet_size = $request->get('fleet_size');
                $tenant->industry = $request->get('industry');
                $tenant->time_zone = $request->get('time_zone');
                $tenant->currency = $request->get('currency');
                $tenant->save();
                $user = $this->getUserData($user_id, NULL, $tenantId);

                return Response()->json(['status'=>true,'message'=>'Profile Updated Successfully!', 'response'=>['user'=>$user]], 200);
            }else{
                return Response()->json(['status'=>false,'message'=>'Error! Server Not Responde.', 'response'=>[]], 401);
            }
        }
    }

    private function updatePassword($request, $user_id){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|max:14|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first(), 'response'=>[]], 401);
        }else{
            $user = $this->getUser($user_id);
            if (Hash::check($request->get('old_password'), $user->password)) {
                $result = $this->saveUserDetail($request, $user_id);
                if($result){
                    return Response()->json(['status'=>true,'message'=>'Password Updated Successfully!', 'response'=>[]], 200);
                }else{
                    return Response()->json(['status'=>false,'message'=>'Sorry! Server Not Responde.', 'response'=>[]], 401);
                }
            }else{
                return Response()->json(['status'=>false,'message'=>'Sorry! Old Password not matching with database.', 'response'=>[]], 401);
            }
            
        }
    }

    private function validatePasswordData($request){

    }
}