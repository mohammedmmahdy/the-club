<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('event_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('event_category_id');
            $table->string('locale', 2)->index();

            $table->string('name');

            $table->unique(['event_category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_category_translations');
        Schema::drop('event_categories');
    }
}
