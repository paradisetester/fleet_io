<?php
namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
	/**Table Name**/
    protected $table = 'links';
    protected $connection = 'fleet_admin';
    /**Primary Key**/
    protected $primaryKey = 'link_id';
	/**Fields**/
    protected $fillable = ['link_url','post_id','link_name','link_order','link_parent','created_at','updated_at'];
}
