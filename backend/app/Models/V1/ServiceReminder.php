<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReminder extends Model
{
    use HasFactory;
	  protected $table = 'service_reminders';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['vehicle_id','date','user_ids','service_type','renewal_type','time_threshold','week'];

    public function vehicle()
    {
        return $this->belongsTo(VehicleDetails::class,'id','vehicle_id');
    }

    public function vehicleName()
    {
        return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
    }
}
