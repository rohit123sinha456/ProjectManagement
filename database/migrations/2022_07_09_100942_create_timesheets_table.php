<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('object_id');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->double('hours');
            // $table->unsignedBigInteger('sdlcstep');
            // $table->foreign('sdlcstep')->references('id')->on('sdlc');
            $table->string('sdlcstep',10);
            $table->date('date');
            $table->boolean('is_submitted');
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
        Schema::dropIfExists('timesheets');
    }
}
