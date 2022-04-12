<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->string('order_number', 50)->unique();
            $table->unsignedBigInteger('tenant_id');
            $table->integer('plan_id')->unsigned();
            $table->double('order_total_amount', 12, 2)->unsigned();
            $table->string('transaction_id');
            $table->string('card_number', 25);
            $table->string('card_expiry_month', 20);
            $table->string('card_expiry_year', 20);
            $table->tinyInteger('order_status')->default(1);
            $table->string('email_address', 250);
            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants_mgmt')->onDelete('cascade'); 
            $table->foreign('plan_id')->references('id')->on('plan_inventories')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
