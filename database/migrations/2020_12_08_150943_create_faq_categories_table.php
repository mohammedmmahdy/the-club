<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('faq_category_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('faq_category_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');

            $table->unique(['faq_category_id', 'locale']);

            $table->foreign('faq_category_id')
                ->references('id')
                ->on('faq_categories')
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
        Schema::drop('faq_category_translations');
        Schema::drop('faq_categories');
    }
}
