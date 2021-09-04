<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glasses', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('sex');
            $table->string('frame_shape');
            $table->string('frame_material');
            $table->string('lens_color');
            $table->boolean('polarization');
            $table->boolean('mirror');
            $table->boolean('gradient');
            $table->string('lens_material');
            $table->integer('bridge_size');
            $table->integer('eyepiece_size');
            $table->integer('temple_length');
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
        Schema::dropIfExists('glasses');
    }
}
