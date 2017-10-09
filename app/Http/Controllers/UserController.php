<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::where('role', '!=', '0')->get();

        return view('admin/usersManagement/users', ['users' => $users]);
    }
}
