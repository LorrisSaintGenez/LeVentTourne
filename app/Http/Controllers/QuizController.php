<?php

namespace App\Http\Controllers;

use App\Http\ImageHandler;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function create(Request $request) {

        $locationPicture = null;
        $locationSound = null;

        $img = Input::file('picture');
        if ($img != null) {
            $locationPicture = $img->getClientOriginalName();
            Storage::disk('images') -> put($locationPicture, file_get_contents($img -> getRealPath()));
        }

        $sound = Input::file('sound');
        if ($sound != null) {
            $locationSound = $sound->getClientOriginalName();
            Storage::disk('sounds') -> put($locationSound, file_get_contents($sound -> getRealPath()));
        }

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
            'video' => $request->input('video'),
        ])->push();

        return redirect()->route('backoffice');
    }
}
