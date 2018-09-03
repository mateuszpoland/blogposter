<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //tworzy profile uzytkownikow
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            //powiazanie z kontem uzytkownika
            $table->integer('user_id');
            $table->string('avatar')->nullable();
            $table->text('about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('website')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
