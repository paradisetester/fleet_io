<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id');
            $table->string('tenant_uid')->unique();
            $table->char('tenant_number', 20);
            $table->char('company_name', 200);
            $table->char('tagline', 255);
            $table->char('fleet_size', 150);
            $table->char('industry', 100);
            $table->char('time_zone', 100);
            $table->char('currency', 10);
            $table->integer('folder_size')->nullable()->comment('Folder Size will get updated once in a day, using cron script');
            $table->integer('plan_id')->unsigned();
            $table->longText('plan_details');
            $table->tinyInteger('is_paid')->default(0)->comment("0 - no, 1 yes");
            $table->tinyInteger('is_active')->default(1)->comment("0 - no, 1 yes");
            $table->tinyInteger('under_maintenance')->default(0)->comment("0 - no, 1 yes");
            $table->tinyInteger('term_and_condition')->default(1)->comment("0 - no, 1 yes");
            $table->dateTime('valid_from')->comment("plan start date.");
            $table->dateTime('valid_till')->comment("plan end date.");
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
        Schema::dropIfExists('site_details');
    }
}
