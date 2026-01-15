@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Your Lectures</h1>
    <a href="{{ route('admin.lectures.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700">
        + Add New
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-lg mb-6 border border-emerald-100">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Lecture Title</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Video ID</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Created At</th>
                <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($lectures as $lecture)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 font-medium">{{ $lecture->title }}</td>
                <td class="px-6 py-4 text-slate-500 text-sm font-mono">{{ $lecture->gdrive_id }}</td>
                <td class="px-6 py-4 text-slate-500 text-sm">{{ $lecture->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="#" class="text-indigo-600 hover:underline text-sm font-semibold">Add MCQ Quiz</a>
                    <button class="text-red-400 hover:text-red-600 text-sm">Delete</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                    No lectures found. Click "Add New" to begin.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection