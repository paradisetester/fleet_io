<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->bigIncrements('vehicle_id');
            $table->string('name', 255)->nullable();
            $table->string('vin', 255)->nullable();
            $table->string('type', 255);
            $table->string('license_plate', 100)->nullable();						
            $table->integer('year')->nullable();              
            $table->string('registration_state', 100)->nullable();
            $table->string('registration_photo', 255)->nullable();             
            $table->string('status', 255)->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->string('ownership', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('body_type_id', 50)->nullable();
            $table->string('body_sub_type_id', 50)->nullable();
            $table->decimal('msrp', 10, 2)->nullable();
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->string('linked_vehicle_id', 50)->nullable();
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
        Schema::dropIfExists('vehicle_details');
    }
}
