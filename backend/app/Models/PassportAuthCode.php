<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\AuthCode;

class PassportAuthCode extends AuthCode
{
    protected $connection = 'fleet_admin';
}
