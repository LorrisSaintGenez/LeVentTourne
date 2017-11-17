<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->integer('theme_id')->unsigned()->nullable();
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->text('explanation');
            $table->integer('timer');
            $table->string('victory_sound')->nullable();
            $table->string('defeat_sound')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign('quizzes_theme_id_foreign');
            $table->dropColumn('theme_id');
            $table->dropColumn('explanation');
            $table->dropColumn('timer');
            $table->dropColumn('victory_sound');
            $table->dropColumn('defeat_sound');
        });
    }
}
