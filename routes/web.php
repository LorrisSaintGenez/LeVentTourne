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

        Route::get('/', 'QuizController@getAllQuizzesAdmin')->name('getAllQuizzesAdmin');

        Route::get('create', 'QuizController@creation')->name('quizCreation');

        Route::post('create', 'QuizController@create')->name('quizCreate');

        Route::get('edit/{id}', 'QuizController@edit')->name('quizEdit');
        Route::post('update', 'QuizController@update')->name('quizUpdate');

        Route::delete('delete/{id}', 'QuizController@delete')->name('quizDelete');

        Route::get('visualize/{id}', 'QuizController@visualize')->name('quizVisualize');

    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('userIndex');

        Route::prefix('students')->group(function () {
            Route::get('/', 'StudentController@index')->name('studentsIndex');
            Route::get('visualize/{id}', 'StudentController@visualize')->name('visualizeStudent');
        });

        Route::prefix('teachers')->group(function () {
            Route::get('/', 'TeacherController@index')->name('teachersIndex');
            Route::get('classes/{id}', 'TeacherController@classesByTeacher')->name('classesByTeacher');
        });

        Route::prefix('classroom')->group(function () {
            Route::get('/', 'ClassroomController@index')->name('classroomsIndex');
            Route::get('visualize/{id}', 'ClassroomController@visualizeClassroom')->name('visualizeClassroom');
        });
    });

    Route::prefix('pages')->group(function () {
        Route::get('/', 'GhostPageController@index')->name('ghostPageIndex');

        Route::get('visualize/{id}', 'GhostPageController@visualize')->name('ghostPagevisualize');

        Route::get('create', 'GhostPageController@creation')->name('ghostPageCreation');
        Route::post('create', 'GhostPageController@create')->name('ghostPageCreate');

        Route::get('edit/{id}', 'GhostPageController@edition')->name('ghostPageEdition');
        Route::post('update', 'GhostPageController@update')->name('ghostPageEdit');

        Route::delete('delete/{id}', 'GhostPageController@delete')->name('ghostPageDelete');
    });

    Route::prefix('themes')->group(function () {
        Route::get('/', 'ThemeController@index')->name('themeIndex');
        Route::get('create', 'ThemeController@creation')->name('themeCreation');
        Route::post('create', 'ThemeController@create')->name('themeCreate');
    });

});

Route::group(['middleware' => 'student'], function () {
    Route::prefix('student')->group(function () {
        Route::get('/', 'StudentController@details')->name('studentDetails');
        Route::get('edit', 'StudentController@edit')->name('studentEdit');
        Route::post('edit', 'StudentController@update')->name('studentUpdate');
        Route::get('/progression', 'StudentController@progression')->name('studentProgression');
    });

    Route::prefix('quiz')->group(function () {
        Route::get('/', 'QuizController@getAllQuizzesStudent')->name('getAllQuizzesStudent');
        Route::get('/answer/{id}', 'QuizController@getQuiz')->name('quizGet');
        Route::post('/answer/{id}', 'QuizStudentController@answerQuiz')->name('quizAnswer');
    });
});

Route::group(['middleware' => 'teacher'], function () {
    Route::prefix('teacher')->group(function () {
        Route::get('/', 'TeacherController@details')->name('teacherDetails');
        Route::get('edit', 'TeacherController@edit')->name('teacherEdit');
        Route::post('edit', 'TeacherController@update')->name('teacherUpdate');
        Route::get('editTeacherSchool', 'TeacherController@editTeacherSchool')->name('teacherEditSchool');
        Route::post('editTeacherSchool', 'TeacherController@updateTeacherSchool')->name('teacherUpdateSchool');
        Route::get('classes', 'TeacherController@getMyClasses')->name('getMyClasses');

        Route::prefix('school')->group(function () {
            Route::get('createSchool', function () {
                return view('school/schoolCreation');
            })->name('schoolCreation');
            Route::post('createSchool', 'SchoolController@create')->name('schoolCreate');
        });
        Route::prefix('classroom')->group(function () {
            Route::get('createClassroom', 'ClassroomController@creation')->name('classroomCreation');
            Route::post('createClassroom', 'ClassroomController@create')->name('classroomCreate');
            Route::get('class/{id}', 'ClassroomController@visualizeMyClassroom')->name('visualizeMyClassroom');
            Route::get('student/{id}', 'ClassStudentController@visualizeClassStudent')->name('visualizeClassStudent');

        });
    });
});