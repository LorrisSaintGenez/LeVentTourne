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
    public function creation() {
        $schools = School::all();

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

        return redirect('teacher')->with('successClassroom', "Classe créée avec succès !");
    }

    public function visualizeClassroom($id) {
        return $this->getClassroomVisualization('admin/usersManagement/studentsList', $id);
    }

    public function visualizeMyClassroom($id) {
        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $classroom = Classroom::find($id);

        if (!$classroom || $teacher->id != $classroom->teacher_id)
            return back();

        return $this->getClassroomVisualization('student/studentsList', $id);
    }

    public function getClassroomVisualization($view, $id) {
        $classroom = Classroom::find($id);
        $classStudents = ClassStudent::where('classroom_id', $classroom->id)->get();
        $students = array();

        foreach ($classStudents as $classStudent) {
            $student = User::where('id', $classStudent->student_id)->first();
            $classroom->school = School::find($classroom->school_id);
            $student->classroom = $classroom;
            array_push($students, $student);
        }

        return view($view, ['users' => $students]);
    }
}
