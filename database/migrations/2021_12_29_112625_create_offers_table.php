<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('photo');
            $table->integer('discount_value');
            $table->integer('offer_category_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('offer_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('offer_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('title');
            $table->text('description');

            $table->unique(['offer_id', 'locale']);

            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offers');
    }
}
