<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleLifCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_life_cycles', function (Blueprint $table) {
            $table->bigIncrements('lifecycle_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->date('service_date')->nullable();
            $table->integer('odometer')->nullable();
            $table->integer('service_life_in_month')->nullable();
            $table->integer('service_life_in_miles')->nullable();
            $table->decimal('resale_value', 10, 2)->nullable();
            $table->date('out_of_service_date')->nullable();
            $table->integer('out_of_service_odometer')->nullable();
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
        Schema::dropIfExists('vehicle_life_cycles');
    }
}
