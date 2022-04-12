<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;
    protected $table = 'issues';
    /**Primary Key**/
    protected $primaryKey = 'issue_id';
	/**Fields**/
    protected $fillable = ['vehicle_id','user_id','reported_date','summery','description','odometer','labels','reported_by','assigned_to','photo','document'];

	public function issue()
	{
	return $this->belongsTo(VehicleDetails::class,'vehicle_id','vehicle_id');
	}

	public function assigned_by_name()
	{
	return $this->belongsTo('App\Models\User','assigned_to','id');
	}

	public function reported_by_name()
	{
	return $this->belongsTo('App\Models\User','reported_by','id');
	}
}
