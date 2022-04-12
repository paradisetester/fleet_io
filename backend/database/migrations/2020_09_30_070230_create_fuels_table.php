<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->bigIncrements('fuel_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->integer('user_id');
            $table->date('date');
            $table->time('time');
            $table->integer('odometer');
            $table->decimal('price', 10, 2);
            $table->string('fuel_type', 255);
            $table->unsignedBigInteger('vendor_id');            
            $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
            $table->string('reference');
            $table->integer('personal');
            $table->string('partial_fuel_up', 255);
            $table->string('photo', 255)->nullable();
            $table->string('document', 255)->nullable();
            $table->text('comment')->nullable();
            $table->string('litres',200)->nullable();
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
        Schema::dropIfExists('fuels');
    }
}
