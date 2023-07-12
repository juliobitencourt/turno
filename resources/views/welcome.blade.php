@extends("app")

@section("content")
    <header class="bg-blue-500 p-6 pt-24 text-center text-white font-bold text-2xl">
        BNB Bank
    </header>
    <div class="relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white">
        <div class="max-w-7xl mx-auto lg:w-2/6 p-6 lg:p-8 mt-6">
            <form action="" method="post" class="flex flex-col gap-6">
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="text" name="username" id="username" placeholder="Username" autofocus>
                    <span class="hidden text-red-500 px-3 py-1 text-xs font-semibold">Error</span>
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="text" name="email" id="email" placeholder="E-mail">
                    <span class="hidden text-red-500 px-3 py-1 text-xs font-semibold">Error</span>
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="text" name="password" id="password" placeholder="Password">
                    <span class="hidden text-red-500 px-3 py-1 text-xs font-semibold">Error</span>
                </div>
                <div class="flex flex-col">
                    <input class="border rounded-full px-3 py-2 text-sm" type="text" name="password_confirmation" id="password_confirmation" placeholder="Confirm Your Password">
                    <span class="hidden text-red-500 px-3 py-1 text-xs font-semibold">Error</span>
                </div>
                <input class="rounded bg-blue-500 hover:bg-blue-600 transition-colors cursor-pointer w-full mt-6 text-center text-white p-4 uppercase font-bold text-sm" type="submit" value="Sign Up">
                <hr class="w-1/3 mx-auto">
                @if (Route::has('login'))
                    <div class="mx-auto">
                        @auth
                            <a href="{{ url('/home') }}" class="font-semibold text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-400 hover:text-gray-600 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500">Already Have an Account?</a>
                        @endauth
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
