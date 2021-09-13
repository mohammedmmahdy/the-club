<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('branch_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('name');
            $table->text('address');

            $table->unique(['branch_id', 'locale']);

            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
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
        Schema::drop('branch_translations');
        Schema::drop('branches');
    }
}
