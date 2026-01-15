@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
        <p class="text-gray-500">Manage your curriculum and lectures</p>
    </div>
    <a href="{{ route('admin.lectures.create', ['course_id' => $course->id]) }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold">
        + Add Lecture
    </a>
</div>

<div class="grid grid-cols-1 gap-4">
    @forelse($course->lectures as $lecture)
    <div class="bg-white p-4 rounded-xl border border-gray-200 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">{{ $lecture->title }}</h3>
                <span class="text-xs text-gray-400">Duration: {{ $lecture->duration }} min | ID: {{ $lecture->gdrive_id }}</span>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="#" class="p-2 text-gray-400 hover:text-indigo-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></a>
            <button class="p-2 text-gray-400 hover:text-red-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
        </div>
    </div>
    @empty
    <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
        <p class="text-gray-400">No lectures added yet to this course.</p>
    </div>
    @endforelse
</div>
@endsection