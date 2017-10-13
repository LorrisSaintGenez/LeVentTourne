<?php

namespace App\Http\Controllers;

use App\Http\ImageHandler;
use App\Quiz;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'sound' => 'mimes:mp3',
            'title' => 'unique'
        ]);
    }

    public function uploadOnDisk($field, $storage, $isImage) {
        $location = null;
        if ($isImage) {
            $item = $_FILES[$field];
            $imageHandler = new ImageHandler();
            $location = $imageHandler->uploadImageOnDisk($item);
        } else {
                $item = Input::file($field);
                $location = $item->getClientOriginalName();
                Storage::disk($storage)->put($location, file_get_contents($item->getRealPath()));
            }
        return $location;
    }

    public function create(Request $request) {

        $locationPicture = null;
        $locationSound = null;
        $videoPath = null;

        if (Input::file('picture') != null)
            $locationPicture = $this->uploadOnDisk('picture', 'images', true);
        if (Input::file('sound') != null)
            $locationSound = $this->uploadOnDisk('sound', 'sounds', false);

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        Quiz::create([
            'title' => $request->input('title'),
            'theme' => $request->input('theme'),
            'question' => $request->input('question'),
            'answer_1' => $request->input('answer_1'),
            'answer_2' => $request->input('answer_2'),
            'answer_3' => $request->input('answer_3'),
            'answer_4' => $request->input('answer_4'),
            'solution' => (int) $request->input('solution'),
            'point' => $request->input('point'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $videoPath,
        ])->push();

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

        return view('admin/quizzes/editQuiz', ['quiz' => $quiz]);
    }

    public function getAllQuizzes() {

        $quizzes_water = Quiz::where('theme', 'water')->get();
        $quizzes_nature = Quiz::where('theme', 'nature')->get();
        $quizzes_food = Quiz::where('theme', 'food')->get();
        $quizzes_waste = Quiz::where('theme', 'waste')->get();

        return view('admin/quizzes/allQuizzes', ['quizzes_water' => $quizzes_water, 'quizzes_nature' => $quizzes_nature, 'quizzes_food' => $quizzes_food, 'quizzes_waste' => $quizzes_waste]);
    }

    public function update(Request $request) {

        $quiz = Quiz::find($request->input('id'));

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

        $quiz->update([
            'title' => $request->input('title'),
            'theme' => $request->input('theme'),
            'question' => $request->input('question'),
            'answer_1' => $request->input('answer_1'),
            'answer_2' => $request->input('answer_2'),
            'answer_3' => $request->input('answer_3'),
            'answer_4' => $request->input('answer_4'),
            'solution' => (int) $request->input('solution'),
            'point' => $request->input('point'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $videoPath,
        ]);

        return redirect('backoffice/quiz')->with('successEdit', 'Quiz modifié avec succès !');
    }

    public function visualize($id) {
        $quiz = Quiz::find($id);

        switch ($quiz->theme) {
            case "water":
                $quiz->theme = "Eau";
                break;
            case "food":
                $quiz->theme = "Nutrition";
                break;
            case "nature":
                $quiz->theme = "Nature";
                break;
            case "waste":
                $quiz->theme = "Tri des déchets";
                break;
        }

        if ($quiz->sound != null)
            $quiz->sound = base64_encode(Storage::disk('sounds')->get($quiz->sound));
        if ($quiz->picture != null)
            $quiz->picture = base64_encode(Storage::disk('images')->get($quiz->picture));

        return view('admin/quizzes/visualizeQuiz', ['quiz' => $quiz]);
    }

    public function delete($id) {

        $title = Quiz::find($id)->pluck('title')->first();

        Quiz::destroy($id);

        return redirect('backoffice/quiz')->with('successDelete', 'Quiz '.$title.' supprimé avec succès');
    }

}
