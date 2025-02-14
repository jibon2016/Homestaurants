<x-vendor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Approval Status') }}
        </h2>
    </x-slot>
    <div class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">You have limited access. Please wait for revision from administration.</h5>
        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Sorry! your account is under revision. You will get a notification soon on your approval status.
        </p>
    </div>
</x-vendor-app-layout>
