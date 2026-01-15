<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ sidebarOpen: window.innerWidth > 1024 ? true : false }"
    @resize.window="if (window.innerWidth > 1024) sidebarOpen = true"
    class="h-full font-sans" x-cloak>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - LMS Admin</title>

    <link rel="icon" href="{{ asset('/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/debounce@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        /* Smooth scrolling for sidebar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-gray-50 overflow-hidden">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside
            class="fixed left-0 top-0 z-50 flex h-full w-64 flex-col bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <!-- SIDEBAR HEADER -->
            <div class="flex items-center justify-between gap-2 px-5 py-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-1.5 rounded-lg shadow-sm shadow-indigo-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">LMS Admin</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="no-scrollbar flex flex-col overflow-y-auto">
                <nav class="mt-1 py-2 px-4">
                    <div>
                        <h3 class="mb-4 ml-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Main Menu</h3>
                        <ul class="mb-6 flex flex-col gap-1.5">

                            <!-- Dashboard -->
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>

                            <!-- Courses Dropdown (Updated Logic) -->
                            <li x-data="{ open: {{ request()->routeIs('admin.courses.*') ? 'true' : 'false' }} }">
                                <a href="#" @click.prevent="open = !open"
                                    class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-gray-600 transition-all duration-200"
                                    :class="{ 'bg-gray-100': open }">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Courses
                                    <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 transition-transform" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <div x-show="open" x-cloak class="overflow-hidden transition-all duration-300">
                                    <ul class="mt-2 flex flex-col gap-1.5 pl-9">
                                        {{-- Fixed: Using admin.courses routes now --}}
                                        <li><a href="{{ route('admin.courses.index') }}" class="block text-sm py-1 {{ request()->routeIs('admin.courses.index') ? 'text-indigo-600 font-semibold' : 'text-gray-500 hover:text-indigo-600' }}">All Courses</a></li>
                                        <li><a href="{{ route('admin.courses.create') }}" class="block text-sm py-1 {{ request()->routeIs('admin.courses.create') ? 'text-indigo-600 font-semibold' : 'text-gray-500 hover:text-indigo-600' }}">Add Course</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Students -->
                            <li>
                                <a href="#" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-gray-600 transition-all duration-200 hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A10.004 10.004 0 0012 10a10.004 10.004 0 00-3-7.197"></path>
                                    </svg>
                                    Students
                                </a>
                            </li>

                            <!-- Quiz Results -->
                            <li>
                                <a href="#" class="group flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-gray-600 transition-all duration-200 hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Quiz Results
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </aside>

        {{-- Overlay for mobile --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-black/20 backdrop-blur-sm lg:hidden transition-opacity duration-300"
            x-transition:enter="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- MAIN WRAPPER --}}
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden transition-all duration-300 ease-in-out"
            :class="sidebarOpen ? 'lg:pl-0' : 'lg:pl-0'">

            @include('layouts.partials.header')

            <main class="flex-1">
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>