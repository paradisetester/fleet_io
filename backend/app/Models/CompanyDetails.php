<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    protected $table = 'company_details';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'uid',
        'client_name',
        'client_number',
        'company_name',
        'fleet_size',
        'industry',
        'time_zone',
        'currency',
        'tagline',
        'folder_size',
        'package_id',
        'database_name',
        'company_status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
