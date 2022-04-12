<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_history', function (Blueprint $table) {
            $table->bigIncrements('service_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade');
            $table->integer('user_id');
            $table->integer('odometer'); 
            $table->date('completion_date');
            $table->time('completion_time');
            $table->unsignedBigInteger('vendor_id');            
            $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade');
            $table->string('reference', 255);
            $table->string('labels', 255);
            $table->string('photo', 255)->nullable();
            $table->string('document', 255)->nullable();
            $table->text('comment');
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
        Schema::dropIfExists('service_history');
    }
}
