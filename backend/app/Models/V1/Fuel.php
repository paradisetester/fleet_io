<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;
    protected $table = 'fuels';
    /**Primary Key**/
    protected $primaryKey = 'fuel_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','user_id','date','time','odometer','price','fuel_type','vendor_id','reference','personal','partial_fuel_up','photo','document','comment'];

    public function vehiclename()
	{
	return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
	}

	public function Vendorname()
	{
	return $this->belongsTo(Vendor::class,'vendor_id','vendor_id');
	}
}
