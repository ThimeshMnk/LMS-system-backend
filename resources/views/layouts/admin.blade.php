<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ sidebarOpen: window.innerWidth > 1024 ? true : false }" 
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
    </style>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
          <aside 
            class="fixed left-0 top-0 z-50 flex h-full w-64 flex-col bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <!-- SIDEBAR HEADER -->
            <div class="flex items-center justify-between gap-2 px-5 py-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-white bg-indigo-600 rounded-md p-1" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 18h3V6H4v12zm5 0h3V9H9v9zm5 0h3V4h-3v14zm5 0h3V9h-3v9z"></path>
                    </svg>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">LMS Admin</span>
                </a>
                {{-- Close button for mobile --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>


         
            <div class="no-scrollbar flex flex-col overflow-y-auto">
                <nav class="mt-1 py-2 px-4">
                    <div>
                        <h3 class="mb-4 ml-4 text-sm font-semibold text-gray-500">MENU</h3>
                        <ul class="mb-6 flex flex-col gap-1.5">

                            <!-- Dashboard -->
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-indigo-600' : 'text-gray-600' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>

                            <!-- Lectures Dropdown -->
                            <li x-data="{ open: {{ request()->routeIs('admin.lectures.*') ? 'true' : 'false' }} }">
                                <a href="#" @click.prevent="open = !open"
                                    class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-gray-600 duration-300 ease-in-out hover:bg-gray-100"
                                    :class="{ 'bg-gray-100': open }">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Courses
                                    <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 transition-transform" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <div x-show="open" x-cloak class="overflow-hidden transition-all duration-300 ease-in-out">
                                    <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pl-6">
                                        <li><a href="{{ route('admin.lectures.index') }}" class="block rounded-md px-4 py-1 text-sm font-medium {{ request()->routeIs('admin.lectures.index') ? 'text-white bg-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">All Courses</a></li>
                                        <li><a href="{{ route('admin.lectures.create') }}" class="block rounded-md px-4 py-1 text-sm font-medium {{ request()->routeIs('admin.lectures.create') ? 'text-white bg-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">Add New</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Students -->
                            <li>
                                <a href="#" class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-gray-600 duration-300 ease-in-out hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A10.004 10.004 0 0012 10a10.004 10.004 0 00-3-7.197"></path>
                                    </svg>
                                    Students
                                </a>
                            </li>

                            <!-- Quiz Results -->
                            <li>
                                <a href="#" class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium text-gray-600 duration-300 ease-in-out hover:bg-gray-100">
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

         <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-black/20 backdrop-blur-sm lg:hidden transition-opacity duration-300"
            x-transition:enter="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="opacity-100" x-transition:leave-end="opacity-0"
        ></div>

        {{-- MAIN WRAPPER --}}
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden transition-all duration-300 ease-in-out"
            :class="sidebarOpen ? 'lg:pl-64' : 'lg:pl-0'">
            
            @include('layouts.partials.header')

            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @stack('scripts')
</body>
</html>