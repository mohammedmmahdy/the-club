<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo')->default('logo.png');
            $table->string('fav_icon')->default('logo.png');
            $table->string('wifi_name')->default('theclub');
            $table->string('wifi_password')->default('password');
            $table->integer('safety_ratio')->default(30);
            $table->integer('visit_ticket_price')->default(200);

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
        Schema::drop('options');
    }
}
