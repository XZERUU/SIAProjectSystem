<nav x-data="{ open: false }" class="bg-gray-900 text-white shadow-lg">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route(Auth::check() ? (Auth::user()->role === 'admin' ? 'dashboard' : (Auth::user()->role === 'user' ? 'user' : 'users.index')) : 'welcome') }}">
                    <x-application-logo class="h-10 w-10" />
                </a>
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex md:space-x-8 md:items-center">
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'underline' : '' }} hover:text-gray-300 font-semibold">Dashboard</a>
                @elseif(Auth::check() && Auth::user()->role === 'user')
                    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'underline' : '' }} hover:text-gray-300 font-semibold">User Page</a>
                    <a href="{{ route('plants.index') }}" class="{{ request()->routeIs('plants.*') ? 'underline' : '' }} hover:text-gray-300 font-semibold">Plants</a>
                    <a href="{{ route('sensors.globalIndex') }}" class="{{ request()->routeIs('sensors.*') ? 'underline' : '' }} hover:text-gray-300 font-semibold">Sensors</a>
                    <a href="{{ route('transactions.globalIndex') }}" class="{{ request()->routeIs('transactions.*') ? 'underline' : '' }} hover:text-gray-300 font-semibold">Transactions</a>
                @endif
            </div>

                {{-- Avatar and Logout --}}
                <div class="hidden md:flex md:items-center md:space-x-4">
<label for="avatar-upload" class="cursor-pointer">
    <img src="{{ auth()->check() && auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-profile.png') }}" alt="Avatar" class="w-10 h-10 rounded-full" />
</label>
<form id="avatar-upload-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="hidden">
    @csrf
    @method('patch')
    <input id="avatar-upload" type="file" name="avatar" accept="image/*" onchange="document.getElementById('avatar-upload-form').submit();" />
</form>
                    <span class="font-semibold">{{ auth()->check() ? Auth::user()->name : '' }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-600 font-semibold ml-4">
                            Log Out
                        </button>
                    </form>
                </div>

            {{-- Mobile menu button --}}
            <div class="flex md:hidden">
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile menu, show/hide with Alpine --}}
    <div x-show="open" x-cloak class="md:hidden bg-gray-800 border-t border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1">

            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-semibold hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
                <!-- Removed invalid route 'TotalPlants' -->
                
            @elseif(Auth::check() && Auth::user()->role === 'user')
                <a href="{{ route('user') }}" class="block px-3 py-2 rounded-md text-base font-semibold hover:bg-gray-700 {{ request()->routeIs('user') ? 'bg-gray-700' : '' }}">
                    User Page
                </a>
                <a href="{{ route('plants.index') }}" class="block px-3 py-2 rounded-md text-base font-semibold hover:bg-gray-700 {{ request()->routeIs('plants.*') ? 'bg-gray-700' : '' }}">
                    Plants
                </a>
                <a href="{{ route('sensors.globalIndex') }}" class="block px-3 py-2 rounded-md text-base font-semibold hover:bg-gray-700 {{ request()->routeIs('sensors.*') ? 'bg-gray-700' : '' }}">
                    Sensors
                </a>
                <a href="{{ route('transactions.globalIndex') }}" class="block px-3 py-2 rounded-md text-base font-semibold hover:bg-gray-700 {{ request()->routeIs('transactions.*') ? 'bg-gray-700' : '' }}">
                    Transactions
                </a>
            @endif

            <div class="border-t border-gray-700 mt-3 pt-3">
                <div class="flex items-center space-x-3 px-3">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" alt="Avatar" class="w-10 h-10 rounded-full" />
                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-3 px-3">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-md">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

</nav>
