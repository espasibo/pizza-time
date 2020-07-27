<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->float('total', 8, 2);
            $table->string('currency');
            $table->timestamps();

            $table->index('currency');

            $table->foreign('currency')->references('slug')->on('currencies')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('currency');
            $table->dropColumn('updated_at');
            $table->dropColumn('created_at');
        });
    }
}
