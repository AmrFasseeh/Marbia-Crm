<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteCascadetoProjectTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('building_groups', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');
        });
        Schema::table('buildings', function (Blueprint $table) {
            $table->dropForeign(['building_group_id']);
            $table->foreign('building_group_id')
                ->references('id')->on('building_groups')
                ->onDelete('cascade');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['building_id']);
            $table->foreign('building_id')
                ->references('id')->on('buildings')
                ->onDelete('cascade');
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
