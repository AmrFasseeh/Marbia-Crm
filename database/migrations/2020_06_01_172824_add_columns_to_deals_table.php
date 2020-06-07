<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->string('payment');
            $table->string('down_payment')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('payment_duration')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('down_payment');
            $table->dropColumn('discount');
            $table->dropColumn('payment_duration');
        });
    }
}
