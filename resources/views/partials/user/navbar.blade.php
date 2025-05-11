<header class="bg-compound shadow-sm sticky top-0 z-40">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end items-center h-16">
            <div class="flex items-center">
                <button type="button" class="p-1 rounded-full text-white hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-greenSlate mr-4">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>

                <div class="ml-3 relative">
                    <div>
                        <button type="button" class="max-w-xs bg-white rounded-full border border-white flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-greenSlate" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=random&color=fff" alt="User avatar">
                        </button>
                    </div>
                </div>

                 <form method="POST" action="{{ route('logout') }}" class="ml-4">
                     @csrf
                     <button type="submit" class="text-sm text-white hover:text-gray-100 cursor-pointer logout-button">Logout</button>
                 </form>
            </div>
        </div>
    </div>
</header>
