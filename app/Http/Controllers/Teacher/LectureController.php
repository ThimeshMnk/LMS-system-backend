<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class LectureController extends Controller
{
    public function index() {
        $lectures = Lecture::latest()->get();
        return view('teacher.lectures.index', compact('lectures'));
    }

    public function create() {
        return view('teacher.lectures.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'gdrive_url' => 'required|url',
        ]);

        // Extract G-Drive ID
        preg_match('/\/d\/(.*?)(\/|$)/', $request->gdrive_url, $matches);
        $fileId = $matches[1] ?? null;

        Lecture::create([
            'user_id' => Auth::id(), 
            'title' => $request->title,
            'description' => $request->description,
            'gdrive_id' => $fileId,
        ]);

        return redirect()->route('admin.lectures.index')->with('success', 'Lecture created!');
    }
}