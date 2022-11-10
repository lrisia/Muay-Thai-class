<nav class="bg-gray-400 px-8 py-4 flex items-center">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <div class="">
            <a class="text-bold text-3xl" href="{{ url('/') }}">Muay Thai Class</a>
        </div>
        @auth
        <div class="flex items-center">
            <p class="mx-2 bg-white rounded-full py-2 px-4">{{ Auth::user()->name }}</p>
            <p class="mx-2 bg-white rounded-full py-2 px-4">{{ Auth::user()->role }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                        class="mx-2 bg-red-400 rounded-full py-2 px-4 text-white hover:bg-red-500">
                    <span class="material-symbols-outlined">ออกจากระบบ</span>
                </button>
            </form>
        </div>
        @else
        <div class="flex items-center">
            <a href="{{ route('login') }}"
               class="mx-2 bg-white rounded-full py-2 px-4 hover:bg-gray-100" @if(Route::currentRouteName() === 'login') current-page @endif" >
                Login
            </a>
            <a href="{{ route('register') }}"
               class="mx-2 bg-white rounded-full py-2 px-4 hover:bg-gray-100 @if(Route::currentRouteName() === 'register') current-page @endif" >
                Register
            </a>
        </div>
        @endauth
    </div>
</nav>
