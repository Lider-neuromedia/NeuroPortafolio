<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_project', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('link_id')->unsigned();
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_project');
    }
}
