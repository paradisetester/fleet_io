<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteDetails extends Model
{
    use HasFactory;
    
    protected $fillable = ['tenant_id','tenant_uid','tenant_number','company_name','tagline','fleet_size','industry','time_zone','currency','folder_size','plan_id','plan_details','is_paid','is_active','under_maintenance','term_and_condition','valid_from','valid_till'];

    public function plan(){
        return $this->belongsTo(PlanInventory::class,'plan_id','id');
    }
}
