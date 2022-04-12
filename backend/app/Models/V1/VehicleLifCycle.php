<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLifCycle extends Model
{
    use HasFactory;
    protected $table = 'vehicle_life_cycles';
    /**Primary Key**/
    protected $primaryKey = 'lifecycle_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','service_date','odometer','service_life_in_month','service_life_in_miles','resale_value','out_of_service_date','out_of_service_odometer'];
}
