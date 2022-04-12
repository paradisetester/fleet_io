<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_assignments', function (Blueprint $table) {
            $table->bigIncrements('assignment_id');
            $table->integer('vehicle_id');
            $table->integer('contact_id');
            $table->integer('user_id');
            $table->integer('send_email_notification');
            $table->date('start_date');
            $table->time('start_time');
            $table->integer('starting_odometer');
            $table->date('end_date');
            $table->time('end_time');
            $table->integer('ending_odometer');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('vehicle_assignments');
    }
}
