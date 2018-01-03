<?php

namespace App\Http\Controllers;

use App\Http\Misc;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function creation() {

        $themes = Theme::all();

        foreach ($themes as $theme) {
            if ($theme->picture != null)
                $theme->picture = base64_encode(Storage::disk('images')->get($theme->picture));
        }

        return view('admin/themes/createTheme', ['themes' => $themes]);
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'unique:themes|max:255|required',
        ]);

        $locationPicture = null;

        if (Input::file('picture') != null)
            $locationPicture = Misc::uploadOnDisk('picture', 'images', true);

        Theme::create([
            'title' => $request->input('title'),
            'max_point' => 0,
            'picture' => $locationPicture
        ])->push();

        return redirect('backoffice/themes/create')->with('successTheme', 'Thème crée !');
    }
}
