<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class VehicleModel extends Model
{
    use HasFactory;
    protected $table = 'vehicle_models';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['make_id','name','description','status'];

    public function vehiclemake()
    {
    	return $this->belongsTo(VehicleMake::class,'make_id','id');
    }

    public function VehicleModel_Relation_With_type()
    {
        return $this->hasMany(Vehicletype::class);
    }
}
