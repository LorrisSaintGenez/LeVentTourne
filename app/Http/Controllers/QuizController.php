<?php

namespace App\Http\Controllers;

use App\Http\ImageHandler;
use App\Http\Misc;
use App\Quiz;
use App\QuizStudent;
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

        if ($themes->count() == 0)
            return redirect('backoffice/themes/create')->with('noTheme', 'Créez un thème avant de créer un quiz.');

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
            'victory_sound' => 'mimes:mpga',
            'defeat_sound' => 'mimes:mpga',
            'explanation' => 'required',
            'timer' => 'required',
        ]);

        $locationPicture = null;
        $locationSound = null;
        $locationVictorySound = null;
        $locationDefeatSound = null;
        $videoPath = null;

        if (Input::file('picture') != null)
            $locationPicture = Misc::uploadOnDisk('picture', 'images', true);
        if (Input::file('sound') != null)
            $locationSound = Misc::uploadOnDisk('sound', 'sounds', false);

        if (Input::file('victory_sound') != null)
            $locationVictorySound = Misc::uploadOnDisk('victory_sound', 'sounds', false);
        if (Input::file('defeat_sound') != null)
            $locationDefeatSound = Misc::uploadOnDisk('defeat_sound', 'sounds', false);

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        $theme_title = html_entity_decode($request->input('theme'));

        $theme = Theme::where('title', $theme_title)->first();

        $answers_array = array();
        array_push($answers_array, $request->input('good_answer'));
        array_push($answers_array, $request->input('answer_2'));

        if ($request->input('answer_3') != "")
            array_push($answers_array, $request->input('answer_3'));
        if ($request->input('answer_4') != "")
            array_push($answers_array, $request->input('answer_4'));

        $answers = serialize($answers_array);

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
            'explanation' => $request->input('explanation'),
            'victory_sound' => $locationVictorySound,
            'defeat_sound' => $locationDefeatSound,
            'timer' => $request->input('timer')
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
        if ($quiz->victory_sound != null)
            $quiz->victory_sound = base64_encode(Storage::disk('sounds')->get($quiz->victory_sound));
        if ($quiz->defeat_sound != null)
            $quiz->defeat_sound = base64_encode(Storage::disk('sounds')->get($quiz->defeat_sound));
        if ($quiz->picture != null)
            $quiz->picture = base64_encode(Storage::disk('images')->get($quiz->picture));

        $themes = Theme::all();

        $quiz->answers = unserialize($quiz->answers);

        return view('admin/quizzes/editQuiz', ['quiz' => $quiz, 'themes' => $themes]);
    }

    public function getAllQuizzes($view) {

        $quizzes_by_theme = Misc::getThemesWithQuizzes(Quiz::all(), null);

        return view($view, ['quizzes_by_theme' => $quizzes_by_theme]);
    }

    public function getAllQuizzesStudent() {

        $user = User::find(Auth::user()->id);

        $quizzes_done = QuizStudent::where([['student_id', $user->id], ['isSuccess', 1]])->get();
        $quizzes = Quiz::all();

        $themes_with_quizzes = Misc::getThemesWithQuizzes($quizzes, $quizzes_done);

        return view('quizzes/allQuizzes', ['themes_with_quizzes' => $themes_with_quizzes]);
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
            'victory_sound' => 'mimes:mpga',
            'defeat_sound' => 'mimes:mpga',
            'explanation' => 'required',
            'timer' => 'required',
        ]);

        $locationPicture = $quiz->picture;
        $locationSound = $quiz->sound;
        $locationVictorySound = $quiz->victory_sound;
        $locationDefeatSound = $quiz->defeat_sound;
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
            $locationSound = uniqid() . $item->getClientOriginalName();
            if ($quiz->sound != null)
                Storage::disk('sounds')->delete($quiz->sound);
            Storage::disk('sounds')->put($locationSound, file_get_contents($item->getRealPath()));
        }

        if (Input::file('victory_sound') != null) {
            $item = Input::file('victory_sound');
            $locationVictorySound = uniqid() . $item->getClientOriginalName();
            if ($quiz->victory_sound != null)
                Storage::disk('sounds')->delete($quiz->victory_sound);
            Storage::disk('sounds')->put($locationVictorySound, file_get_contents($item->getRealPath()));
        }

        if (Input::file('defeat_sound') != null) {
            $item = Input::file('defeat_sound');
            $locationDefeatSound = uniqid() . $item->getClientOriginalName();
            if ($quiz->defeat_sound != null)
                Storage::disk('sounds')->delete($quiz->defeat_sound);
            Storage::disk('sounds')->put($locationDefeatSound, file_get_contents($item->getRealPath()));
        }

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        $theme_title = html_entity_decode($request->input('theme'));

        $new_theme = Theme::where('title', $theme_title)->first();
        $previous_theme = Theme::find($quiz->theme_id);
        if ($new_theme->id != $previous_theme->id) {
            $new_theme->update([
                'max_point' => $new_theme->max_point + $request->input('point')
            ]);

            $previous_theme->update([
                'max_point' => $previous_theme->max_point - $request->input('point')
            ]);
        }

        $answers_array = array();
        array_push($answers_array, $request->input('good_answer'));
        array_push($answers_array, $request->input('answer_2'));

        if ($request->input('answer_3') != "")
            array_push($answers_array, $request->input('answer_3'));
        if ($request->input('answer_4') != "")
            array_push($answers_array, $request->input('answer_4'));

        $answers = serialize($answers_array);

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
            'explanation' => $request->input('explanation'),
            'victory_sound' => $locationVictorySound,
            'defeat_sound' => $locationDefeatSound,
            'timer' => $request->input('timer')
        ]);

        return redirect('backoffice/quiz')->with('successEdit', 'Quiz modifié avec succès !');
    }

    public function getQuiz($id) {
        return $this->getSpecificQuiz($id, 'quizzes/getQuiz', true);
    }

    public function visualize($id) {
        return $this->getSpecificQuiz($id, 'admin/quizzes/visualizeQuiz');
    }

    public function getSpecificQuiz($id, $view, $isStudent = false)
    {
        if ($isStudent) {
            $quiz = Misc::getUndoneQuizzesByThemeId($id);

            if (!$quiz)
                return redirect('/quiz/map')->with('successQuiz', 'Vous n\'avez plus de question disponible pour ce thème !');

            $user = User::find(Auth::user()->id);

            $quiz_student = QuizStudent::where([['student_id', $user->id], ['quiz_id', $quiz->id]])->first();
            if ($quiz_student) {
                if (!$quiz_student->hasAnswered) {
                    $quiz_student->update([
                        'hasAnswered' => true
                    ]);
                }

                return redirect('/quiz/map')->with('failQuiz', 'Vous avez déjà répondu à ce quiz !');
            }

            $answers = unserialize($quiz->answers);
            shuffle($answers);
            $quiz->answers = $answers;

            $theme = Theme::find($id);
            $quiz->theme = $theme->title;

            QuizStudent::create([
                'student_id' => $user->id,
                'quiz_id' => $quiz->id,
                'isSuccess' => false,
                'hasAnswered' => false
            ])->push();

            if ($quiz->defeat_sound != null)
                $quiz->defeat_sound = base64_encode(Storage::disk('sounds')->get($quiz->defeat_sound));
            if ($quiz->victory_sound != null)
                $quiz->victory_sound = base64_encode(Storage::disk('sounds')->get($quiz->victory_sound));
            if ($quiz->sound != null)
                $quiz->sound = base64_encode(Storage::disk('sounds')->get($quiz->sound));
            if ($quiz->picture != null)
                $quiz->picture = base64_encode(Storage::disk('images')->get($quiz->picture));
            return view($view, ['quiz' => $quiz]);

        } else {

            $quiz = Quiz::find($id);
            $theme = Theme::find($quiz->theme_id);

            $quiz->theme = $theme->title;
            $quiz->answers = unserialize($quiz->answers);

            if ($quiz->sound != null)
                $quiz->sound = base64_encode(Storage::disk('sounds')->get($quiz->sound));
            if ($quiz->picture != null)
                $quiz->picture = base64_encode(Storage::disk('images')->get($quiz->picture));
            return view($view, ['quiz' => $quiz]);
        }
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
