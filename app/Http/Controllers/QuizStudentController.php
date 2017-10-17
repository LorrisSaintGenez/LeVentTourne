<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizStudent;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizStudentController extends Controller
{
    public function answerQuiz(Request $request, $id)
    {
        $student_id = Student::where('user_id', Auth::user()->id)->pluck('id')->first();
        if (QuizStudent::where([['student_id', $student_id], ['quiz_id', $id]])->get() != null)
            return redirect('/quiz')->with('failQuiz', 'Vous avez déjà répondu à ce quiz !');

        $quiz = Quiz::find($id);

        if ($request->input($quiz->solution) != null) {
            QuizStudent::create([
                'student_id' => $student_id,
                'quiz_id' => $id,
                'isSuccess' => true
            ])->push();

            return redirect('/quiz')->with('successQuiz', 'Bonne réponse ! :)');
        }
        else {
            QuizStudent::create([
                'student_id' => Student::where('user_id', Auth::user()->id)->pluck('id')->first(),
                'quiz_id' => $id,
                'isSuccess' => false
            ])->push();
            return redirect('/quiz')->with('failQuiz', 'Mauvaise réponse ! :(');
        }
    }
}
