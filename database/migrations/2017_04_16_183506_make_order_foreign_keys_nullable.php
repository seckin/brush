<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeOrderForeignKeysNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_payment_id_foreign');
            $table->dropForeign('orders_shipping_info_id_foreign');
            $table->dropForeign('orders_user_id_foreign');
            $table->dropColumn("shipping_info_id");
            $table->dropColumn("user_id");
            $table->dropColumn("payment_id");
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
