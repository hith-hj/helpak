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
            $table->uuid('id');
            $table->string('name');
            $table->string('firstName')->default('user');
            $table->string('lastName')->default('user');
            $table->string('gender')->default('male');
            $table->string('age')->default(0);
            $table->string('role')->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable()->default('notset');
            $table->string('phone')->default('notset');
            $table->integer('rate')->default(5);
            $table->integer('service')->default(0);
            $table->integer('donation')->default(0);
            $table->integer('dakish')->default(0);
            $table->string('image')->default('image.jpg');
            $table->string('lang')->default('ar');
            $table->string('about')->default('none');
            $table->string('setting_id')->default('notset');
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
        Schema::dropIfExists('users');
    }
}
