@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Create New Course</h1>
    </div>

    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
            <div class="grid gap-6">
                {{-- Course Title --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Course Title</label>
                    <input type="text" name="title" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g. Fullstack Web Development">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Enrollment Key --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Enrollment Key (Optional)</label>
                        <input type="text" name="enrollment_key" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g. WELCOME2024">
                    </div>
                    {{-- Course Image --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Course Thumbnail</label>
                        <input type="file" name="image" class="w-full px-4 py-2 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg">
                Create Course
            </button>
        </div>
    </form>
</div>
@endsection