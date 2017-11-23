<?php

namespace App\Http\Controllers;

use App\School;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function create(Request $request) {
        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();

        School::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'zipcode' => $request->input('zipcode'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'created_by_teacher_id' => $teacher->id
        ])->push();

        return redirect('teacher')->with('successSchool', "Ecole créée avec succès !");
    }
}
