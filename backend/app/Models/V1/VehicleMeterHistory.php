<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMeterHistory extends Model
{
    use HasFactory;
    protected $table = 'vehicle_meter_histories';
    /**Primary Key**/
    protected $primaryKey = 'vehicle_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','date','odometer_reading'];
	
	 public function vehiclename()
	{
		return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
	}

}
