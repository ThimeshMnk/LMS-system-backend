@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">

 @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Add Lecture to: {{ $course->title }}</h1>
    </div>

    <form action="{{ route('admin.lectures.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm space-y-6">
            <div>
                <label class="block text-sm font-semibold mb-2">Lecture Title</label>
                <input type="text" name="title" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g. 01. Introduction to the course">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold mb-2">Google Drive URL</label>
                    <input type="url" name="gdrive_url" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Paste G-Drive link here">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Duration (e.g. 15 mins)</label>
                    <input type="text" name="duration" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="15:00">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Lecture Thumbnail (Optional)</label>
                <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.courses.show', $course->id) }}" class="px-6 py-3 rounded-xl font-bold text-gray-500">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg">
                Save Lecture
            </button>
        </div>
    </form>
</div>
@endsection