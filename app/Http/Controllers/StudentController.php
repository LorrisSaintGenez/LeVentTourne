<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizStudent;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $users = User::where('role', '2')->get();

        foreach ($users as $user) {
            $teacher_id = Student::where('student_id', $user->id)->pluck('teacher_id')->first();
            $user->teacher = User::where('id', $teacher_id)->pluck('name')->first();
        }

        $users = $users->sortBy('teacher');

        return view('admin/usersManagement/studentsList', ['users' => $users]);
    }

    public function visualize($id) {

        $student = User::find($id);
        $student->teacher = User::find(Student::where("student_id", $id)->pluck('teacher_id'))->first();

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

        return view('admin/usersManagement/studentDetails',
            ['student' => $student, 'quizzes' => $quizzes, 'quizzes_done' => $quizzes_done, 'quiz_points' => $quiz_points, 'total_points' => $total_points]);
    }
}
