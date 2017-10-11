<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $users = User::where('role', '2')->get();

        foreach ($users as $user) {
            $teacher_id = Student::where('student_id', $user->id)->pluck('teacher_id')->first();
            $user->teacher = User::where('id', $teacher_id)->pluck('name')->first();
        }

        $users = $users->sortBy('teacher');

        return view('admin/usersManagement/students', ['users' => $users]);
    }

    public function visualize($id) {
        dd($id);
    }
}
