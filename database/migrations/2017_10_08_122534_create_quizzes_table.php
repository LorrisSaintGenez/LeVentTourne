<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('theme');
            $table->string('question', 2000);
            $table->string('answer_1');
            $table->string('answer_2');
            $table->string('answer_3')->nullable();
            $table->string('answer_4')->nullable();
            $table->integer('solution');
            $table->integer('point');
            $table->string('picture')->nullable();
            $table->string('sound')->nullable();
            $table->string('video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
