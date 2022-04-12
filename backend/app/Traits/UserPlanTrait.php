<?php

namespace App\Traits;
use Auth, DateTime, Uuid;
use App\Models\User;
use App\Models\UserPlan;
use App\Models\UserPlanHistory;
use App\Models\PlanInventory;
use App\Traits\{
    UserTrait,
};

trait UserPlanTrait {
    use UserTrait;
    public function insertUpdatePlans($request, $id = null)
    {
        $user_id = $this->getCurrentUserID();
        if (!$userPlan = UserPlan::where('user_id', $user_id)->get()->first()) {
            $userPlan = new UserPlan();
            $userPlan->created_at = new DateTime;
        } else {
            $this->insertPlansHistory($userPlan);
        }
        $uuid = Uuid::generate(1,$this->getCurrentUserID(), Uuid::NS_DNS)->string;
        $planInventory = PlanInventory::find($request->input('plan_id'));
        $start_date = date('Y-m-d');
        if ($planInventory->type == 0) {
            $end_date = date('Y-m-d', strtotime($start_date. ' + 14 days'));
        } else if ($planInventory->type == 1) {
            $end_date = date('Y-m-d', strtotime($start_date. ' + 30 days'));
        } else if ($planInventory->type == 2) {
            $end_date = date('Y-m-d', strtotime($start_date. ' + 365 days'));
        }
        $userPlan->user_id = $user_id;
        $userPlan->plan_inventory_id = $request->input('plan_id');
        $userPlan->price = $planInventory->price;
        $userPlan->type = $planInventory->type;        
        $userPlan->permission_group = $planInventory->permission_group;
        $userPlan->status = '0';
        $userPlan->active ='1';
        $userPlan->uid = $uuid;
        $userPlan->payment_date = $request->input('payment_date');
        $userPlan->payment_status = $request->input('payment_status');
        $userPlan->payment_id = $request->input('payment_id');
        $userPlan->start_date = $start_date;
        $userPlan->end_date = $end_date;
        $userPlan->updated_at = new DateTime;
        $userPlan->save();
        return $userPlan;
    }
    public function insertPlansHistory($userPlan)
    {
        $userPlanHistory = new UserPlanHistory();
        $userPlanHistory->user_plan_id = $userPlan->id;
        $userPlanHistory->user_id = $userPlan->user_id;
        $userPlanHistory->plan_inventory_id = $userPlan->plan_inventory_id;
        $userPlanHistory->price = $userPlan->price;
        $userPlanHistory->type = $userPlan->type;        
        $userPlanHistory->permission_group = $userPlan->permission_group;
        $userPlanHistory->status = $userPlan->status;
        $userPlanHistory->active = $userPlan->active;
        $userPlanHistory->uid = $userPlan->uid;
        $userPlanHistory->payment_date = $userPlan->payment_date;
        $userPlanHistory->payment_status = $userPlan->payment_status;
        $userPlanHistory->payment_id = $userPlan->payment_id;
        $userPlanHistory->start_date = $userPlan->start_date;
        $userPlanHistory->end_date = $userPlan->end_date;
        $userPlanHistory->created_at = new DateTime;
        $userPlanHistory->updated_at = new DateTime;
        $userPlanHistory->save();
    }
}