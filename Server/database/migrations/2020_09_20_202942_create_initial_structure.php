<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialStructure extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Source', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('url',200);
        });

        Schema::create('Question', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question',100);
            $table->bigInteger('source_id')->unsigned()->index('source_id');
            $table->integer('points')->default(0);
            $table->dateTime('added_on');
            $table->dateTime('updated_on');
            $table->enum('status', ['0','1'])->default('1')->nullable();
        });

        Schema::create('Tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
        });

        Schema::create('QuestionTag', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('question_id')->unsigned()->index('question_id');
            $table->bigInteger('tag_id')->unsigned()->index('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Source');
        Schema::drop('Question');
        Schema::drop('Tag');
        Schema::drop('QuestionTag');
    }
}
