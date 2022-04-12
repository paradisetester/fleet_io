<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportClient  extends \Laravel\Passport\Client
{
    protected $connection = 'fleet_tenant';
}
