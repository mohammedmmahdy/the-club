<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChampsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('champ_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('champ_id');
            $table->string('locale', 2)->index();

            $table->string('title');
            $table->text('body');

            $table->unique(['champ_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('champs');
    }
}
