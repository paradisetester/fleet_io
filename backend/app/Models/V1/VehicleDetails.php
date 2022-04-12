<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDetails extends Model
{
    use HasFactory;
    protected $table = 'vehicle_details';
    /**Primary Key**/
    protected $primaryKey = 'vehicle_id';
	/**Fields**/
    protected $fillable = ['name','vin','license_plate','type','make_id','model_id','year','trim_id','registration_state','registration_photo','service_program','status','group_id','contact_id','ownership','color','body_type_id','body_sub_type_id','msrp','purchase_price','linked_vehicle_id'];
	
	
	 public function make()
    {
        return $this->belongsTo('App\Models\V1\VehicleMake');
    }
	 public function model()
    {
        return $this->belongsTo('App\Models\V1\VehicleModel');
    }
	
	public function trim()
    {
        return $this->belongsTo('App\Models\V1\Vehicletype');
    }

    public function service()
    {
        return $this->belongsTo(ServiceProgram::class,'vehicle_id','service_program_id');
    }

    // public function service()
    // {
    //     return $this->belongsTo(ServiceProgram::class,'vehicle_id','service_program_id');
    // }

    public function contactby()
    {
    return $this->belongsTo('App\Models\User','contact_id','id');
    }

    
}
