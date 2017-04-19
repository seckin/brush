<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCartItemIdToProductSpec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_specs', function (Blueprint $table) {
            $table->integer('cart_item_id')->nullable()->unsigned();
            $table->foreign('cart_item_id')->references('id')->on('cart_items');
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
