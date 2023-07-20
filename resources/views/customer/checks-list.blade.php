@extends("app")

@section("header")
    <x-header title="Checks"/>
@endsection
@section('main')
    <div class="mx-auto w-full lg:w-3/6 flex flex-col relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <TabGroup>
            <TabList class="w-full flex justify-between bg-blue-50 px-6 pt-4">
                <Tab class="text-sm uppercase pb-2 border-b-2">Pending</Tab>
                <Tab class="text-sm uppercase pb-2 border-b-2">Approved</Tab>
                <Tab class="text-sm uppercase pb-2 border-b-2">Denied</Tab>
            </TabList>
            <TabPanels class="w-full">
                <TabPanel>
                    <x-datagrid :list="$pending"/>
                </TabPanel>
                <TabPanel>
                    <x-datagrid :list="$approved"/>
                </TabPanel>
                <TabPanel>
                    <x-datagrid :list="$denied"/>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
    <a href="{{ route('checks.create') }}" class="w-16 h-16 rounded-full bg-blue-800 text-white fixed right-3 bottom-3 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>
@endsection
