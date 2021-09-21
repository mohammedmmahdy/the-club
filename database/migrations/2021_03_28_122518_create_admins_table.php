<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->tinyInteger('status')
                ->default(1)
                ->comment('0 => Inactive, 1 => Active');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        Admin::create([

                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('clubvillage'),
                'created_at' => now(),
                'updated_at' => now(),
                'approved_at' => now(),

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
