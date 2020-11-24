<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('seller_id')->nullable();
            $table->decimal('total_price', 13,2)->default(0);
            $table->decimal('total_discount', 13,2)->default(0);
            $table->decimal('given_payment', 13,2)->default(0);
            $table->integer('total_quantity')->default(0);
            $table->string('payment_type')->default(0);
            $table->decimal('return_cash', 13,2)->default(0);

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
        Schema::dropIfExists('orders');
    }
}
