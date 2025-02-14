<x-vendor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-16">
            {{ __('Subscribe to Sale') }}
        </h2>
    </x-slot>

    <div class="py-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4 px-4 sm:px-6 lg:px-8">

        @foreach ($plans as $plan)
        <div class="w-full max-w-sm p-4 mx-auto bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-xl font-medium text-gray-600 dark:text-gray-400">{{$plan->name}}</h5>
            <div class="flex items-baseline text-gray-900 dark:text-white">
                <span class="text-3xl font-semibold">$</span>
                <span class="text-5xl font-extrabold tracking-tight">{{$plan->price}}</span>
                <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">/year</span>
            </div>
            <!-- Description -->
            <p class="space-y-5 my-7 text-gray-600 dark:text-gray-400">{{$plan->description}}</p>
            <a href="{{route('plans.show', $plan->slug)}}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Choose plan</a>
        </div>
        @endforeach
    </div>

</x-vendor-app-layout>
