<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlanHistory extends Model
{
    use HasFactory;
	
	 protected $table = 'user_plans_history';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['user_plan_id','plan_inventory_id','price','type','permission_group','status','active','user_id','uid','payment_date','payment_status','payment_id','start_date','end_date'];
	
}
