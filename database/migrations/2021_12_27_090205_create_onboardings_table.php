<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onboardings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->timestamps();
        });

        Schema::create('onboarding_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('onboarding_id');
            $table->string('locale', 2)->index();

            $table->string('text')->nullable();

            $table->unique(['onboarding_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('onboarding_translations');
        Schema::drop('onboardings');
    }
}
