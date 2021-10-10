<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status');
            $table->softDeletes();
        });
        
        Schema::create('information_translations', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->integer('information_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('name');
            $table->string('value');

            $table->unique(['information_id','locale']);

            $table->foreign('information_id')->references('id')->on('informations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('information_translations');
        Schema::drop('information');
    }
}
