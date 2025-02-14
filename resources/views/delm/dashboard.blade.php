<x-delm-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Delivery Man Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-4 bg-white dark:bg-gray-800 lg:pl-28">
            <form action="{{ route('delm.dashboard.filter') }}" method="get">
                @csrf
                <div class="mb-4">
                    <label for="time_period" class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-200">Select Time Period:</label>
                    <select name="time_period" id="time_period" class="w-full rounded-md form-select dark:bg-gray-900 dark: dark:text-gray-200 focus:ring-green-500">
                        <option value="daily" {{ old('time_period', $timePeriod) === 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('time_period', $timePeriod) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ old('time_period', $timePeriod) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ old('time_period', $timePeriod) === 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Apply Filter</button>
            </form>
        </div>
        <div class="px-4 py-4 mx-auto lg:px-16 lg:ml-10">
            <div class="grid grid-cols-1 sm:h-24 sm:grid-flow-row sm:gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-green-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $totalDeliveredItems }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">Delivered Foods</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-red-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $deliveredAmount }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">Total Amount</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-blue-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $youEarned }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">You Earned</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-center bg-white border border-gray-300 rounded shadow-lg dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex w-full h-full">
                        <div class="flex items-center justify-center w-1/3 bg-indigo-500">
                            <p class="text-lg font-semibold text-center text-white">{{ $deliveredAmount + $youEarned }}</p>
                        </div>
                        <div class="flex items-center justify-center w-2/3 ">
                            <p class="text-xl text-center text-gray-900 dark:text-gray-50">Foods Price</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="justify-center max-w-full px-4 py-4 mx-auto rounded-md shadow-md lg:flex" style="background-image: url({{asset('images/default_food.webp')}})">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <svg class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                    </svg>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Available Balance on the Marketplace</h5>
                    </a>
                    <p class="mb-3 text-2xl font-bold text-yellow-400 dark:text-yellow-300">
                        {{$youEarned-$totalWithdraw}}
                    </p>

                    <form action="{{route('rider-withdraw-request')}}" method="POST">
                        @csrf
                        <input type="hidden" name="request_amount" value="{{$youEarned-$totalWithdraw}}">

                        @error('request_amount')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="inline-flex items-center text-green-500 hover:underline">
                            Send withdraw request
                            <svg class="w-3 h-3 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
    </div>
    <x-session-success-msg />
</x-delm-app-layout>
