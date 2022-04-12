<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInspection extends Model
{
    use HasFactory;
    protected $table = 'vehicle_inspections';
    /**Primary Key**/
    protected $primaryKey = 'inspection_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','inspection_template_id','user_id'];
}
