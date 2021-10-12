<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(['id', 'name', 'email']);
        return response()->json($users);
    }
}
