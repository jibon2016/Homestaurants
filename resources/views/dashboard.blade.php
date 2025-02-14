<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mx-2">
                <div class="px-8 h-auto max-w-full rounded-lg py-8 shadow-lg text-center dark:bg-gray-700">
                    <img src="{{asset('images/food2.png')}}" alt="Food Image" class="py-4 ">
                    <a href="{{route('nearby.all.foods')}}" class="text-yellow-400 dark:text-yellow-300 text-2xl underline">Order Nearby Foods</a>
                </div>
                <div class="px-8 h-auto max-w-full rounded-lg py-8 shadow-lg text-center dark:bg-gray-700">
                    <img src="{{asset('images/fotor2.png')}}" alt="Food Image" class="py-4 ">
                    <a href="{{route('nearby.foods')}}" class="text-yellow-400 dark:text-yellow-300 text-2xl underline">Nearby Homestaurant's</a>
                </div>

            </div>

        </div>
    </div>
    <x-session-success-msg />
</x-app-layout>
