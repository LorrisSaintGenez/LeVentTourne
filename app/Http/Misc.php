<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 04/11/2017
 * Time: 14:19
 */
namespace App\Http;

use App\Quiz;
use App\QuizStudent;
use App\Theme;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class Misc
{

    public static function mulSort($a,$b)
    {
        if(count($a['quiz']) > count($b['quiz']))
            return -1;
        else if(count($a['quiz']) < count($b['quiz']))
            return 1;
        else
            return 0;
    }

    public static function getThemesWithQuizzes($quizzes, $quizzes_done) {
        $themes = array();

        $all_themes = Theme::all();

        foreach ($all_themes as $theme) {
            $item = array(
                "id" => $theme->id,
                "theme" => $theme->title,
                "quiz" => array(),
                "score" => 0,
                "max_point" => $theme->max_point,
                "picture" => $theme->picture ? base64_encode(Storage::disk('images')->get($theme->picture)) : null
            );
            array_push($themes, $item);
        }

        foreach ($quizzes as $quiz) {
            $theme = Theme::find($quiz->theme_id);

            if (Auth::user()->role == 2) {
                // Cherche la non-existance d'un quiz afin de le proposer à l'élèvre
                $user = User::find(Auth::user()->id);
                $quiz_student = QuizStudent::where([['student_id', $user->id], ['quiz_id', $quiz->id]])->first();
                if (!$quiz_student)
                    array_push($themes[array_search($theme->id, array_column($themes, "id"))]["quiz"], $quiz);
            } else {
                // Push à l'index correspondant à son thème le quiz, dans l'array "quiz"
                array_push($themes[array_search($theme->id, array_column($themes, "id"))]["quiz"], $quiz);
            }
        }


        if ($quizzes_done != null) {
            foreach ($quizzes_done as $quiz_done) {
                $quiz = Quiz::find($quiz_done->quiz_id);
                $theme = Theme::find($quiz->theme_id);
                // Calcul le nombre du point de l'élève.
                $themes[array_search($theme->id, array_column($themes, "id"))]["score"] += (int) $quiz->point;
            }
        }

        usort($themes, array("App\Http\Misc", "mulSort"));

        return $themes;
    }

    public static function getUndoneQuizzesByThemeId($theme_id) {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            if ($quiz->theme_id == $theme_id) {
                $user = User::find(Auth::user()->id);
                $quiz_student = QuizStudent::where([['student_id', $user->id], ['quiz_id', $quiz->id]])->first();
                if (!$quiz_student)
                    return $quiz;
            }
        }

        return null;

    }

    public static function depthSearchIsInArray($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['id'] == $id)
                return true;
        }
        return false;
    }

    public static function array_key_exists_r($needle, $haystack)
    {
        if (array_key_exists($needle, $haystack))
            return true;
        foreach ($haystack as $v) {
            if (is_array($v)) {
                if (Misc::array_key_exists_r($needle, $v))
                    return true;
            }
        }
        return false;
    }

    public static function uploadOnDisk($field, $storage, $isImage) {
        $location = null;
        if ($isImage) {
            $item = $_FILES[$field];
            $imageHandler = new ImageHandler();
            $location = $imageHandler->uploadImageOnDisk($item);
        } else {
            $item = Input::file($field);
            $location = uniqid() . $item->getClientOriginalName();
            Storage::disk($storage)->put($location, file_get_contents($item->getRealPath()));
        }
        return $location;
    }
}