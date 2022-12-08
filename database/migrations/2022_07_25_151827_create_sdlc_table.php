<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdlcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdlc', function (Blueprint $table) {
            $table->id();
            $table->string('name', 10);
            $table->text('description');
            $table->unsignedBigInteger('sdlc_model_name');
            $table->foreign('sdlc_model_name')->references('id')->on('sdlcmodel');
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
        Schema::dropIfExists('sdlc');
    }
}
