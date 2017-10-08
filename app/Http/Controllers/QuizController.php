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

        if (Input::file('picture') != null)
            $locationPicture = $this->uploadOnDisk('picture', 'images', true);
        if (Input::file('sound') != null)
            $locationSound = $this->uploadOnDisk('sound', 'sounds', false);

        Quiz::create([
            'title' => $request->input('title'),
            'question' => $request->input('question'),
            'answer_1' => $request->input('answer_1'),
            'answer_2' => $request->input('answer_2'),
            'answer_3' => $request->input('answer_3'),
            'answer_4' => $request->input('answer_4'),
            'solution' => (int) $request->input('solution'),
            'point' => $request->input('point'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $this->YoutubeID($request->input('video')),
        ])->push();

        return redirect()->route('backoffice');
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

        return view('admin/editQuiz', ['quiz' => $quiz]);
    }

    public function getAllQuizzes() {
        $quizzes = Quiz::all();
        return view('admin/allQuizzes', ['quizzes' => $quizzes]);
    }
}
