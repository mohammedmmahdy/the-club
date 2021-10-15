<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReservationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reservations', function (Blueprint $table) {
            $table->increments('id')->from(100000);
            $table->foreignId('user_id');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->dateTime('date');
            $table->integer('number_of_people');
            $table->integer('price')->default(200);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket_reservations');
    }
}
