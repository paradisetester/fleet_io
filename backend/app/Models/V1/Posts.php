<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $connection = 'fleet_admin';
    protected $table = 'posts';
    /**Primary Key**/
    protected $primaryKey = 'post_id';
	/**Fields**/

   protected $fillable = ['user_id','title','heading','slug','status','image','description','short_description','meta_title','meta_description','type','template'];

}
