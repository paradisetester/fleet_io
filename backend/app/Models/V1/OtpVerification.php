<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    protected $table = 'otp_verification';

    protected $primaryKey = 'otp_id';

    protected $fillable = [
        'phone', 'email', 'otp_code', 'time', 'otp_for', 'otp_status', 'created_at', 'updated_at'
    ];
}