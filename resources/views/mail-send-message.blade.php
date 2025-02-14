<x-guest-layout>
    <div class="bg-gray-100 dark:bg-gray-950 py-8 mt-5">

        <div class="container mx-auto px-4 max-w-md py-4">
            <h1 class="text-2xl dark:text-gray-200 font-semibold mb-4">Thanks For Your Registration</h1>
            <p class="shadow-md dark:text-gray-100 py-4 px-4">Please check your email and verify your email address.
                If you didn't get it <a class="bg-green-500 px-2 py-0.5 rounded text-white" href="{{route('vendor.login')}}">login</a> to resend verification link.
            </p>
        </div>
    </div>
    <x-session-success-msg />
</x-guest-layout>
