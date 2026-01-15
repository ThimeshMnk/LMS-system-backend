@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">My Courses</h1>
    <a href="{{ route('admin.courses.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700">
        + Create New Course
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($courses as $course)
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition">
        <img src="{{ $course->thumbnail_url }}" class="h-48 w-full object-cover">
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800">{{ $course->title }}</h3>
            <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $course->description }}</p>
            <div class="mt-6 flex justify-between items-center">
                <span class="text-xs font-semibold px-2 py-1 bg-indigo-50 text-indigo-600 rounded">
                    {{ $course->lectures_count ?? $course->lectures->count() }} Lectures
                </span>
                <a href="{{ route('admin.courses.show', $course->id) }}" class="text-indigo-600 font-bold text-sm hover:underline">
                    Manage →
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 text-center">
        <p class="text-gray-400">No courses created yet.</p>
    </div>
    @endforelse
</div>
@endsection