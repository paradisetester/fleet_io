<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPermissions extends Model
{
    use HasFactory;
    
    protected $connection = 'fleet_admin';

	protected $table = 'plan_permissions';
    
	/**Fields**/
    protected $fillable = ['plan_id','permission_id'];
	
	public function permissions(){
        return $this->belongsTo(Permission::class, 'permission_id');
    }
    
	public function plans(){
        return $this->belongsTo(PlanInventory::class, 'plan_id');
    }
}
