<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $connection = 'fleet_admin';
    protected $table = 'careers';
    /**Primary Key**/
    protected $primaryKey = 'id';
	/**Fields**/
    protected $fillable = ['first_name','last_name','phone','email','cover_letter','resume','apply_for'];
}
