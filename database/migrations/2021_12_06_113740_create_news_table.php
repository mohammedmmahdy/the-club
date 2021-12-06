<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');

            $table->timestamps();
        });


        Schema::create('news_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('news_id');
            $table->string('locale', 2)->index();

            $table->string('title');
            $table->text('body');

            $table->unique(['news_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_translations');
        Schema::drop('news');
    }
}
