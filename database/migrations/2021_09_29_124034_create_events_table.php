<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->string('icon');
            $table->string('photo');
            $table->unsignedTinyInteger('members_only');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('event_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('event_id');
            $table->string('locale', 2)->index();

            $table->string('title');
            $table->text('description');

            $table->unique(['event_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
