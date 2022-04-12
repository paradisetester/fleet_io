<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('vendor_id');
            $table->integer('user_id');
            $table->string('name', 255); 
            $table->string('phone', 255);
            $table->string('website', 255);
            $table->string('labels', 255);
            $table->string('address', 255);
            $table->string('address_line_2', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('postal_code', 255);
            $table->string('country', 255);
            $table->string('contact_name', 255);
            $table->string('contact_email', 255);
            $table->string('contact_phone', 255);
            $table->integer('fuel');
            $table->integer('service');
            $table->integer('vehicle');
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
        Schema::dropIfExists('vendors');
    }
}
