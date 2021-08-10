<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('blog_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title');
            $table->text('brief');
            $table->text('description');

            $table->unique(['blog_id', 'locale']);

            $table->foreign('blog_id')
                ->references('id')
                ->on('blogs')
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
        Schema::drop('blog_translations');
        Schema::drop('blogs');
    }
}
