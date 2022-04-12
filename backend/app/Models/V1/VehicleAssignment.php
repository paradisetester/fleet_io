<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleAssignment extends Model
{
    use HasFactory;
    protected $table = 'vehicle_assignments';
    /**Primary Key**/
    protected $primaryKey = 'assignment_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','contact_id','user_id','send_email_notification','start_date','start_time','starting_odometer','end_date','end_time','ending_odometer','comment'];
}
