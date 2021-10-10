<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaygroundTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playground_types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('playground_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('playground_type_id');
            $table->string('locale', 2)->index();

            $table->string('name');

            $table->unique(['playground_type_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playground_type_translations');
        Schema::drop('playground_types');
    }
}
