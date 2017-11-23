<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassStudent;
use App\School;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public static function getClassDetails($id) {
        $classroom = Classroom::find($id);

        if ($classroom) {

            $classroom = $classroom->first();

            $classroom->school = School::find($classroom->school_id);
            $classroom->teacher = User::find(Teacher::find($classroom->teacher_id));
            $classStudents = ClassStudent::where('classroom_id', $id)->get();

            $classroom->classStudents = $classStudents;

            return $classroom;
        }
        return null;
    }

    public function creation() {
        $schools = School::all();

        //dd($schools);

        if ($schools->count() == 0)
            return redirect('teacher/createSchool')->with('noSchool', 'Créez une école avant de créer une classe.');

        return view('classroom/classroomCreation', ['schools' => $schools]);
    }

    public function create(Request $request) {

        Classroom::create([
            'name' => $request->input('name'),
            'school_id' => $request->input('school'),
            'teacher_id' => null
        ])->push();

        return redirect('/')->with('successClassroom', "Classe créée avec succès !");
    }
}
