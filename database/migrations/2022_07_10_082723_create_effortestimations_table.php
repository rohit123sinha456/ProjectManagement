<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEffortestimationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effortestimations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('object_id');
            $table->foreign('object_id')->references('id')->on('objects');
            $table->string('sdlcstep',10);
            $table->double('hours');
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
        Schema::dropIfExists('effortestimations');
    }
}
