<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsProjectsTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_project_tag', function (Blueprint $table) {
            $table->integer('project_id')->unsigned();
            $table->integer('project_tag_id')->unsigned();

        });
        Schema::table('project_project_tag', function (Blueprint $table) {

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('project_tag_id')->references('id')->on('project_tags')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_project_tag');
    }
}
