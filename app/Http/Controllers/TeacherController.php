<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index() {
        $teachers = User::where('role', '1')->get();

        foreach ($teachers as $teacher) {
            $classrooms = Classroom::where('teacher_id', $teacher->id)->get();
            $teacher->classrooms = $classrooms;
        }

        $teachers = $teachers->sortBy('name');


        return view('admin/usersManagement/teachers', ['teachers' => $teachers]);
    }

    public function classesByTeacher($id) {
        $classrooms = Classroom::where('teacher_id', $id);

        $classesByTeacher = array();
        foreach ($classrooms as $classroom) {
            array_push($classesByTeacher, ClassroomController::getClassDetails($classroom->id));
        }

        $teacher = User::find($id);

        return view('admin/usersManagement/studentsByTeacher', ['teacher' => $teacher, 'classrooms' => $classesByTeacher]);
    }

    public function details() {
        $teacher = User::find(Auth::user()->id);
    }

    public function createSchool() {

    }

    /*public function getCurrentTeacher($id)
    {
        $teacher = User::find($id);
        $teacher->school = School::find($teacher->school_id);
        return $teacher;
    }

    public function getTeacherInformation($id)
    {
        $student = $this->getCurrentTeacher($id);

        $student_id = Student::where('user_id', $id)->pluck('id')->first();

        return view($view, ['student' => $student, 'quizzes' => $quizzes, 'quizzes_done' => $quizzes_done, 'quiz_points' => $quiz_points, 'total_points' => $total_points]);
    }*/
}
