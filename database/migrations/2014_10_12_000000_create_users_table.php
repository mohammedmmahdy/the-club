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
            // $table->unsignedTinyInteger('status')->default(1);
            // $table->rememberToken();
            // $table->timestamps();





            $table->unsignedTinyInteger('social_status')->nullable()->comment(" 1 => Single, 2 => Married ");
            $table->unsignedInteger('num_of_children')->nullable();
            $table->unsignedInteger('points')->default(0);
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('verification_code')->nullable();
            $table->unsignedInteger('balance')->default(0);

            $table->string('iMemberId')->nullable();
            $table->string('strCardNumber')->nullable();
            $table->string('member_mobile')->nullable();
            $table->date('dateCardDateValidFrom')->comment('year-month-day')->nullable();
            $table->date('dateCardDateExpire')->nullable()->comment('year-month-day');
            $table->time('timeTimeFrom')->nullable()->comment('24 hour');
            $table->time('timeTimeTo')->nullable()->comment('24 hour');
            $table->string('strMemberName')->nullable();
            $table->integer('iMemberType')->nullable()->comment('0 (Main) / 1 (Sub) / 2 (Academic)');
            $table->date('dateBirthdate')->nullable()->comment('year-month-day');
            $table->boolean('boolMemberStatus')->nullable()->comment('True (Active) / False (Hold)');
            $table->string('iMainMemberID')->nullable();
            $table->string('strImageName_DataSoft')->nullable();
            $table->string('strImgURL_DataSoft')->nullable();
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
