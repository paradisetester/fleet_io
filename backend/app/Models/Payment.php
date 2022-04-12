<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $connection = 'fleet_admin';

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'order_id';

    public function tenant(){
        return $this->belongsTo(TenantMgmt::class,'tenant_id','id');
    }

    public function plan(){
        return $this->belongsTo(PlanInventory::class,'plan_id','id');
    }
}
