<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp_verification', function (Blueprint $table) {
            $table->bigIncrements('otp_id');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('otp_code');
            $table->datetime('time');
            $table->string('otp_for');
            $table->integer('otp_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otp_verification');
    }
}
