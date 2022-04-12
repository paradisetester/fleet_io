<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_specifications', function (Blueprint $table) {
            $table->bigIncrements('specification_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('interior_valume', 10, 2)->nullable();
            $table->decimal('passenger_valume', 10, 2)->nullable();
            $table->integer('ground_clearance')->nullable();
            $table->integer('bed_length')->nullable();
            $table->integer('curb_weight')->nullable();
            $table->integer('gross_weight')->nullable();
            $table->integer('towing_capacity')->nullable();
            $table->integer('max_payload')->nullable();
            $table->string('epa_city', 50)->nullable();
            $table->string('epa_highway', 50)->nullable();
            $table->string('epa_combined', 50)->nullable();
            $table->string('engine_summery', 255)->nullable();
            $table->string('engine_brand', 255)->nullable();
            $table->string('engine_aspiration', 155)->nullable();
            $table->string('block_type', 155)->nullable();
            $table->integer('bore')->nullable();
            $table->string('cam_type', 155)->nullable();
            $table->integer('compression')->nullable();
            $table->decimal('cylinders', 10, 2)->nullable();
            $table->integer('displacement')->nullable();
            $table->string('fuel_injection', 255)->nullable();
            $table->decimal('max_hp', 10, 2)->nullable();
            $table->decimal('max_torque', 10, 2)->nullable();
            $table->integer('redline_rpm')->nullable();
            $table->integer('stroke')->nullable();
            $table->decimal('valves', 10, 2)->nullable();
            $table->string('transmission_summery', 255)->nullable();
            $table->string('transmission_brand', 255)->nullable();
            $table->string('transmission_type', 255)->nullable();
            $table->decimal('transmission_gears', 10, 2)->nullable();
            $table->string('drive_type', 255)->nullable();
            $table->string('brake_system', 50)->nullable();
            $table->integer('front_track_width')->nullable();
            $table->integer('rear_track_width')->nullable();
            $table->integer('wheelbase')->nullable();
            $table->string('front_wheel_diameter', 50)->nullable();
            $table->string('rear_wheel_diameter', 50)->nullable();
            $table->string('rar_axle', 100)->nullable();
            $table->string('front_tyre_type', 255)->nullable();
            $table->integer('front_tyre_psi')->nullable();
            $table->string('rear_tyre_type', 255)->nullable();
            $table->integer('rear_tyre_psi')->nullable();
            $table->string('fuel_type', 255)->nullable();
            $table->string('fuel_quality', 255)->nullable();
            $table->integer('fuel_tank_1_capacity')->nullable();
            $table->integer('fuel_tank_2_capacity')->nullable();
            $table->integer('oil_capacity')->nullable();
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
        Schema::dropIfExists('vehicle_specifications');
    }
}
