<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->enum('in_navbar', ['yes', 'no'])->default('yes');
            $table->enum('in_footer', ['yes', 'no'])->default('yes');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('page_translations', function(Blueprint $table)
        {
            $table->increments('trans_id');
            $table->integer('page_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->longText('content');
            $table->string('slug');

            $table->unique(['page_id','locale', 'slug']);

            $table->foreign('page_id')
                        ->references('id')
                            ->on('pages')
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
        Schema::drop('page_translations');
        Schema::drop('pages');
    }
}
