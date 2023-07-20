@extends("app")

@section("header")
    <x-header title="Incomes"/>
@endsection
@section('main')
    <div class="mx-auto w-full lg:w-3/6 relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <x-datagrid :list="$incomes"/>
    </div>
@endsection
