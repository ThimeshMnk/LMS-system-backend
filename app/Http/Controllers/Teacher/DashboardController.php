<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'lectures' => Lecture::count(),
            'students' => User::where('role', 'student')->count(),
        ];
        return view('teacher.dashboard', compact('stats'));
    }
}