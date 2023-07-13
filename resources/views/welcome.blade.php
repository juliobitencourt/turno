@extends("main")

@section("content")
    <header class="bg-blue-500 p-6 pt-24 text-center text-white font-bold text-2xl">
        BNB Bank
    </header>
    <div class="relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white">
        <div class="max-w-7xl mx-auto lg:w-2/6 p-6 lg:p-8 mt-6">
            <form action="{{ route('register') }}" method="post" class="flex flex-col gap-6">
                @csrf
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" autofocus>
                    @error('name')
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="email" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}" >
                    @error('email')
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}" >
                    @error('password')
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Your Password" value="{{ old('password_confirmation') }}" >
                    @error('password_confirmation')
                        <span class="text-red-500 px-3 py-1 text-xs font-semibold">{{ $message }}</span>
                    @enderror
                </div>
                <input class="rounded bg-blue-500 hover:bg-blue-600 transition-colors cursor-pointer w-full mt-6 text-center text-white p-4 uppercase font-bold text-sm" type="submit" value="Sign Up">
                <hr class="w-1/3 mx-auto">
            </form>
            @if (Route::has('login'))
                <div class="flex justify-center gap-4 mt-3">
                    @auth
                        @if (Auth::user()->isCustomer())
                            <a
                                href="{{ url('/home') }}"
                                class="font-semibold text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500"
                            >
                                Home
                            </a>
                        @else
                            <a
                                href="{{ url('/admin/checks') }}"
                                class="font-semibold text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500"
                            >
                                Manage Checks
                            </a>
                        @endif
                        <a
                            href="{{ route('logout') }}"
                            class="font-semibold text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500"
                            onclick="event.preventDefault(); console.log(document.getElementById('logout-form')); document.getElementById('logout-form').submit();"
                        >
                            Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="mx-auto font-semibold text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Already Have an Account?</a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
@endsection
