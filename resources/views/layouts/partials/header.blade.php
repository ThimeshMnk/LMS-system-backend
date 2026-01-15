<header class="sticky top-0 z-40 flex w-full bg-white shadow-sm border-b border-gray-100">
  <div class="flex flex-grow items-center justify-between px-4 py-2 md:px-6 2xl:px-11">

    <div class="flex items-center gap-2 sm:gap-4">
      <button @click.stop="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Search Bar -->
      <div class="hidden sm:block">
        <div class="relative">
          <span class="absolute left-0 top-1/2 -translate-y-1/2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </span>
          <input type="text" placeholder="Search lectures..." class="w-full bg-transparent pl-9 pr-4 text-black focus:outline-none" />
        </div>
      </div>
    </div>

    <div class="flex items-center gap-3">
      <!-- User Profile Dropdown -->
      <div class="relative" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-4">
          <span class="hidden text-right lg:block">
            <span class="block text-sm font-medium text-black">{{ auth()->user()->name }}</span>
            <span class="block text-xs text-gray-400 uppercase tracking-wider">Teacher</span>
          </span>
          <img class="h-10 w-10 rounded-full border border-gray-200" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff" alt="User" />
        </button>

        <div x-show="dropdownOpen" x-cloak class="absolute right-0 mt-4 flex w-60 flex-col rounded-lg border border-gray-200 bg-white shadow-xl">
          <ul class="flex flex-col gap-2 border-b border-gray-100 px-6 py-4">
            <li><a href="#" class="text-sm font-medium hover:text-indigo-600 transition-colors">My Profile</a></li>
          </ul>
          
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3.5 px-6 py-4 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-colors">
              Log Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>