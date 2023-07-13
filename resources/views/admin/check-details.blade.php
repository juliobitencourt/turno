@extends("app")

@section("header")
    <x-header title="Check Details"/>
@endsection
@section('main')
    <div class="flex-1 p-6 flex flex-col gap-6 relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <div class="flex flex-col">
            <span class="uppercase text-xs text-blue-400">Customer</span>
            <span class="text-blue-700 font-semibold">{{ $check->user->name }}</span>
        </div>
        <div class="flex flex-col">
            <span class="uppercase text-xs text-blue-400">Customer Email</span>
            <span class="text-blue-700 font-semibold">{{ $check->user->email }}</span>
        </div>
        <div class="flex flex-col">
            <span class="uppercase text-xs text-blue-400">Account</span>
            <span class="text-blue-700 font-semibold">561234</span>
        </div>
        <div class="flex flex-col">
            <span class="uppercase text-xs text-blue-400">Reported Amount</span>
            <span class="text-blue-700 font-semibold">{{ $check->amount }}</span>
        </div>
        <div class="flex flex-col">
            <img src="{{ $check->filename }}" title="{{ $check->user->name }}"/>
        </div>
    </div>
    <div class="p-6 text-blue-500 flex gap-4">
        <rejectcheck :check="{{ $check }}"></rejectcheck>
        <acceptcheck :check="{{ $check }}"></acceptcheck>
    </div>
@endsection