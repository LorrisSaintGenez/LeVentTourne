<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function create(Request $request) {
        Theme::create([
            'title' => $request->input('title'),
            'max_point' => 0
        ])->push();

        return redirect('backoffice/themes/create');
    }
}
