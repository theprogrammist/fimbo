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
    $page = empty($page = App\Page::whereName('main')->first()) ? new App\Page : $page;
    $page->contentHash = $page->content ? json_decode($page->content) : (object) App\Page::$fields;
    return view('welcome', ['page' => $page, 'contentHash' => $page->content]);
});

Route::get('/about_us', function () {
    return view('static-content', ['page' => empty($page = App\Page::whereName('about_us')->first()) ? new App\Page : $page]);
});
Route::get('/rules', function () {
    return view('static-content', ['page' => empty($page = App\Page::whereName('rules')->first()) ? new App\Page : $page]);
});
Route::get('/agreement', function () {
    return view('static-content', ['page' => empty($page = App\Page::whereName('agreement')->first()) ? new App\Page : $page]);
});

Route::post('/upload', 'AdminController@upload');

Route::group(['prefix' => 'admin'], function($router)
{
    Route::get('/', 'AdminController@dashboard');
    Route::get('/static-content/{name}', ['as' => 'staticContent', 'uses' => 'AdminController@staticContent']);
    Route::post('/static-content/{name}/save', ['uses' => 'AdminController@saveStaticContent']);
    Route::get('/static-content/{name}/delete/{id}', ['uses' => 'AdminController@deleteStaticContent']);
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
