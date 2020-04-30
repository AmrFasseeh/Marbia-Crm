<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('type')->default('0'); // 0->contact 1->lead 2->customer
            $table->string('fullname');
            $table->string('city')->nullable();
            $table->string('neighbourhood')->nullable();
            $table->string('country');
            $table->string('address');
            $table->date('date_birth')->nullable();
            $table->string('phone')->unique();
            $table->string('email');
            $table->string('job_title')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('skype')->nullable();
            $table->bigInteger('lead_stage_id')->unsigned()->nullable();
            $table->string('lead_title')->nullable();
            $table->string('lead_source')->nullable();
            $table->dateTime('lead_date')->nullable();
            $table->string('lead_value')->nullable();
            $table->string('lead_message')->nullable();
            $table->dateTime('cust_date')->nullable();
            $table->string('cust_type')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
