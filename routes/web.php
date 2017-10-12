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
            return view('admin/quizzes/quiz');
        });

        Route::post('create', 'QuizController@create')->name('create');

        Route::get('edit/{id}', 'QuizController@edit')->name('editQuiz');
        Route::post('update', 'QuizController@update')->name('update');

        Route::get('visualize/{id}', 'QuizController@visualize')->name('visualizeQuiz');

    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('userIndex');

        Route::prefix('students')->group(function () {
            Route::get('/', 'StudentController@index')->name('studentsIndex');
            Route::get('visualize/{id}', 'StudentController@visualize')->name('visualizeStudent');
        });

        Route::prefix('teachers')->group(function () {
            Route::get('/', 'TeacherController@index')->name('teachersIndex');
            Route::get('students/{id}', 'TeacherController@studentByTeacher')->name('studentByTeacher');
        });
    });

    Route::prefix('pages')->group(function () {
        Route::get('/', 'GhostPageController@index')->name('ghostPageIndex');

        Route::get('visualize/{id}', 'GhostPageController@visualize')->name('ghostPagevisualize');

        Route::get('create', 'GhostPageController@creation')->name('ghostPageCreation');
        Route::post('create', 'GhostPageController@create')->name('ghostPageCreate');

        Route::get('edit/{id}', 'GhostPageController@edition')->name('ghostPageEdition');
        Route::post('update', 'GhostPageController@update')->name('ghostPageEdit');
    });

});