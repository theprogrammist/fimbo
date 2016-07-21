<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProblemsTableAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 1024);
            $table->text('description')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->integer('number')->nullable();
            $table->integer('score')->nullable();
            $table->integer('attempts')->nullable();
            $table->integer('difficulty')->nullable();
            $table->integer('course_id')->nullable();
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
        Schema::drop('problems');
    }
}
