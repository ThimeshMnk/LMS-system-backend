<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // List all courses for the teacher
    public function index()
    {
        $courses = Course::where('user_id', Auth::id())->latest()->get();
        return view('teacher.courses.index', compact('courses'));
    }

    // Show create form
    public function create()
    {
        return view('teacher.courses.create');
    }

    // Store new course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'enrollment_key' => 'nullable|string|max:50',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
        }

        $course = Course::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'enrollment_key' => $request->enrollment_key,
        ]);

        return redirect()->route('admin.courses.show', $course->id)->with('success', 'Course created successfully!');
    }

    // Show a specific course and its lectures
    public function show($id)
    {
        $course = Course::with('lectures')->where('user_id', Auth::id())->findOrFail($id);
        return view('teacher.courses.show', compact('course'));
    }
}