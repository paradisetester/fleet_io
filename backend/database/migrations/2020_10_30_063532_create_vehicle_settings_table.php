<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_settings', function (Blueprint $table) {
            $table->bigIncrements('setting_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->string('primary_meter', 50)->nullable();
            $table->integer('current_reading')->nullable();
            $table->integer('average_usage_per_day')->nullable();
            $table->integer('auto_calculate')->nullable();
            $table->integer('secondary_meter_check')->nullable();
            $table->string('secondary_meter', 50)->nullable();
            $table->integer('secondary_current_reading')->nullable();
            $table->integer('secondary_average_usage_per_day')->nullable();
            $table->integer('secondary_auto_calculate')->nullable();
            $table->string('fuel_unit', 20)->nullable();
            $table->string('measurement_unit', 50)->nullable();
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
        Schema::dropIfExists('vehicle_settings');
    }
}
