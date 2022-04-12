<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service_history';
    /**Primary Key**/
    protected $primaryKey = 'service_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','user_id','odometer','completion_date','completion_time','vendor_id','reference','labels','photo','document','comment'];

    public function Vehiclename()
	{
	return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
	}
}
