<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModules extends Model
{
    use HasFactory;
    
    protected $table = 'permission_modules';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['slug','name','url','icon','status'];
	
	public function permission()
    {
        return $this->belongsTo(Permission::class,'module_id','id');
    }
	
}
