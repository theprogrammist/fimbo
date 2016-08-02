<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('actions', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('pricetype_id');
            $table->string('description', 1024)->nullable();
            $table->integer('cost')->default(0);

            $table->integer('problem_id')->nullable();

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
        Schema::drop('actions');
    }
}
