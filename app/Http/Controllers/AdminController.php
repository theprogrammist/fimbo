<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', ['users' => $users]);
    }

    public function staticContent()
    {

        return view('admin.static-content');
    }
}
