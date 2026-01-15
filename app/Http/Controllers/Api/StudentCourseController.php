<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\CourseResource;
use App\Models\Lecture;
use App\Http\Resources\LectureResource;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->withCount('lectures')->latest()->get();
        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = Course::with(['teacher', 'lectures'])->findOrFail($id);
        return new CourseResource($course);
    }

    public function showLecture($id)
{
    // Find the lecture and return it using the Resource we created earlier
    $lecture = Lecture::findOrFail($id);
    
    return new LectureResource($lecture);
}
}
