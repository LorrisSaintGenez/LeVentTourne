<?php

namespace App\Http\ViewComposers;

use App\Quiz;
use App\QuizStudent;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::user() && Auth::user()->role == 2) {

            $score = 0;

            $user = User::find(Auth::user()->id);
            $quizzes_done = QuizStudent::where([['student_id', $user->id], ['isSuccess', 1]])->get();

            foreach ($quizzes_done as $quiz_done) {
                $quiz = Quiz::find($quiz_done->quiz_id);
                $score += (int)$quiz->point;
            }

            $max_score = 0;

            $quizzes = Quiz::all();

            foreach ($quizzes as $quiz) {
                $max_score += (int) $quiz->point;
            }

            $data = array(
                'score' => $score,
                'max_score' => $max_score
            );

            $view->with('data', $data);
        }
    }
}