<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('release_date');
            $table->string('publisher');
            $table->string('developer')->nullable();
            $table->integer('rated')->nullable();
            $table->string('game_mode')->nullable();
            $table->integer('price');
            $table->integer('qty');
            $table->integer('discount')->nullable();
            $table->string('image')->nullable();
            $table->string('platform')->nullable();
            $table->string('image_item')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('games');
    }
}
