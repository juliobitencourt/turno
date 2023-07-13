<div class="m-6">
    {{ $slot }}

    <div class="divide-y divide-blue-100">
        @foreach ($list as $item)
            <div class="py-4 text-xs flex items-center">
                <div class="flex-1 flex flex-col">
                    <span class="font-bold">{{ $item['description'] }}</span>
                    <span class="">{{ $item['date'] }}</span>
                </div>
                <div
                    @class(['text-red-600' => $item['amount'] < 0])
                >
                    {{ $item['amount'] }}
                </div>
            </div>
        @endforeach
    </div>
</div>