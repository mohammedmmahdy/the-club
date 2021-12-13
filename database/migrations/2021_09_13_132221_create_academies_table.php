<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academies', function (Blueprint $table) {
            $table->increments('id');
            // $table->foreignId('branch_id');
            $table->string('main_photo');
            $table->string('icon');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('academy_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('academy_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('name');
            $table->text('about');
            $table->text('team');

            $table->unique(['academy_id', 'locale']);

            $table->foreign('academy_id')
                ->references('id')
                ->on('academies')
                ->onDelete('cascade');
        });

        Schema::create('academy_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('academy_id');

            $table->string('photo');

            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('academy_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('academy_id');

            $table->string('day');
            $table->time('from');
            $table->time('to');

            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('academy_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('academy_id');
            $table->foreignId('user_id');
            $table->foreignId('academy_schedule_id');

            $table->string('strMemberName')->nullable();
            $table->string('member_mobile')->nullable();
            $table->unsignedTinyInteger('status')->default(0);

            $table->unsignedInteger('age');
            $table->unsignedTinyInteger('gender')->comment('1 => Male, 2 => Female');

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
        Schema::drop('academy_schedules');
        Schema::drop('academy_photos');
        Schema::drop('academies');
    }
}
