<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcomehome');
});

Route::resource('pertanyaanbaru', 'NewPertanyaanController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });
 
Route::resource('jawaban', 'JawabanController');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::resource('komentarPertanyaan', 'KomentarPertanyaanController');

Route::resource('komentarJawaban', 'KomentarJawabanController');

Route::patch('/jawaban/{jawaban}', 'NewPertanyaanController@tepat')->name('jawaban.tepat');

Route::resource('profile', 'ProfileController');

Route::post('/upvote/{upvote}', 'NewPertanyaanController@upvote')->name('vote.pertanyaanup');

Route::post('/downvote/{downvote}', 'NewPertanyaanController@downvote')->name('vote.pertanyaandown');
