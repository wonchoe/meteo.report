<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address')->default('127.0.0.1');
            $table->string('unique_id')->unique();
            $table->integer('count')->default(0);
            $table->integer('count_today')->default(0);
            $table->string('user_agent')->NULL;
            $table->string('country')->NULL;
            $table->string('region')->NULL;
            $table->string('city')->NULL;
            $table->longtext('weather_data')->NULL;
            $table->timestamps();
            $table->index('unique_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_responses');
    }
}
