@extends("app")

@section("header")
    <x-header title="BNB Bank"/>
@endsection
@section('main')
    <div class="bg-blue-500 p-6 text-white font-bold text-xl">
        <div class="max-w-7xl mx-auto lg:w-3/6">
            <div class="flex-1 flex flex-col">
                <span>Current Balance</span>
                <span>${{ $balance }}</span>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto w-full lg:w-3/6 relative bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <div class="p-6 flex items-center bg-blue-100">
            <div class="flex-1 flex flex-col">
                <strong>Incomes</strong>
                <span>${{ $incomes }}</span>
            </div>
            <a href="{{ route('checks.create') }}" class="w-1/4 flex flex-col items-center">
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
            <a href="{{ route('expenses.create') }}" class="w-1/4 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="text-xs uppercase">Purchase</span>
            </a>
        </div>
        <x-datagrid :list="$transactions">
            <h1 class="my-3 uppercase">Transactions</h1>
        </x-datagrid>
    </div>
@endsection
