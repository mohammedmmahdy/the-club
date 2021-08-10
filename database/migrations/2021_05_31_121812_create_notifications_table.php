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
            $table->string('btn_to')->nullable();
            $table->string('photo');
            $table->string('type')->comment('1 => All, 2 => Driver, 3 => Customer');
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

        Schema::create('notification_to', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notification_id');
            $table->morphs('notificationable');
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
        Schema::drop('notification_to');
        Schema::drop('notification_translations');
        Schema::drop('notifications');
    }
}
