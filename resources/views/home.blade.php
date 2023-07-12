@extends("app")

@section("content")
    <div class="relative z-10">
        <div class="">
            <div id="overlay" class="hidden absolute w-full h-screen inset-0 bg-black opacity-50"></div>
            <div id="sidebar" class="-translate-x-full absolute inset-0 w-1/2 bg-blue-500 h-screen transition-transform">
                <div class="bg-blue-200 p-8 text-white font-bold text-2xl">
                    BNB Bank
                </div>
                <ul class="m-6">
                    <li class="flex items-center gap-4">
                        <svg class="text-blue-100 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z" />
                        </svg>
                        <a class="text-white uppercase font-bold text-xs" href="http://">Balance</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="relative h-screen">
        <header class="bg-blue-500 p-6 text-center text-white font-bold text-xl">
            <div class="max-w-7xl mx-auto lg:w-2/6 flex items-center">
                <button id="menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <span class="text-center w-full">BNB Bank</span>
            </div>
        </header>
        <div class="relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
            <div class="p-6 flex items-center bg-blue-100">
                <div class="flex-1 flex flex-col">
                    <strong>Incomes</strong>
                    <span>$7000.00</span>
                </div>
                <button class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="text-xs uppercase">Deposit a Check</span>
                </button>
            </div>
            <div class="p-6 flex items-center bg-blue-50">
                <div class="flex-1 flex flex-col">
                    <strong>Expenses</strong>
                    <span>$780.00</span>
                </div>
                <button class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span class="text-xs uppercase">Deposit a Check</span>
                </button>
            </div>

            <div class="m-6">
                <h1 class="my-3 uppercase">Transactions</h1>
                <div class="divide-y divide-blue-100">
                    <div class="py-4 text-xs flex">
                        <div class="flex-1 flex flex-col">
                            <span class="font-bold">Foo</span>
                            <span class="">08/08/2023 08:12</span>
                        </div>
                        <div class="text-red-600">-40,00</div>
                    </div>
                    <div class="py-4 flex flex-col text-xs">
                        <span class="font-bold">Bar</span>
                        <span class="">08/08/2023 08:12</span>
                        <div class="">40,00</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 text-blue-500">
            <div class="flex items-center gap-6">
                <div class="flex-1 border-b flex flex-col">
                    <label for="amount" class="flex gap-2 text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="uppercase">Amount</span>
                    </label>
                    <input class="px-7 py-3" type="text" name="" id="" value="$40,00">
                </div>
                <span>USD</span>
            </div>
        </div>

        <div class="p-6 text-blue-500 flex gap-4">
            <button class="flex-1 flex justify-center items-center border border-blue-500 rounded px-6 py-3 uppercase text-xs font-semibold gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Reject</span>
            </button>
            <button class="flex-1 flex justify-center items-center border bg-blue-500 rounded px-6 py-3 uppercase text-xs text-white font-semibold gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Accept</span>
            </button>
        </div>

        <my-component></my-component>
        <button class="w-16 h-16 rounded-full bg-blue-800 text-white absolute right-2 bottom-2 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>

    <script>
    // Toggle sidebar visibility
    function toggleSidebar() {
        const overlay = document.getElementById("overlay");
        const sidebar = document.getElementById("sidebar");
        overlay.classList.toggle("hidden");
        sidebar.classList.toggle("-translate-x-full");
    }

    // Add event listener to the menu button
    const menuButton = document.getElementById("menu-button");
    menuButton.addEventListener("click", toggleSidebar);
    const overlay = document.getElementById("overlay");
    overlay.addEventListener("click", toggleSidebar);
    </script>
@endsection