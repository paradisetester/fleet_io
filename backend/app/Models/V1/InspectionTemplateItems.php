<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionTemplateItems extends Model
{
    use HasFactory;
	 protected $table = 'inspection_template_items';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/

   protected $fillable = ['user_id','inspection_template_id','fields'];
}
