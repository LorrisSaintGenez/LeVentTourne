<?php

namespace App\Http\Controllers;

use App\Http\ImageHandler;
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

    public function edit(Request $request) {

        $theme = Theme::find($request->input('id'));

        $request->validate([
            'title-edit' => '|max:255|required|unique:themes,title,'.$theme->id,
        ]);

        $locationPicture = $theme->picture;

        if (Input::file('picture') != null) {
            $item = $_FILES['picture'];
            $imageHandler = new ImageHandler();
            $locationPicture = $imageHandler->updateImageOnDisk($item, $theme->picture);
        }

        $theme->update([
           "title" => $request->input('title-edit'),
           "picture" => $locationPicture
        ]);

        return redirect()->back();
    }

    public function removeImage($id) {

        $theme = Theme::find($id);

        Storage::disk('images')->delete($theme->picture);

        $theme->update([
           "picture" => null
        ]);

        return redirect()->back();
    }

    public function delete($id) {

        $theme = Theme::find($id);
        Storage::disk('images')->delete($theme->picture);

        Theme::destroy($id);

        return redirect()->back();
    }
}
