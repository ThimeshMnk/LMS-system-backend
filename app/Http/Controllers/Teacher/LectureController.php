<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    // Show create form (linked to a course)
    public function create($course_id)
    {
        $course = Course::where('user_id', Auth::id())->findOrFail($course_id);
        return view('teacher.lectures.create', compact('course'));
    }

    // Store new lecture
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'gdrive_url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'duration' => 'nullable|string',
        ]);

        // 1. Extract G-Drive ID from various URL formats
        preg_match('/[-\w]{25,}/', $request->gdrive_url, $matches);
        $fileId = $matches[0] ?? null;

        if (!$fileId) {
            return back()->withErrors(['gdrive_url' => 'Invalid Google Drive link. Please ensure it is a valid file link.'])->withInput();
        }

        // 2. Handle Thumbnail Upload
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('lectures', 'public');
        }

        // 3. Create Lecture
        Lecture::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'title' => $request->title,
            'image' => $path,
            'gdrive_id' => $fileId,
            'duration' => $request->duration,
        ]);

        return redirect()->route('admin.courses.show', $request->course_id)->with('success', 'Lecture added to course!');
    }
}
