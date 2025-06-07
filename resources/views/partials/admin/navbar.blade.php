<header class="bg-compound shadow-sm sticky top-0 z-40"> 
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="navbar min-h-[4rem]">
            <div class="navbar-start">
                <div class="lg:hidden">
                    <button id="adminSidebarToggle" type="button"
                            class="p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pastelOrange cursor-pointer">
                        <span class="sr-only">Buka menu sidebar</span>
                        <span id="iconHamburger" class="iconify w-8 h-6 block text-white" data-icon="ci:hamburger-lg"></span>
                        <span id="iconClose" class="iconify w-8 h-6 hidden text-white" data-icon="mingcute:close-fill"></span>
                    </button>
                </div>
            </div>

            <div class="navbar-center">
                
            </div>

            <div class="navbar-end flex items-center">
                
                <div class="dropdown dropdown-end mr-2">
                    <label tabindex="0" class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                                <span class="badge badge-xs badge-error indicator-item">{{ $unreadNotificationsCount }}</span> 
                            @endif
                        </div>
                    </label>
                    <div tabindex="0" class="mt-3 z-[50] card card-compact dropdown-content w-64 sm:w-80 bg-base-100 shadow">
                        <div class="card-body p-0">
                            <div class="p-3 border-b border-base-300">
                                <h3 class="font-semibold text-sm">Notifikasi</h3>
                            </div>
                            <ul class="menu menu-sm max-h-72 overflow-y-auto">
                                @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                    @foreach($unreadNotifications as $notification)
                                        <li class="{{ $notification->read_at ? '' : 'bg-base-200 font-semibold' }}">
                                            <a href="{{ route('user.notifications.markAsRead', $notification->id) }}"
                                                class="notification-link whitespace-normal py-3">
                                                <div class="flex flex-col">
                                                    <p class="text-xs text-base-content/70">
                                                        {{ $notification->data['message'] ?? 'Notifikasi baru.' }}
                                                        @if(isset($notification->data['item_name']))
                                                            <span class="font-normal">({{ $notification->data['item_name'] }})</span>
                                                        @endif
                                                    </p>
                                                    <span class="text-xs text-base-content/50 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="p-4 text-center text-sm text-base-content/70">Tidak ada notifikasi baru.</li>
                                @endif
                            </ul>
                            @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                            <div class="p-2 border-t border-base-300 text-center">
                                <form method="POST" action="{{ route('user.notifications.markAllAsRead') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-ghost text-primary">Tandai semua dibaca</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full border-2 border-white/50"> 
                            <img alt="User Avatar" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'U') }}&background=random&color=fff&font-size=0.5" />
                        </div>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[50] p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            
                            <button type="button" class="w-full text-left justify-start" onclick="profile_modal.showModal()">
                                Profil Saya
                            </button>
                        </li>
                        <li>
                            
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left justify-start logout-button cursor-pointer">
                                    <span class="w-full">Logout</span>
                                </button>
                            </form> 
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>


@auth
    @include('profile', ['user' => Auth::user()])
@endauth