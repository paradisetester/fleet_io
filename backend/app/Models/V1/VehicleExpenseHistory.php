<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleExpenseHistory extends Model
{
    use HasFactory;
    protected $table = 'vehicle_expense_histories';
    /**Primary Key**/
    protected $primaryKey = 'expense_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','expense_type','price','recurring','frequency','date','time','start_date','end_date','vendor_id','notes','photo','document','comment'];
	
	 public function vehiclename()
	{
		return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
	}

	public function Vendorname()
	{
	return $this->belongsTo(Vendor::class,'vendor_id','vendor_id');
	}
	
}
