<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('offer_category_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('offer_category_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('name');

            $table->unique(['offer_category_id', 'locale']);

            $table->foreign('offer_category_id')
                ->references('id')
                ->on('offer_categories')
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
        Schema::drop('offer_categories');
    }
}
