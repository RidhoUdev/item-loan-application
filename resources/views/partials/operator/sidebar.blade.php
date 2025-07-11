<aside id="adminSidebar" class="fixed inset-y-0 left-0 z-40 w-64 min-h-screen bg-greenSlate text-gray-800 p-4 flex flex-col shadow-lg
              transform -translate-x-full transition-transform duration-300 ease-in-out
              lg:translate-x-0 lg:static lg:inset-auto"
       aria-label="Sidebar">
    <div class="flex items-center gap-3 mb-8">
        <img src="{{ asset('img/logo-gopinjam.svg') }}" class="w-16">
        <span class="text-xl font-bold text-white">GoPinjam</span>
    </div>

    <nav class="flex-1">
        <h3 class="mb-2 text-xs font-semibold tracking-wider text-white uppercase">Menu</h3>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('operator.dashboard') }}"
                   class="relative flex items-center px-3 py-2.5 rounded-lg transition duration-150 ease-in-out group
                          {{ request()->routeIs('operator.dashboard*')
                             ? 'bg-neutralize text-cyan-900 font-semibold before:content-[\'\'] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-4/5 before:bg-greenSlate before:rounded-full'
                             : 'text-white hover:bg-neutralize hover:text-black' }}">
                    <div class="flex gap-3 items-center group">
                        <span class="iconify w-6 h-6 flex-shrink-0 {{ request()->routeIs('operator.dashboard*') ? 'text-black' : 'text-white group-hover:text-black' }}" data-icon="material-symbols:dashboard-rounded"></span>
                        <span class="text-md">Dashboard</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.items.index') }}"
                   class="relative flex items-center px-3 py-2.5 rounded-lg transition duration-150 ease-in-out group
                          {{ request()->routeIs('operator.items.index*')
                             ? 'bg-neutralize text-cyan-900 font-semibold before:content-[\'\'] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-4/5 before:bg-greenSlate before:rounded-full'
                             : 'text-white hover:bg-neutralize hover:text-black' }}">
                    <div class="flex gap-3 items-center">
                        <span class="iconify w-6 h-6 flex-shrink-0 {{ request()->routeIs('operator.items.index*') ? 'text-black' : 'text-white group-hover:text-black' }}" data-icon="solar:box-linear"></span>
                        <span class="text-md">Daftar Barang</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.requests.index') }}"
                   class="relative flex items-center px-3 py-2.5 rounded-lg transition duration-150 ease-in-out group
                          {{ request()->routeIs('operator.requests.index*')
                             ? 'bg-neutralize text-cyan-900 font-semibold before:content-[\'\'] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-4/5 before:bg-greenSlate before:rounded-full'
                             : 'text-white hover:bg-neutralize hover:text-black' }}">
                    <div class="flex items-center gap-3">
                        <span class="iconify w-6 h-6 flex-shrink-0 {{ request()->routeIs('operator.requests.index*') ? 'text-black' : 'text-white group-hover:text-black' }}" data-icon="mingcute:send-plane-fill"></span>
                        Daftar Permintaan
                    </div>
                </a>
            </li>
             <li>
                <a href="{{ route('operator.borrower.history.index') }}"
                   class="relative flex items-center px-3 py-2.5 rounded-lg transition duration-150 ease-in-out group
                          {{ request()->routeIs('operator.borrower.history.index*')
                             ? 'bg-neutralize text-cyan-900 font-semibold before:content-[\'\'] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-4/5 before:bg-greenSlate before:rounded-full'
                             : 'text-white hover:bg-neutralize hover:text-black' }}">
                    <div class="flex items-center gap-3">
                        <span class="iconify w-6 h-6 flex-shrink-0 {{ request()->routeIs('operator.borrower.history.index*') ? 'text-black' : 'text-white group-hover:text-black' }}" data-icon="ic:baseline-assignment-ind"></span>
                        Daftar Peminjam
                    </div>
                </a>
            </li>
        </ul>
    </nav>

    <div class="mt-auto pt-4 border-t border-cyan-200">
    </div>
</aside>
