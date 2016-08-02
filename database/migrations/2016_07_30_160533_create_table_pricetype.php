<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePricetype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricetypes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('description', 1024)->nullable();
            $table->string('code')->unique();
            $table->integer('price')->default(0);
            $table->timestamps();
        });

        DB::table('pricetypes')->insert([
            'code' => 'registration',
            'price' => 20,
            'description' => 'Регистрация на сайте'
        ]);
        DB::table('pricetypes')->insert([
            'code' => 'profile',
            'price' => 20,
            'description' => 'Профиль заполнен на 100%'
        ]);
        DB::table('pricetypes')->insert([
            'code' => 'problem',
            'description' => 'Решена задача'
        ]);

        foreach(\App\User::all() as $user) {
            App\Action::addAction('registration', $user->id);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pricetypes');
    }
}
