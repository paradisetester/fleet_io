<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    use HasFactory;

    protected $table = 'permissions';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['slug','name','dependent_on_sections','module_id','module_order','section_id','section_order','type'];
	
	public function modules()
    {
        return $this->hasMany(PermissionModules::class,'id','module_id');
    }

	public function sections()
    {
        return $this->hasMany(PermissionSections::class,'id','section_id');
    }
}
