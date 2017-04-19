<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCartItem2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->integer('shipping_cost');
            $table->integer('price_per_item');
            $table->integer('quantity')->unsigned();
            $table->integer('design_id')->unsigned();
            $table->foreign('design_id')->references('id')->on('designs');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('product_spec_id')->unsigned();
            $table->foreign('product_spec_id')->references('id')->on('product_specs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
