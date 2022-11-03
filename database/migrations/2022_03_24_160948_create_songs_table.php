<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->longText('lyric')->nullable();
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('musican_id');
            $table->integer('menu_id');
            $table->string('thumb');
            $table->string('file_song');
            $table->unsignedBigInteger('view')->nullable();
            $table->integer('active');
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
        Schema::dropIfExists('songs');
    }
};
