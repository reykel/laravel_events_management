<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->string('passport');
            $table->string('nationality');
            $table->unsignedBigInteger('arrive_id')->nullable();
            $table->foreign('arrive_id')->references('id')->on('transportations');
            $table->unsignedBigInteger('departure_id')->nullable();
            $table->foreign('departure_id')->references('id')->on('transportations');
            $table->string('allergies')->nullable();
            $table->string('special_needs')->nullable();
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
        Schema::dropIfExists('executives');
    }
};
