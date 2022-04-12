<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionTemplates extends Model
{
		use HasFactory;
		 protected $table = 'inspection_templates';
		/**Primary Key**/
		protected $primaryKey = 'id';
		/**Fields**/
		protected $fillable = ['user_id','title','description'];
}
