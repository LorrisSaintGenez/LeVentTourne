<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassStudent;
use App\School;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index() {
        $usersTeachers = User::where('role', '1')->get();

        foreach ($usersTeachers as $usersTeacher ) {
            $teacher = Teacher::where('user_id', $usersTeacher->id)->first();
            $classrooms = Classroom::where('teacher_id', $teacher->id)->get();
            $usersTeacher->classrooms = $classrooms;
            $usersTeacher->teacher_id = $teacher->id;
        }

        $usersTeachers = $usersTeachers->sortBy('name');

        return view('admin/usersManagement/teachers', ['teachers' => $usersTeachers]);
    }

    public function classesByTeacher($id) {
        return $this->getClassesByTeacher('admin/usersManagement/classesByTeacher', $id);
    }

    public function getMyClasses() {
        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();
        return $this->getClassesByTeacher('classroom/classroomList', $teacher->id);
    }

    public function getClassesByTeacher($view, $id) {

        $classrooms = Classroom::where('teacher_id', $id)->get();

        $classesByTeacher = array();
        foreach ($classrooms as $classroom) {
            $classroom->school = School::find($classroom->school_id);
            $classStudents = ClassStudent::where('classroom_id', $classroom->id)->get();
            $classroom->classStudents = $classStudents;
            array_push($classesByTeacher, $classroom);
        }

        $teacher = User::find(Teacher::find($id)->user_id);

        return view($view, ['teacher' => $teacher, 'classrooms' => $classesByTeacher]);
    }

    public function details() {
        $user = User::find(Auth::user()->id);

        $teacher = Teacher::where('user_id', $user->id)->first();
        $school = School::find($teacher->school_id);
        $classrooms = Classroom::where('teacher_id', $teacher->id)->get();
        $user->classrooms = $classrooms;

        return view('teacher/teacherDetails', ['teacher' => $user, 'school' => $school]);
    }

    public function edit() {
        $user = User::find(Auth::user()->id);

        $teacher = Teacher::where('user_id', $user->id)->first();
        $classrooms = Classroom::where('school_id', $teacher->school_id)->where(function ($q) use ($teacher) {
            $q->where('teacher_id', null)
                ->orWhere('teacher_id', $teacher->id);
        })->get();

        foreach ($classrooms as $classroom) {
            $classroom->school = School::find($classroom->school_id);
        }
        $classroomsOfTeacher = Classroom::where('teacher_id', $teacher->id)->pluck('id')->toArray();

        return view('teacher/teacherEdit', ['teacher' => $user, 'classrooms' => $classrooms, 'classroomsOfTeacher' => $classroomsOfTeacher]);
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $classroomsOfTeacher = array_map('strval', Classroom::where('teacher_id', $teacher->id)->pluck('id')->toArray());

        if (isset($_POST['classroom_id'])) {

            foreach ($_POST['classroom_id'] as $index=>$class) {
                $classroom = Classroom::find($class);

                if ($classroom) {
                    if ($classroom->teacher_id && $classroom->teacher_id != $teacher->id) {
                        unset($_POST['classroom_id'][$index]);
                    }
                    else {
                        $classroom->update([
                            'teacher_id' => $teacher->id
                        ]);
                    }
                }
            }

            $removedClasses = array_diff($classroomsOfTeacher, $_POST['classroom_id']);

            foreach ($removedClasses as $removedClass) {
                $classroom = Classroom::find($removedClass);
                $classroom->update([
                    'teacher_id' => null
                ]);
            }
        }

        return $this->details();
    }

    public function editTeacherSchool() {
        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();
        $schools = School::all();

        return view('teacher/teacherEditSchool', ['teacher' => $teacher, 'schools' => $schools]);
    }

    public function updateTeacherSchool(Request $request) {
        $user = User::find(Auth::user()->id);
        $teacher = Teacher::where('user_id', $user->id)->first();

        if ((int)$request->input('school') != $teacher->school_id) {
            $classesTeacherSchool = Classroom::where('teacher_id', $teacher->id)->get();
            foreach ($classesTeacherSchool as $classTeacherSchool) {
                $classTeacherSchool->update([
                    'teacher_id' => null
                ]);
            }

            $teacher->update([
               'school_id' => (int) $request->input('school')
            ]);
        }

        return $this->details();
    }
}
