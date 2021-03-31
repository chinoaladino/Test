<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perritos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('color');
            $table->unsignedBigInteger('razas_id');
            $table->foreign('razas_id')->references('id')->on('razas')->onDelete('cascade')->change();
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
        Schema::dropIfExists('perritos');
    }
}
