@extends("app")

@section("header")
    <x-header title="Checks Control"/>
@endsection
@section('main')
    <div class="relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <x-datagrid
            :list="$checks"
        />
    </div>
@endsection
