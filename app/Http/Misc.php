<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 04/11/2017
 * Time: 14:19
 */
namespace App\Http;

use App\Http\ImageHandler;
use App\Quiz;
use App\Theme;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class Misc
{
    public static function getQuizByTheme($quizzes, $quizzes_done) {
        $quizzes_by_theme = array();

        foreach ($quizzes as $quiz) {
            $theme = Theme::find($quiz->theme_id);
            if (!Misc::array_key_exists_r($theme->id, $quizzes_by_theme)) {
                $item = array(
                    "id" => $theme->id,
                    "theme" => $theme->title,
                    "quiz" => array(),
                    "score" => 0,
                    "max_point" => $theme->max_point
                );
                array_push($quizzes_by_theme, $item);
            }

            array_push($quizzes_by_theme[array_search($theme->id, array_column($quizzes_by_theme, "id"))]["quiz"], $quiz);

            if ($quizzes_done != null) {
                foreach ($quizzes_done as $quiz_done) {
                    $quizzes_by_theme[array_search($theme->id, array_column($quizzes_by_theme, "id"))]["score"] += (int) Quiz::find($quiz_done->quiz_id)->pluck('point')->first();
                }
            }
        }

        return $quizzes_by_theme;
    }

    public static function array_key_exists_r($needle, $haystack)
    {
        $result = array_key_exists($needle, $haystack);
        if ($result)
            return $result;
        foreach ($haystack as $v) {
            if (is_array($v)) {
                $result = Misc::array_key_exists_r($needle, $v);
                if ($result)
                    return $result;
            }
        }
        return $result;
    }

    public static function uploadOnDisk($field, $storage, $isImage) {
        $location = null;
        if ($isImage) {
            $item = $_FILES[$field];
            $imageHandler = new ImageHandler();
            $location = uniqid() . $imageHandler->uploadImageOnDisk($item);
        } else {
            $item = Input::file($field);
            $location = uniqid() . $item->getClientOriginalName();
            Storage::disk($storage)->put($location, file_get_contents($item->getRealPath()));
        }
        return $location;
    }
}