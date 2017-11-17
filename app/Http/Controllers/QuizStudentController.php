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
        $quiz_student = QuizStudent::where([['student_id', $student_id], ['quiz_id', $id], ['hasAnswered', true]])->first();
        if ($quiz_student != null)
            return redirect('/quiz')->with('failQuiz', 'Vous avez déjà répondu à ce quiz !');

        $quiz = Quiz::find($id);

        $quiz_student_update = QuizStudent::where([['student_id', $student_id], ['quiz_id', $id]])->first();

        if ($request->input($quiz->solution) != null) {
            $quiz_student_update->update([
                'student_id' => $student_id,
                'quiz_id' => $id,
                'isSuccess' => true,
                'hasAnswered' => true
            ]);
            return redirect('/quiz')->with('successQuiz', 'Bonne réponse ! :)');
        }
        else {
            $quiz_student_update->update([
                'student_id' => $student_id,
                'quiz_id' => $id,
                'isSuccess' => false,
                'hasAnswered' => true
            ]);
            return redirect('/quiz')->with('failQuiz', 'Mauvaise réponse ! :(');
        }
    }
}