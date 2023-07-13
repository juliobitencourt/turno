@extends("app")

@section("header")
    <x-header title="BNB Bank"/>
@endsection
@section('main')
    <div class="bg-blue-500 p-6 text-white font-bold text-xl flex">
        <div class="flex-1 flex flex-col">
            <span>Current Balance</span>
            <span>${{ $balance }}</span>
        </div>
    </div>
    <div class="relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <div class="p-6 flex items-center bg-blue-100">
            <div class="flex-1 flex flex-col">
                <strong>Incomes</strong>
                <span>${{ $incomes }}</span>
            </div>
            <a href="{{ route('home') }}" class="w-1/4 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="text-xs uppercase">Deposit a Check</span>
            </a>
        </div>
        <div class="p-6 flex items-center bg-blue-50">
            <div class="flex-1 flex flex-col">
                <strong>Expenses</strong>
                <span>${{ $expenses }}</span>
            </div>
            <a href="{{ route('home') }}" class="w-1/4 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="text-xs uppercase">Purchase</span>
            </a>
        </div>

        <div class="m-6">
            <h1 class="my-3 uppercase">Transactions</h1>
            <div class="divide-y divide-blue-100">
                @foreach ($transactions as $item)
                    <div class="py-4 text-xs flex">
                        <div class="flex-1 flex flex-col">
                            <span class="font-bold">{{ $item['description'] }}</span>
                            <span class="">{{ $item['date'] }}</span>
                        </div>
                        <div
                            class="text-red-600"
                        >
                            -40,00
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{{-- 
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

        <button class="w-16 h-16 rounded-full bg-blue-800 text-white fixed right-2 bottom-2 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button> --}}