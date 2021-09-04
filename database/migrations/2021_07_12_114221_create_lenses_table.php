<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenses', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->float('diameter');
            $table->float('center_thickness');
            $table->string('material_type');
            $table->boolean('is_uv');
            $table->string('moisture');
            $table->string('lens_material');
            $table->float('oxygen_transmission');
            $table->string('wearing_mode');
            $table->string('replacement_mode');
            $table->string('tinting');
            $table->text('diopters');
            $table->text('cylinder')->nullable();
            $table->text('axis')->nullable();
            $table->text('curvature');
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
        Schema::dropIfExists('lenses');
    }
}
