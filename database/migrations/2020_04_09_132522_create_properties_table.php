<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('property_type');
            $table->integer('floor_no')->nullable();
            $table->integer('apartment_no')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('kitchen')->nullable();
            $table->string('area_sqm')->nullable();
            $table->string('value');
            $table->boolean('status')->default(0);
            $table->string('payment_category')->nullable();
            $table->bigInteger('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings');
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
        Schema::dropIfExists('properties');
    }
}
