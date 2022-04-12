<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('issue_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->integer('user_id');
            $table->date('reported_date');
            $table->string('summery', 255);
            $table->text('description');
            $table->integer('odometer');
            $table->string('labels', 255);
            $table->unsignedBigInteger('reported_by');           
            $table->foreign('reported_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('assigned_to');            
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->string('photo', 255)->nullable();
            $table->string('document', 255)->nullable();
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
        Schema::dropIfExists('issues');
    }
}
