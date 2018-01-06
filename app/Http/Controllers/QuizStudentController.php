<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizStudent;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuizStudentController extends Controller
{
    public function answerQuiz(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $quiz_student = QuizStudent::where([['student_id', $user->id], ['quiz_id', $id], ['hasAnswered', true]])->first();

        if ($quiz_student != null)
           return redirect('/quiz/map')->with('failQuiz', 'Vous avez déjà répondu à ce quiz !');

        $quiz = Quiz::find($id);

        $quiz_student_update = QuizStudent::where([['student_id', $user->id], ['quiz_id', $id]])->first();

        $ar = array();

        $ar = [
          "request" => $request,
          "good_answer" => $quiz->good_answer
        ];

        if ($request->input(str_replace(' ', '_', $quiz->good_answer)) != null) {
            $quiz_student_update->update([
                'isSuccess' => true,
                'hasAnswered' => true
            ]);
        }
        else {
            $quiz_student_update->update([
                'isSuccess' => false,
                'hasAnswered' => true
            ]);
        }

        return redirect()->route('quizGet', $request->input('theme_id'));
    }
}
