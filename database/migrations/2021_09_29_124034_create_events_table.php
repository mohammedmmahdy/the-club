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
            $table->foreignId('branch_id');
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


        Schema::create('event_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('event_id');
            $table->foreignId('user_id')->nullable();

            $table->string('strMemberName')->nullable();
            $table->string('member_mobile')->nullable();
            $table->unsignedInteger('number_of_tickets')->default(1);
            $table->unsignedTinyInteger('status')->default(0);

            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('event_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('event_id');
            $table->integer('event_category_id');
            $table->integer('price')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_prices');
        Schema::drop('event_reservations');
        Schema::drop('event_translations');
        Schema::drop('events');
    }
}
