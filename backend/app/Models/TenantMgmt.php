<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TenantMgmt extends Model
{
    protected $connection = 'fleet_admin';
    protected $table = 'tenants_mgmt';
    
    public function plan_inventory() {
        return $this->belongsTo(PlanInventory::class, 'plan_id');
    } 
    
    public function tenant_users() {
        return $this->hasMany(TanantUser::class, 'tenant_id', 'id');;
    } 
    
    public function tenant_payments() {
        return $this->hasMany(Payment::class, 'tenant_id', 'id');;
    }    
    
}
