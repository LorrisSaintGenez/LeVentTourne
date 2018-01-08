<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGhostPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ghost_pages', function (Blueprint $table) {
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
        Schema::table('ghost_pages', function (Blueprint $table) {
            $table->dropColumn('picture');
            $table->dropColumn('video');
            $table->dropColumn('sound');
        });
    }
}
