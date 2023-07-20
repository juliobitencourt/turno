@extends("app")

@section("header")
    <x-header title="Checks Control"/>
@endsection
@section('main')
    <div class="mx-auto w-full lg:w-3/6 flex flex-col relative sm:flex sm:justify-center sm:items-center bg-white dark:bg-gray-900 selection:bg-green-500 selection:text-white text-blue-500">
        <TabGroup>
            <TabList class="w-full flex justify-between bg-blue-50 px-6 pt-4">
                <Tab v-slot="{ selected }">
                    <button
                        class="text-sm uppercase pb-2 border-b-2"
                        :class="{ 'border-blue-500': selected }"
                    >
                        Pending
                    </button>
                </Tab>
                <Tab v-slot="{ selected }">
                    <button
                        class="text-sm uppercase pb-2 border-b-2"
                        :class="{ 'border-blue-500': selected }"
                    >
                        Approved
                    </button>
                </Tab>
                <Tab v-slot="{ selected }">
                    <button
                        class="text-sm uppercase pb-2 border-b-2"
                        :class="{ 'border-blue-500': selected }"
                    >
                        Denied
                    </button>
                </Tab>
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
@endsection
