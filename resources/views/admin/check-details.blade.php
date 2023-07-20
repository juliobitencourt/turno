@extends("app")

@section("header")
    <x-header title="Check Details"/>
@endsection
@section('main')
    <div class="mx-auto w-full lg:w-3/6 flex-1 p-6 flex flex-col gap-6 relative sm:flex bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
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
            <span class="text-blue-700 font-semibold">{{ $check->user->account->id }}</span>
        </div>
        <div class="flex flex-col">
            <span class="uppercase text-xs text-blue-400">Reported Amount</span>
            <span class="text-blue-700 font-semibold">{{ $check->amount }}</span>
        </div>
        <div class="flex justify-center">
            <img width="350" src="{{ route('admin.check-image', ['filename' => $check->picture]) }}" alt="Check Image">
        </div>
    </div>
    <div class="mx-auto w-full lg:w-3/6 p-6 text-blue-500 flex gap-4">
        <denycheck :check="{{ $check }}"></denycheck>
        <approvecheck :check="{{ $check }}"></approvecheck>
    </div>
@endsection