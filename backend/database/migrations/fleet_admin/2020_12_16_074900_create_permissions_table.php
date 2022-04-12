<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug'); //edit-posts
	        $table->string('name'); // edit posts
	        $table->longText('dependent_on_sections')->nullable(); // edit posts
            $table->unsignedBigInteger('module_id');
	        $table->tinyInteger('module_order');
            $table->unsignedBigInteger('section_id');     
	        $table->tinyInteger('section_order');     
	        $table->tinyInteger('type')->comment('0 : No Permission, 1 : Permission');
	        $table->tinyInteger('for_only_admin')->default(0);
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('permission_modules')->onDelete('cascade');            
            $table->foreign('section_id')->references('id')->on('permission_sections')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
