<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('value');
            $table->string('currency');
            $table->string('source');
            $table->dateTime('due_date');
            $table->dateTime('won_date')->nullable();
            $table->bigInteger('deal_stages_id')->unsigned();
            $table->integer('status')->default(0);  // 0 = Open , 1 = Closed
            $table->string('payment_method')->nullable();   // Installments rate
            $table->bigInteger('property_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('property_id')
                ->references('id')->on('properties');
            $table->foreign('customer_id')
                ->references('id')->on('customers');
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('deals');
    }
}
