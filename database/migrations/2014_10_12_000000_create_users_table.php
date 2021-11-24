<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // $table->string('first_name');
            // $table->string('last_name');
            // $table->string('phone')->nullable();
            // $table->string('member_id')->nullable();
            // $table->string('email')->unique()->nullable();
            // $table->string('password')->nullable();
            // $table->unsignedTinyInteger('status')->default(1);
            // $table->unsignedTinyInteger('social_status')->nullable()->comment(" 1 => Single, 2 => Married ");
            // $table->unsignedInteger('num_of_children')->nullable();
            // $table->unsignedInteger('balance')->default(0);
            // $table->unsignedInteger('points')->default(0);
            // $table->rememberToken();
            // $table->timestamps();


            $table->string('iMemberId');
            $table->string('strCardNumber');
            $table->string('member_mobile');
            $table->date('dateCardDateValidFrom')->comment('year-month-day');
            $table->date('dateCardDateExpire')->comment('year-month-day');
            $table->time('timeTimeFrom')->comment('24 hour');
            $table->time('timeTimeTo')->comment('24 hour');
            $table->string('strMemberName');
            $table->integer('iMemberType')->comment('0 (Main) / 1 (Sub) / 2 (Academic)');
            $table->date('dateBirthdate')->comment('year-month-day');
            $table->boolean('boolMemberStatus')->comment('True (Active) / False (Hold)');
            $table->string('iMainMemberID');
            $table->string('strImageName_DataSoft');
            $table->string('strImgURL_DataSoft');
            $table->timestamps();













        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
