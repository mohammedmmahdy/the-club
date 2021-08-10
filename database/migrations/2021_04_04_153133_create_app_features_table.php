<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppFeaturesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('app_feature_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_feature_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('text');
            $table->string('description');

            $table->unique(['app_feature_id', 'locale']);

            $table->foreign('app_feature_id')->references('id')->on('app_features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('app_features');
    }
}
