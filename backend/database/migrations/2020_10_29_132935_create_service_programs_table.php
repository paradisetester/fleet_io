<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_programs', function (Blueprint $table) {
            $table->bigIncrements('service_program_id');
            $table->string('name', 255);
            $table->string('template', 255);
            $table->string('photo', 255)->nullable();
            $table->string('primary_meter', 255);
            $table->string('secondary_meter', 255);
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
        Schema::dropIfExists('service_programs');
    }
}
