<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index() {
        $teachers = User::where('role', '1')->get();

        foreach ($teachers as $teacher) {
            $students = Student::where('teacher_id', $teacher->id);
            $teacher->students = $students;
        }

        $teachers = $teachers->sortBy('name');

        return view('admin/usersManagement/teachers', ['teachers' => $teachers]);
    }

    public function studentByTeacher($id) {
        $students_id = Student::where('teacher_id', $id)->pluck('student_id');

        $students = array();
        foreach ($students_id as $student_id) {
            array_push($students, User::find($student_id));
        }

        $teacher = User::find($id);

        return view('admin/usersManagement/studentsByTeacher', ['teacher' => $teacher, 'students' => $students]);
    }
}
