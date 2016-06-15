<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//http://fimbo/register/verify/pIQjLoGe86JRp5nBgRNEiQMVhnLwJCaeH2Pe9Uq4FBGr4IqVHEnAMuYRcziW
Route::get('register/verify/{confirmation_code?}', [
    'uses' => 'Auth\RegistrationController@confirm'
]);

Route::get('/register/success', function () {
    return view('auth.register-success-confirmation')
        ->with('resultClass', 'active')
        ->with('resultMessage', 'Для подтверждения электронной почты откройте письмо<br>от нашего сервиса и перейдите по ссылке в теле письма.');
});

Route::auth();

Route::get('/home', 'HomeController@index');
