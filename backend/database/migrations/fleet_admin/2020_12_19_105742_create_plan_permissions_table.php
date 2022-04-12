<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_permissions', function (Blueprint $table) {
            $table->integer('plan_id')->unsigned();
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('plan_id')->references('id')->on('plan_inventories')->onDelete('cascade');

            $table->integer('permission_id')->unsigned();
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
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
        Schema::dropIfExists('plan_permissions');
    }
}
