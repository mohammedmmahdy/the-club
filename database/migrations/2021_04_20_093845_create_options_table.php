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
            $table->string('fav_icon')->default('fav_icon.png');
            $table->string('welcome_message')->default('Welcome to Thub');
            $table->string('welcome_photo')->default('welcome.jpg');

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
