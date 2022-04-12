<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_inventories', function (Blueprint $table) {
            $table->increments('id');
			$table->string('heading', 255);
			$table->string('description', 255)->nullable();
			$table->longText('features', 255);
			$table->decimal('discount', 10,2);
			$table->integer('free_trial')->default('0');
			$table->tinyInteger('status')->default('0')->comment = '0 - (Not Approved), 1 - Approved, 2 - Pending';
			$table->tinyInteger('type')->default('1')->comment = '1 => Monthly   2 => Annually';			
			$table->decimal('price', 10,2);
			$table->string('color', 20)->nullable();
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
        Schema::dropIfExists('plan_inventories');
    }
}
