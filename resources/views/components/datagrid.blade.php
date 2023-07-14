<div class="lg:w-full m-6">
    {{ $slot }}

    @if (count($list) === 0)
        <x-not-found/>
    @else
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
                    @if (isset($item['link']))
                        <a
                            class="ml-6 hover:text-blue-700 transition-colors"
                            href="{{ $item['link'] }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>