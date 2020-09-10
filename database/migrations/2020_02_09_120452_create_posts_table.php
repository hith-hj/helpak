<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title')->default('service');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_role');
            $table->string('type')->default('set');
            $table->longText('content');
            $table->string('address')->default('notset');
            $table->string('phone')->default('notset');
            $table->string('likeCount')->default(0);
            $table->string('redoCount')->default(0);
            $table->string('viewCount')->default(0);
            $table->string('commentCount')->default(0); 
            $table->string('requestCount')->default(0); 
            $table->string('requestNumber')->default(0); 
            $table->string('file')->default('nofile'); 
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
        Schema::dropIfExists('posts');
    }
}
