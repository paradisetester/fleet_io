<?php

namespace App\Http\Repositories\Api\V1;

use Illuminate\Support\Facades\Hash;
use Uuid;
use App\Models\TenantMgmt;
use App\Models\TanantUser;
use Carbon\Carbon;


class TenantMgmtRepository implements \App\Http\Repositories\Api\V1\TenantMgmtRepositoryInterface {

    function isTenantExist($email, $unique_id) {
        return $email;
    }
    
    function addNewTenant($request) {
        if(!empty($request)){
            $valid_till = $request->get('valid_till') ? $request->get('valid_till') : '';
            $valid_days = $request->get('valid_days') ? $request->get('valid_days') : 14;
            $currentDateTime = $valid_till ? Carbon::parse($valid_till) : Carbon::now();
            $newDateTime = $currentDateTime->addDay($valid_days);
            
            if($request->get('tenant_id')){
                $tanatManagement = TenantMgmt::find($request->get('tenant_id'));
            }else{
                $tanatManagement = TenantMgmt::where('tenant_email', $request->get('tenant_email'))->first();
            }
            if(empty($tanatManagement)){
                $uid = $this->getUniqueId();
                $tanatManagement = new TenantMgmt();
                $tanatManagement->uid = $uid;
                $tanatManagement->database_name = $uid;
                $tanatManagement->tenant_email = $request->get('tenant_email');
                $tanatManagement->plan_id =  $request->get('plan_id');
                if($request->get('name')) { $tanatManagement->tenant_name = $request->get('name'); };
                if($request->get('password')) { $tanatManagement->tenant_password = $request->get('password'); }
                $tanatManagement->valid_till = $newDateTime;
                $tanatManagement->term_and_condition =  1;
                // $tanatManagement->term_and_condition =  $request->get('term_and_condition');
                if($tanatManagement->save()){
                    $tanantUser = new TanantUser();
                    $tanantUser->tenant_id = $tanatManagement->id;
                    $tanantUser->email = $request->get('tenant_email');
                    $tanantUser->password = Hash::make($request->get('password'));
                    $tanantUser->user_type = 1;
                    $tanantUser->save();
                }
                return [
                    'id' => $tanatManagement->id,
                    'uid' => $tanatManagement->uid,
                    'name' => $tanatManagement->tenant_name,
                    'password' => $tanatManagement->tenant_password
                ];
            }else{
                if($request->get('client_number')){ $tanatManagement->tenant_number = $request->get('client_number'); }
                if($request->get('company_name')){ $tanatManagement->company_name = $request->get('company_name'); }
                if($request->get('fleet_size')){ $tanatManagement->fleet_size = $request->get('fleet_size'); }
                if($request->get('industry')){ $tanatManagement->industry = $request->get('industry'); }
                if($request->get('time_zone')){ $tanatManagement->time_zone = $request->get('time_zone'); }
                if($request->get('tagline')){ $tanatManagement->tagline = $request->get('tagline'); }
                if($request->get('currency')){ $tanatManagement->currency = $request->get('currency'); }
                if($request->get('is_paid')){ $tanatManagement->is_paid = $request->get('is_paid'); }
                if($request->get('plan_id')){ $tanatManagement->plan_id = $request->get('plan_id'); }
                
                $tanatManagement->valid_till = $newDateTime;
                $tanatManagement->tenant_status = $request->get('tenant_status') ? $request->get('tenant_status') : 0;
                $tanatManagement->save();
                return [
                    'id' => $tanatManagement->id,
                    'name' => $tanatManagement->tenant_name,
                    'uid' => $tanatManagement->uid,
                    'password' => $tanatManagement->tenant_password,
                    'valid_till' => $tanatManagement->valid_till
                ];
            }
        }else{
            return NULL;
        }
    }

    function getUniqueId() {
        $uuid = Uuid::generate(1, 20, Uuid::NS_DNS)->string;
        $uniqueDBName = str_replace('-', '', $uuid);
        return $uniqueDBName;
    }

}
