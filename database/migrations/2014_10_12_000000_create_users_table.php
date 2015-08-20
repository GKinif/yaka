<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            
            $table->string('prenom', 20);
            $table->string('adresse', 50)->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('localite', 50)->nullable();
            
            $table->string('pays', 2);
            
            $table->string('telephone', 20)->nullable();
            $table->string('numero_carte', 20)->nullable();
            
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('pays')->references('pays_abreviation')->on('pays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
