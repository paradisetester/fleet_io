<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;
	
	 protected $table = 'user_plans';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['plan_inventory_id','price','type','permission_group','status','active','user_id','uid','payment_date','payment_status','payment_id','start_date','end_date'];
	
}
