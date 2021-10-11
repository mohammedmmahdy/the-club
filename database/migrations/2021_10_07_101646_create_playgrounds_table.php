<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaygroundsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('playground_type_id');
            $table->foreignId('branch_id');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('playground_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('playground_id');
            $table->string('locale', 2)->index();

            $table->string('name');
            $table->text('description');

            $table->unique(['playground_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playground_translations');
        Schema::drop('playgrounds');
    }
}
