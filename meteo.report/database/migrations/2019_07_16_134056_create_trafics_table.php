<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraficsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trafics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip')->NULL;
            $table->boolean('installed')->default(false);
            $table->string('site_id')->default(0);
            $table->integer('archived')->default(0);
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
        Schema::dropIfExists('trafics');
    }
}
