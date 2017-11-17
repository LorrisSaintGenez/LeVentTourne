<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function creation() {

        $themes = Theme::all();

        return view('admin/themes/createTheme', ['themes' => $themes]);
    }

    public function create(Request $request) {

        $request->validate([
            'title' => 'unique:themes|max:255|required',
        ]);


        Theme::create([
            'title' => $request->input('title'),
            'max_point' => 0
        ])->push();

        return redirect('backoffice/themes/create')->with('successTheme', 'Thème crée !');
    }
}
