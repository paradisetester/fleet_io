<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionSections extends Model
{
    use HasFactory;
    
    protected $table = 'permission_sections';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['slug','name','url','icon','status'];
	
	public function module()
    {
        return $this->belongsTo(PermissionModules::class,'module_id','id');
    }
}
