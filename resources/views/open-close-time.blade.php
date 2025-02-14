<x-main-layout>
    <div class="relative bg-gray-50 dark:bg-gray-950 mt-10 pt-6 pb-10">
        <div class="m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
            <div class="px-2 md:px-0">
                <h1 class="text-2xl font-extrabold font-sans text-center hover:uppercase text-gray-700 dark:text-gray-200 md:text-4xl mx-auto lg:w-10/12">{{ __("Time Schedule") }}</h1>
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-50 dark:bg-gray-950">
        <div class="mx-auto max-w-md px-4 sm:px-6 lg:max-w-4xl lg:px-8 pb-10">
            <div class="grid grid-cols-1 gap-4">
                @foreach($shedules as $schedule)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-50">{{ $schedule->day }}</h3>
                            <div class="mt-2 flex items-center text-sm text-gray-800 dark:text-gray-200">
                                <svg fill="none" stroke="currentColor" class="w-5 h-5" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="ml-2">
                                    @if($schedule->off_day == 1)
                                        <span class="text-red-500">Closed</span>
                                    @else
                                        {{ date('h:i A', strtotime($schedule->opening_time)) }} - {{ date('h:i A', strtotime($schedule->closing_time)) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-main-layout>
