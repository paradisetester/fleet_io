<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSettings extends Model
{
    use HasFactory;
    protected $table = 'vehicle_settings';
    /**Primary Key**/
    protected $primaryKey = 'setting_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','primary_meter','current_reading','average_usage_per_day','auto_calculate','secondary_meter_check','secondary_meter','secondary_current_reading','secondary_average_usage_per_day','secondary_auto_calculate','fuel_unit','measurement_unit'];
}
