@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.lectures.index') }}" class="text-slate-500 hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold">Add New Lecture</h1>
    </div>

    <form action="{{ route('admin.lectures.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
            <div class="grid gap-6">
                <div>
                    <label class="block text-sm font-semibold mb-2">Lecture Title</label>
                    <input type="text" name="title" required class="w-full px-4 py-3 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. Introduction to React 18">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Google Drive Video Link</label>
                    <input type="url" name="gdrive_url" required class="w-full px-4 py-3 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500" placeholder="https://drive.google.com/file/d/xxxxxx/view">
                    <p class="text-xs text-slate-400 mt-2">Make sure the G-Drive permission is set to "Anyone with the link".</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Description (Optional)</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Describe what students will learn..."></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">
                Save & Continue
            </button>
        </div>
    </form>
</div>
@endsection