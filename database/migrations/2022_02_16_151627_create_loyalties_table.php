<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalties', function (Blueprint $table) {
            $table->increments('id');

            $table->string('photo');
            $table->integer('discount_value');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loyalty_translations', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->integer('loyalty_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('title');
            $table->string('brief');
            $table->text('description');

            $table->unique(['loyalty_id', 'locale']);

            $table->foreign('loyalty_id')
                ->references('id')
                ->on('loyalties')
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
        Schema::drop('loyalties');
    }
}
