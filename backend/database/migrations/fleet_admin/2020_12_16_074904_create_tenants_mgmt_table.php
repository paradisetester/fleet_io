<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsMgmtTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tenants_mgmt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();
            $table->string('database_name')->unique();
            $table->char('tenant_email', 100)->unique();
            $table->char('tenant_password', 150)->nullable(false)->comment("do empty once tenant site will create");
            $table->char('tenant_name', 150);
            $table->char('tenant_number', 20);
            $table->char('company_name', 200);
            $table->char('fleet_size', 150);
            $table->char('industry', 100);
            $table->char('time_zone', 100);
            $table->char('currency', 10);
            $table->char('tagline', 255);
            $table->integer('folder_size')->nullable()->comment('Folder Size will get updated once in a day, using cron script');
            $table->integer('plan_id')->unsigned();
            $table->tinyInteger('is_paid')->default(0)->comment("0 - no, 1 yes");
            $table->tinyInteger('is_active')->default(1)->comment("0 - no, 1 yes");
            $table->tinyInteger('under_maintenance')->default(0)->comment("0 - no, 1 yes");
            $table->tinyInteger('term_and_condition')->default(0)->comment("0 - no, 1 yes");
            $table->dateTime('valid_till')->nullable()->comment("Plan end date.");
            $table->tinyInteger('tenant_status')->default(0)->comment('0 - Process Initiated, 2 - Email Validated, 3 - Tenant Detail Added, 4 - Site Created');
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('plan_inventories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tenants_mgmt');
    }

}
