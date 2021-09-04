<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 8);
            $table->string('name');
            $table->string('number')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('message_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->smallInteger('private')->default(0);
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
        Schema::dropIfExists('questions');
    }
}
