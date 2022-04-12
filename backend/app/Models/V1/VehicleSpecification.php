<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSpecification extends Model
{
    use HasFactory;
    protected $table = 'vehicle_specifications';
    /**Primary Key**/
    protected $primaryKey = 'specification_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','width','height','length','interior_valume','passenger_valume','ground_clearance','bed_length','curb_weight','gross_weight','towing_capacity','max_payload','epa_city','epa_highway','epa_combined','engine_summery','engine_brand','engine_aspiration','block_type','bore','cam_type','compression','cylinders','displacement','fuel_injection','max_hp','max_torque','redline_rpm','stroke','valves','transmission_summery','transmission_brand','transmission_type','transmission_gears','drive_type','brake_system','front_track_width','rear_track_width','wheelbase','front_wheel_diameter','rear_wheel_diameter','rar_axle','front_tyre_type','front_tyre_psi','rear_tyre_type','rear_tyre_psi','fuel_type','fuel_quality','fuel_tank_1_capacity','fuel_tank_2_capacity','oil_capacity'];
}
