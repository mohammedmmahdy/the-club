<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('faq_category_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('faq_category_id')->references('id')->on('faq_categories')->onDelete('cascade');
        });

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('faq_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('question');
            $table->text('answer');

            $table->unique(['faq_id', 'locale']);

            $table->foreign('faq_id')
                ->references('id')
                ->on('faqs')
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
        Schema::drop('faq_translations');
        Schema::drop('faqs');
    }
}
