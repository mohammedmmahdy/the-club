<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMetasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')
                ->default(1)
                ->comment('0 => Inactive, 1 => Active');

            $table->string('page');

            // $table->foreign('page_id')
            //             ->references('id')
            //                 ->on('pages')
            //                     ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('meta_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('meta_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->longText('description');
            $table->longText('keywords');

            $table->unique(['meta_id', 'locale']);

            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meta_translations');
        Schema::drop('metas');
    }
}
