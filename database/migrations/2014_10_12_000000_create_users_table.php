<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name')->unique();
            $table->string('description')->default('Go to setting page to custom description !');
            $table->string('email')->unique();
            $table->boolean('is_admin')->default(false);
            $table->string('avatar_url')->default('http://vue.dev/storage/avatar/default_avatar.jpg');
            $table->string('background_url')->default('http://vue.dev/images/bg15.jpg');
            $table->string('password');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
