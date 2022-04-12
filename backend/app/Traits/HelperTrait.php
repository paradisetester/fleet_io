<?php

namespace App\Traits;

use App\Models\PlanPermissions;
use App\Models\TenantMgmt;

trait HelperTrait {
    public function fileuploadExtra($request, $key){
        $file = $request->file($key);
        $destinationPath = 'images/uploads/'.date('Y').'/'.date('M');
        $fileName = time().'_'.str_replace(' ', '_', $file->getClientOriginalName());
        return $file->storeAs('public', $destinationPath.'/'.$fileName, 'assets');
    }

    public function getPlanPermissions($plan_id){
        $planPermissions = [];
        $permissions = PlanPermissions::where('plan_id', $plan_id)->with('permissions')->get();
        foreach ($permissions as $key => $permission) {
            $permission = $permission->permissions;
            $planPermissions[] = [
                'slug' => $permission->slug,
                'name' => $permission->name,
                'dependent_on_sections' => $permission->dependent_on_sections,
                'module_id' => $permission->module_id,
                'module_order' => $permission->module_order,
                'section_id' => $permission->section_id,
                'section_order' => $permission->section_order,
                'type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        return $planPermissions;
    }

    public function getTenantData($uid){
        $tenantData = TenantMgmt::with('plan_inventory')->where('uid', $uid)->first();
        if($tenantData){
            return [
                'tenant_id' => $tenantData->id,
                'tenant_uid' => $tenantData->uid,
                'tenant_number' => $tenantData->tenant_number,
                'company_name' => $tenantData->company_name,
                'tagline' => $tenantData->tagline,
                'fleet_size' => $tenantData->fleet_size,
                'industry' => $tenantData->industry,
                'time_zone' => $tenantData->time_zone,
                'currency' => $tenantData->currency,
                'folder_size' => $tenantData->folder_size,
                'plan_id' => $tenantData->plan_id,
                'plan_details' => json_encode($tenantData->plan_inventory),
                'is_paid' => $tenantData->is_paid,
                'is_active' => $tenantData->is_active,
                'under_maintenance' => $tenantData->under_maintenance,
                'term_and_condition' => $tenantData->term_and_condition,
                'valid_from' => $tenantData->created_at,
                'valid_till' => $tenantData->valid_till,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }else{
            return [];
        }
        
    }
}