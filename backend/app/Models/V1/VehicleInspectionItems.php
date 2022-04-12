<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInspectionItems extends Model
{
    use HasFactory;
    protected $table = 'vehicle_inspection_items';
    /**Primary Key**/
    protected $primaryKey = 'inspection_item_id';
	/**Fields**/
    protected $fillable = ['inspection_id','vehicle_id','fields'];
}
