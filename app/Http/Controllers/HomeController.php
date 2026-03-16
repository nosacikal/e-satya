<?php

namespace App\Http\Controllers;

use App\Models\Department;

class HomeController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('public.home', compact('departments'));
    }
}
