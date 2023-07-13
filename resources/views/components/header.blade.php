<div>
    <header
        @class([
            'bg-blue-50' => Route::current()->getName() !== 'home',
            'bg-blue-500' => Route::current()->getName() === 'home',
            'p-6',
            'text-center',
            'text-white' => Route::current()->getName() === 'home',
            'text-blue-500' => Route::current()->getName() !== 'home',
            'font-bold',
            'text-xl'
        ])
    >
        <div class="max-w-7xl mx-auto lg:w-2/6 flex items-center">
            <globalnav :open="true"></globalnav>
            <span class="text-center w-full uppercase">{{ $title }}</span>
            @auth
            <a
                @class([
                    'flex',
                    'items-center',
                    'gap-4',
                    'text-white' => Route::current()->getName() === 'home',
                    'text-blue-500' => Route::current()->getName() !== 'home',
                    'uppercase',
                    'font-bold',
                    'text-xs',
                ])
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </a>
            @endauth
        </div>
    </header>
</div>