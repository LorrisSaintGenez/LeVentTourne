<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizStudent;
use App\Student;
use App\User;
use App\Http\Misc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {
        $users = User::where('role', '2')->get();

        foreach ($users as $user) {
            $teacher_id = Student::where('user_id', $user->id)->pluck('teacher_id')->first();
            $user->teacher = User::where('id', $teacher_id)->first();
        }

        $users = $users->sortBy('teacher');

        return view('admin/usersManagement/studentsList', ['users' => $users]);
    }

    public function getCurrentStudent($id)
    {
        $student = User::find($id);
        $student->teacher = User::find(Student::where('user_id', $id)->pluck('teacher_id'))->first();
        return $student;
    }

    public function getStudentInformation($id, $view)
    {
        $student = $this->getCurrentStudent($id);

        $quizzes = Quiz::all();

        $total_points = 0;

        foreach ($quizzes as $quiz) {
            $total_points += $quiz->point;
        }

        $student_id = Student::where('user_id', $id)->pluck('id')->first();

        $quizzes_done = QuizStudent::where([['student_id', $student_id], ['isSuccess', 1]])->get();

        $quiz_points = 0;

        foreach ($quizzes_done as $quiz_done) {
            $quiz_points += (int) Quiz::find($quiz_done->quiz_id)->pluck('point')->first();
        }

        return view($view, ['student' => $student, 'quizzes' => $quizzes, 'quizzes_done' => $quizzes_done, 'quiz_points' => $quiz_points, 'total_points' => $total_points]);
    }

    public function visualize($id) {
        return $this->getStudentInformation($id, 'admin/usersManagement/studentDetails');
    }

    public function details() {
        return $this->getStudentInformation(Auth::user()->id, 'student/studentDetails');
    }

    public function edit() {
        $student = $this->getCurrentStudent(Auth::user()->id);

        $teachers = User::where('role', 1)->orderBy('name')->get();

        return view('student/studentEdit', ['student' => $student, 'teachers' => $teachers]);
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        $student = Student::where('user_id', $user->id);

        $student->update([
            'teacher_id' => $request->input('teacher_id')
        ]);

        return redirect('student')->with('successEdit', 'Profil modifié avec succès !');
    }

    public function progression() {
        $user = User::find(Auth::user()->id);
        $student = Student::where('user_id', $user->id)->first();

        $quizzes_done = QuizStudent::where([['student_id', $student->id], ['isSuccess', 1]])->get();
        $quizzes = Quiz::all();

        $quizzes_by_theme = Misc::getQuizByTheme($quizzes, $quizzes_done);

        return view('student/studentProgression', ['quizzes_by_theme' => $quizzes_by_theme]);
    }

}
