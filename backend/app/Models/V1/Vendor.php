<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendors';
    /**Primary Key**/
    protected $primaryKey = 'vendor_id';
	/**Fields**/
    protected $fillable = ['user_id','name','phone','website','labels','address','address_line_2','city','state','postal_code','country','contact_name','contact_email','contact_phone','fuel','service','vehicle'];

    public function issue()
	{
	return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
	}
}
