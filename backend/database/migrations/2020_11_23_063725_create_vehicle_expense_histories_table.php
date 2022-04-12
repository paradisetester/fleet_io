<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleExpenseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_expense_histories', function (Blueprint $table) {
            $table->bigIncrements('expense_id');
            $table->unsignedBigInteger('vehicle_id');            
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle_details')->onDelete('cascade'); 
            $table->string('expense_type', 100)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('recurring',10)->nullable();
            $table->date('date')->nullable();
            $table->string('time',20)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('vendor_id');            
            $table->foreign('vendor_id')->references('vendor_id')->on('vendors')->onDelete('cascade'); 
            $table->text('notes')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('frequency', 255)->nullable();
            $table->string('document', 255)->nullable();
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
        Schema::dropIfExists('vehicle_expense_histories');
    }
}
