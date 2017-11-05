<?php

namespace App\Http\Controllers;

use App\Http\ImageHandler;
use App\Http\Misc;
use App\Quiz;
use App\QuizStudent;
use App\Student;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function creation() {
        $themes = Theme::all();

        return view('admin/quizzes/createQuiz', ['themes' => $themes]);
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'unique:quizzes|max:255|required',
            'question' => 'required|max:255',
            'good_answer' => 'required',
            'answer_2' => 'required',
            'point' => 'required',
            'sound' => 'mimes:mpga',
        ]);

        $locationPicture = null;
        $locationSound = null;
        $videoPath = null;

        if (Input::file('picture') != null)
            $locationPicture = Misc::uploadOnDisk('picture', 'images', true);
        if (Input::file('sound') != null)
            $locationSound = Misc::uploadOnDisk('sound', 'sounds', false);

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        $theme = Theme::where('title', $request->input('theme'))->first();

        $answers = array();
        array_push($answers, $request->input('good_answer'));
        array_push($answers, $request->input('answer_2'));

        if ($request->input('answer_3') != "")
            array_push($answers, $request->input('answer_3'));
        if ($request->input('answer_4') != "")
            array_push($answers, $request->input('answer_4'));

        Quiz::create([
            'title' => $request->input('title'),
            'theme_id' => $theme->id,
            'question' => $request->input('question'),
            'good_answer' => $request->input('good_answer'),
            'answers' => $answers,
            'point' => $request->input('point'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $videoPath,
        ])->push();

        $theme->update([
            'max_point' => $theme->max_point + $request->input('point')
        ]);

        return redirect('backoffice/quiz')->with('successQuiz', 'Quiz crée avec succès !');
    }

    function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return null;
        }

        return $url;
    }

    public function edit($id) {
        $quiz = Quiz::find($id);
        if ($quiz->sound != null)
            $quiz->sound = base64_encode(Storage::disk('sounds')->get($quiz->sound));
        if ($quiz->picture != null)
            $quiz->picture = base64_encode(Storage::disk('images')->get($quiz->picture));

        $themes = Theme::all();

        return view('admin/quizzes/editQuiz', ['quiz' => $quiz, 'themes' => $themes]);
    }

    public function getAllQuizzes($view) {

        $quizzes_by_theme = Misc::getQuizByTheme(Quiz::all(), null);

        return view($view, ['quizzes_by_theme' => $quizzes_by_theme]);
    }

    public function getAllQuizzesStudent() {

        $user = User::find(Auth::user()->id);
        $student = Student::where('user_id', $user->id)->first();

        $quizzes_done = QuizStudent::where([['student_id', $student->id], ['isSuccess', 1]])->get();
        $quizzes = Quiz::all();

        $quizzes_by_theme = Misc::getQuizByTheme($quizzes, $quizzes_done);

        foreach ($quizzes_by_theme as $quiz_by_theme) {
            foreach ($quiz_by_theme['quiz'] as $quiz){
                $quiz_student = QuizStudent::where([['student_id', Student::where('user_id', Auth::user()->id)->pluck('id')->first()], ['quiz_id', $quiz->id]])->first();
                if ($quiz_student != null) {
                    $quiz->exists = true;
                    $quiz->success = $quiz_student->isSuccess;
                }
                else
                    $quiz->exists = false;
            }
        }

        //return view('quizzes/allQuizzesTest', ['quizzes' => $quizzes]);
        return view('quizzes/allQuizzes', ['quizzes_by_theme' => $quizzes_by_theme]);
    }

    public function getAllQuizzesAdmin() {
        return $this->getAllQuizzes('admin/quizzes/allQuizzes');
    }

    public function update(Request $request) {

        $quiz = Quiz::find($request->input('id'));

        $request->validate([
            'title' => '|max:255|required|unique:quizzes,title,'.$quiz->id,
            'question' => 'required|max:255',
            'good_answer' => 'required',
            'answer_2' => 'required',
            'point' => 'required',
            'sound' => 'mimes:mpga',
        ]);

        $locationPicture = $quiz->picture;
        $locationSound = $quiz->sound;
        $videoPath = $quiz->video;

        if (Input::file('picture') != null) {
            $item = $_FILES['picture'];
            $imageHandler = new ImageHandler();
            if ($quiz->picture != null)
                $locationPicture = $imageHandler->updateImageOnDisk($item, $quiz->picture);
            else
                $locationPicture = $imageHandler->uploadImageOnDisk($item);
        }

        if (Input::file('sound') != null) {
            $item = Input::file('sound');
            $locationSound = $item->getClientOriginalName();
            if ($quiz->sound != null)
                Storage::disk('images')->delete($quiz->sound);
            Storage::disk('sounds')->put($locationSound, file_get_contents($item->getRealPath()));
        }

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        $new_theme = Theme::where('title', $request->input('theme'))->first();
        $previous_theme = Theme::find($quiz->theme_id);
        if ($new_theme->id != $previous_theme->id) {
            $new_theme->update([
                'max_point' => $new_theme->max_point + $request->input('point')
            ]);

            $previous_theme->update([
                'max_point' => $previous_theme->max_point - $request->input('point')
            ]);
        }

        $answers = array();
        array_push($answers, $request->input('good_answer'));
        array_push($answers, $request->input('answer_2'));

        if ($request->input('answer_3') != "")
            array_push($answers, $request->input('answer_3'));
        if ($request->input('answer_4') != "")
            array_push($answers, $request->input('answer_4'));

        $quiz->update([
            'title' => $request->input('title'),
            'theme_id' => $new_theme->id,
            'question' => $request->input('question'),
            'good_answer' => $request->input('good_answer'),
            'answers' => $answers,
            'point' => $request->input('point'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $videoPath,
        ]);

        return redirect('backoffice/quiz')->with('successEdit', 'Quiz modifié avec succès !');
    }

    public function getQuiz($id) {
        return $this->getSpecificQuiz($id, 'quizzes/getQuiz', true);
    }

    public function visualize($id) {
        return $this->getSpecificQuiz($id, 'admin/quizzes/visualizeQuiz');
    }

    public function getSpecificQuiz($id, $view, $isStudent = false) {
        $quiz = Quiz::find($id);
        $theme = Theme::find($quiz->theme_id);

        $quiz->theme = $theme->title;

        if ($isStudent) {
            $student_id = Student::where('user_id', Auth::user()->id)->pluck('id')->first();

            $quiz_student = QuizStudent::where([['student_id', $student_id], ['quiz_id', $id]])->first();
            if ($quiz_student) {
                if (!$quiz_student->hasAnswered) {
                    $quiz_student->update([
                        'student_id' => $student_id,
                        'quiz_id' => $id,
                        'isSuccess' => $quiz_student->isSuccess,
                        'hasAnswered' => true
                    ]);
                }
                return redirect('/quiz')->with('failQuiz', 'Vous avez déjà répondu à ce quiz !');
            }

            $answers = $quiz->answers;
            shuffle($answers);
            $quiz->answers = $answers;

            QuizStudent::create([
                'student_id' => $student_id,
                'quiz_id' => $id,
                'isSuccess' => false,
                'hasAnswered' => false
            ])->push();

        }

        if ($quiz->sound != null)
            $quiz->sound = base64_encode(Storage::disk('sounds')->get($quiz->sound));
        if ($quiz->picture != null)
            $quiz->picture = base64_encode(Storage::disk('images')->get($quiz->picture));

        return view($view, ['quiz' => $quiz]);
    }

    public function delete($id) {

        $quiz = Quiz::find($id);

        $theme = Theme::where('id', $quiz->theme_id)->first();

        $theme->update([
            'max_point' => $theme->max_point - $quiz->point
        ]);

        Quiz::destroy($id);

        return redirect('backoffice/quiz')->with('successDelete', 'Quiz '.$quiz->title.' supprimé avec succès');
    }

}
