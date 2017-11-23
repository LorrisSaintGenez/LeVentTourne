<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassStudent;
use App\Quiz;
use App\QuizStudent;
use App\School;
use App\Teacher;
use App\User;
use App\Http\Misc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        $users = User::where('role', '2')->get();

        foreach ($users as $user) {
            $classStudent = ClassStudent::where('student_id', $user->id)->first();
            if ($classStudent) {
                $classroom = Classroom::where('id', $classStudent->classroom_id)->first();
                $classroom->school = School::find($classroom->school_id);
                $user->classroom = $classroom;
            }
        }

        $users = $users->sortBy('id');

        return view('admin/usersManagement/studentsList', ['users' => $users]);
    }

    public static function getCurrentStudent($id)
    {
        $student = User::find($id);

        $classStudent = ClassStudent::where('student_id', $id)->first();

        if ($classStudent) {
            $classroom = Classroom::find($classStudent->classroom_id);
            $classroom->school = School::find($classroom->school_id);
            $classroom->teacher = User::find(Teacher::find($classroom->teacher_id));
            $classStudents = ClassStudent::where('classroom_id', $id)->get();
            $classroom->classStudents = $classStudents;
            $student->classroom = $classroom;
        }

        return $student;
    }

    public function getStudentInformation($id, $view)
    {
        $student = $this->getCurrentStudent($id);
        $classStudent = ClassStudent::where('student_id', $id)->first();
        if ($classStudent) {
            $classroom = Classroom::find($classStudent->classroom_id);
            $classroom->school = School::find($classroom->school_id);
            $classroom->teacher = User::find(Teacher::find($classroom->teacher_id));
            $classStudents = ClassStudent::where('classroom_id', $id)->get();
            $classroom->classStudents = $classStudents;
            $student->classroom = $classroom;
        }

        $quizzes = Quiz::all();

        $total_points = 0;

        foreach ($quizzes as $quiz) {
            $total_points += $quiz->point;
        }

        $quizzes_done = QuizStudent::where([['student_id', $id], ['isSuccess', 1]])->get();

        $quiz_points = 0;

        foreach ($quizzes_done as $quiz_done) {
            $quiz_points += (int) Quiz::find($quiz_done->quiz_id)->pluck('point')->first();
        }

        $user = User::find(Auth::user()->id);

        return view($view, ['user' => $user, 'student' => $student, 'quizzes' => $quizzes, 'quizzes_done' => $quizzes_done, 'quiz_points' => $quiz_points, 'total_points' => $total_points]);
    }

    public function visualize($id) {
        return $this->getStudentInformation($id, 'admin/usersManagement/studentDetails');
    }

    public function details() {
        return $this->getStudentInformation(Auth::user()->id, 'student/studentDetails');
    }

    public function edit() {
        $student = $this->getCurrentStudent(Auth::user()->id);

        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            $classroom->school = School::find($classroom->school_id);
            $teacher = Teacher::find($classroom->teacher_id);
            if ($teacher)
                $classroom->teacher = User::find($teacher->user_id);
            $classroom->classStudents = ClassStudent::where('classroom_id', $classroom->id)->get();
        }

        $classStudent = ClassStudent::where('student_id', $student->id)->first();
        if ($classStudent)
            $student->classroom_id = $classStudent->classroom_id;

        return view('student/studentEdit', ['student' => $student, 'classrooms' => $classrooms]);
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        $classStudent = ClassStudent::where('student_id', $user->id)->get();

        if ($classStudent->count() > 0) {


            $classStudent->first()->update([
                'classroom_id' => $request->input('classroom_id')
            ]);
        }
        else {
            ClassStudent::create([
                'classroom_id' => $request->input('classroom_id'),
                'student_id' => $user->id
            ])->push();
        }

        return redirect('student')->with('successEdit', 'Profil modifié avec succès !');
    }

    public function progression() {
        $user = User::find(Auth::user()->id);

        $quizzes_done = QuizStudent::where([['student_id', $user->id], ['isSuccess', 1]])->get();
        $quizzes = Quiz::all();

        $quizzes_by_theme = Misc::getQuizByTheme($quizzes, $quizzes_done);

        return view('student/studentProgression', ['quizzes_by_theme' => $quizzes_by_theme]);
    }

}
