<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
    use HasFactory;
    protected $table = 'vehicle_makes';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['name','description','status'];

    public function vehiclemodel()
    {
    	return $this->hasMany(VehicleModel::class,'make_id','id');
    }
}
