<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassStudent;
use App\Quiz;
use App\QuizStudent;
use App\School;
use App\Teacher;
use App\User;
use Illuminate\Support\Facades\Auth;

class ClassStudentController extends Controller
{
    public function visualizeClassStudent($id) {

        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $student = StudentController::getCurrentStudent($id);
        $classStudent = ClassStudent::where('student_id', $id)->first();

        if (!$classStudent)
            return back();

        $classroom = Classroom::find($classStudent->classroom_id);

        if ($classroom->teacher_id != $teacher->id)
            return back();

        $classroom->school = School::find($classroom->school_id);
        $classroom->teacher = $user;
        $classStudents = ClassStudent::where('classroom_id', $id)->get();
        $classroom->classStudents = $classStudents;
        $student->classroom = $classroom;

        $quizzes = Quiz::all();

        $total_points = 0;

        foreach ($quizzes as $quiz) {
            $total_points += $quiz->point;
        }

        $quizzes_done = QuizStudent::where([['student_id', $id], ['isSuccess', 1]])->get();

        $quiz_points = 0;

        foreach ($quizzes_done as $quiz_done) {
            $quiz = Quiz::find($quiz_done->quiz_id);
            $quiz_points += (int) $quiz->point;
        }

        $user = User::find(Auth::user()->id);

        return view('student/studentClassroomDetails', ['user' => $user, 'student' => $student, 'quizzes' => $quizzes, 'quizzes_done' => $quizzes_done, 'quiz_points' => $quiz_points, 'total_points' => $total_points]);
    }
}
