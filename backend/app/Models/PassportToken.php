<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Token;

class PassportToken extends Token
{
    protected $connection = 'fleet_tenant';
}
