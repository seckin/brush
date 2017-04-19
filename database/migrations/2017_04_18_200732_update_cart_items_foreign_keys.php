<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCartItemsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign('cart_items_design_id_foreign');
            $table->dropForeign('cart_items_order_id_foreign');
            $table->dropForeign('cart_items_product_spec_id_foreign');
            $table->dropColumn("design_id");
            $table->dropColumn("order_id");
            $table->dropColumn("product_spec_id");
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
