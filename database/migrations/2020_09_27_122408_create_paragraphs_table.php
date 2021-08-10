<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParagraphsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paragraphs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            
            $table->softDeletes();
        });


        Schema::create('paragraph_translations', function(Blueprint $table)
        {
            $table->increments('trans_id');
            $table->integer('paragraph_id')->unsigned();
            $table->string('locale', 2)->index();
           $table->longText('text');

            $table->unique(['paragraph_id','locale']);

            $table->foreign('paragraph_id')
                        ->references('id')
                            ->on('paragraphs')
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
        Schema::drop('paragraph_translations');
        Schema::drop('paragraphs');
    }
}
