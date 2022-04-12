<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reminders', function (Blueprint $table) {
            $table->id();            
			$table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->date('date')->nullable();
            $table->string('user_ids',50)->nullable();
            $table->enum('service_type', ['service', 'vehicle','contact']);
            $table->string('renewal_type',50)->nullable();
            $table->string('time_threshold',50)->nullable();
            $table->string('week',50)->nullable();
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
        Schema::dropIfExists('service_reminders');
    }
}
