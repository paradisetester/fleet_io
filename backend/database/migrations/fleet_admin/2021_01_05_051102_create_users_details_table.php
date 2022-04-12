<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('mobile', 15)->nullable();
            $table->longText('image')->nullable();
            $table->date('dob', 150)->nullable()->comment("Date of Birth");
            $table->string('job_title', 200)->nullable();
            $table->tinyInteger('employee')->default(0)->comment("0 - no, 1 - yes");
            $table->string('address1')->nullable()->comment("Street Address");
            $table->string('address2')->nullable();
            $table->string('city', 150)->nullable();
            $table->string('state')->nullable()->comment("State/Province/Region");
            $table->string('postal_code', 50)->nullable()->comment("Zip/Postal Code");
            $table->string('country', 150)->nullable();
            $table->string('employee_number', 255)->nullable();
            $table->date('employee_join_at', 150)->nullable();
            $table->date('employee_leave_at', 150)->nullable();
            $table->timestamps();              
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
