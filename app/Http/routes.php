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
    if(Auth::guest()) {
        $page = empty($page = App\Page::whereName('main')->first()) ? new App\Page : $page;
        $page->contentHash = $page->content ? json_decode($page->content) : (object) App\Page::$fields;
        return view('welcome', ['page' => $page, 'contentHash' => $page->content]);
    }
    return view('home');
});

Route::get('/problem/{problemId}', ['uses' => 'ProblemController@show'])->middleware('auth');
Route::post('/problem/{problemId}/solution', ['uses' => 'ProblemController@solution'])->middleware('auth');

Route::get('/cabinet/', function() {
    return view('cabinet');
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


Route::get('/lection/{lectionId}/{pageNum}', ['uses' => 'LectionController@show']);
Route::get('/lection/{lectionId}/', function($lectionId) {
    return redirect('/lection/'.$lectionId . '/'. ((App\Page::whereParentId($lectionId)->min('number')) ?: 1));
});
Route::get('/lection/', function() {
    return view('learn');
});


Route::post('/upload', 'Admin\AdminController@upload');

Route::group(['prefix' => 'admin'], function($router)
{
    Route::get('/', 'Admin\AdminController@dashboard');
    Route::get('/static-content/{name}', ['as' => 'staticContent', 'uses' => 'Admin\AdminController@staticContent']);
    Route::post('/static-content/{name}/save', ['uses' => 'Admin\AdminController@saveStaticContent']);
    Route::get('/static-content/{name}/delete/{id}', ['uses' => 'Admin\AdminController@deleteStaticContent']);

    Route::get('/lection/{id}', ['uses' => 'Admin\LectionController@show']);
    Route::get('/lection/newpage/{id}', function ($id) {
        return view('admin.lection', ['page' => new App\Page, 'id' => $id]);
    });
    Route::post('/lection/newpage/{id}/save', ['uses' => 'Admin\LectionController@save']);
    Route::post('/lection/{id}/save', ['uses' => 'Admin\LectionController@save']);
    Route::get('/lection/{id}/delete', ['uses' => 'Admin\LectionController@delete']);

    Route::get('/course/{id}', ['uses' => 'Admin\CourseController@show']);
    Route::post('/course/{id}/save', ['uses' => 'Admin\CourseController@save']);
    Route::get('/course/{id}/delete', ['uses' => 'Admin\CourseController@delete']);

    Route::get('/problem/{id}', ['uses' => 'Admin\ProblemController@show']);
    Route::post('/problem/{id}/save', ['uses' => 'Admin\ProblemController@save']);
    Route::get('/problem/{id}/delete', ['uses' => 'Admin\ProblemController@delete']);

    Route::get('/comics/{id}', ['uses' => 'Admin\ComicsController@show']);
    Route::post('/comics/{id}/save', ['uses' => 'Admin\ComicsController@save']);
    Route::get('/comics/{id}/delete', ['uses' => 'Admin\ComicsController@delete']);
    Route::get('/comics/newpage/{id}', function ($id) {
        return view('admin.comics', ['page' => new App\Page, 'id' => $id]);
    });
    Route::post('/comics/newpage/{id}/save', ['uses' => 'Admin\ComicsController@save']);
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

Route::get('/login', function() {
    return redirect('/')
        ->with(
            Auth::guest() ? ['loginRedirect' => true] : []
        );
});

//Route::get('/home', 'HomeController@index');
