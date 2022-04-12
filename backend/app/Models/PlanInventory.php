<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanInventory extends Model
{
    use HasFactory;
    
    protected $connection = 'fleet_admin';
	
	protected $table = 'plan_inventories';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['heading','description','features','discount','free_trial','permission_group','status','type','price'];
	
	
	public function plans_permission(){
        return $this->hasMany(PlanPermissions::class, 'plan_id');
    }
}
