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

use App\Quiz;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'backoffice', 'middleware' => 'admin'], function() {

    Route::get('/', function () {
        return view('admin/backoffice');
    })->name('backoffice');

    Route::prefix('quiz')->group(function() {

        Route::get('/', 'QuizController@getAllQuizzes')->name('getAllQuizzes');

        Route::get('create', function () {
            return view('admin/quiz');
        });

        Route::post('create', 'QuizController@create')->name('create');

        Route::get('edit/{id}', 'QuizController@edit')->name('editQuiz');
        Route::post('update', 'QuizController@update')->name('update');

        Route::get('visualize/{id}', 'QuizController@visualize')->name('visualizeQuiz');

    });

});