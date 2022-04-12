<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tenant_id')->unique();
            $table->string('tenant_db')->unique();
            $table->char('tenant_name', 255);
            $table->char('tenant_number', 20)->nullable();
            $table->char('company_name', 50);
            $table->char('fleet_size', 50);
            $table->char('industry', 100);
            $table->char('time_zone', 100);
            $table->char('currency', 50);
            $table->char('tagline', 255);
            $table->integer('package_id')->nullable();
            $table->tinyInteger('is_trial')->default(0)->comment("1=>true, 0=> false");
            $table->tinyInteger('is_paid')->default(0)->comment("1=>true, 0=> false");
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
        Schema::dropIfExists('tenants');
    }
}
