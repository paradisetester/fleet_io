<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTask extends Model
{
    use HasFactory;
    protected $table = 'service_tasks';
    /**Primary Key**/
    protected $primaryKey = 'service_task_id';
	/**Fields**/
    protected $fillable = ['name','description','subtask'];
}
