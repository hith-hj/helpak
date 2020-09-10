<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHlSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hl-settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->default(0);
            $table->string('address')->default('yes');
            $table->string('phone')->default('yes');
            $table->string('can_send_message')->default('yes');
            $table->string('can_see_myinfo')->default('yes');
            $table->string('can_see_mypost')->default('yes');
            $table->string('can_rate')->default('yes');
            $table->string('can_see_myphone')->default('yes');
            $table->string('can_see_myaddress')->default('yes');
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
        Schema::dropIfExists('hl-settings');
    }
}
