<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProgram extends Model
{
    use HasFactory;
    protected $table = 'service_programs';
    /**Primary Key**/
    protected $primaryKey = 'service_program_id';
	/**Fields**/
    protected $fillable = ['name','template','primary_meter'];
}
