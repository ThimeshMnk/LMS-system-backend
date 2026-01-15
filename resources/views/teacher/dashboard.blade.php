@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
    <p class="text-slate-500">Here's what's happening in your LMS.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <p class="text-slate-500 text-sm font-medium">Total Lectures</p>
        <h3 class="text-3xl font-bold mt-1">{{ $stats['lectures'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <p class="text-slate-500 text-sm font-medium">Enrolled Students</p>
        <h3 class="text-3xl font-bold mt-1">{{ $stats['students'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
        <p class="text-slate-500 text-sm font-medium">Quiz Completions</p>
        <h3 class="text-3xl font-bold mt-1">128</h3>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Quick Actions</h2>
    </div>
    <div class="flex gap-4">
        <a href="{{ route('admin.courses.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Add New Lecture</a>
        <a href="#" class="bg-slate-100 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-200">View Student Progress</a>
    </div>
</div>
@endsection