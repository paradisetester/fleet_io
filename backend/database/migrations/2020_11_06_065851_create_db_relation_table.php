<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_models', function (Blueprint $table) {
            $table->bigInteger('make_id')->unsigned();
            $table->foreign('make_id')->references('id')->on('vehicle_makes')->onDelete('cascade');
        });

        Schema::table('vehicle_details', function (Blueprint $table) {
            $table->unsignedBigInteger('make_id');              
            $table->foreign('make_id')->references('id')->on('vehicle_makes')->onDelete('cascade'); 
            $table->unsignedBigInteger('model_id');             
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('cascade'); 
            $table->unsignedBigInteger('trim_id'); 
            $table->foreign('trim_id')->references('id')->on('vehicletypes')->onDelete('cascade'); 
            $table->unsignedBigInteger('service_program'); 
            $table->foreign('service_program')->references('service_program_id')->on('service_programs')->onDelete('cascade');
        });

        Schema::table('vehicletypes', function (Blueprint $table) {
            $table->bigInteger('model_id')->unsigned();
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('cascade');
        });

        Schema::table('inspection_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');              
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('inspection_template_items', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');              
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('inspection_template_id');
            $table->foreign('inspection_template_id')->references('id')->on('inspection_templates')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
