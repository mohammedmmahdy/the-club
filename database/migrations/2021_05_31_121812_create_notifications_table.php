<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('photo')->nullable();
            $table->string('icon')->nullable();
            $table->integer('receiver_type')->comment('0 (Main) / 1 (Sub) / 2 (Academic) / 3 (Guest) / 4 (All)');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('notification_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->unsignedInteger('notification_id');
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->string('brief');
            $table->longText('description');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notification_translations');
        Schema::drop('notifications');
    }
}
