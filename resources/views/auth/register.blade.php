<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="myForm">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Checkbox for Terms and Conditions -->
        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" id="termsCheckbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-500 shadow-sm focus:ring-green-500 dark:focus:ring-green-500 dark:focus:ring-offset-gray-800" />
                <span class="m-2 pt-4 text-sm leading-5 text-gray-600 dark:text-gray-400">I have read and agree to the <a href="{{route('terms-conditions')}}" class="text-yellow-500 dark:text-yellow-500 underline">Terms and Conditions</a> and <a href="{{route('privacy-policy')}}" class="text-yellow-500 dark:text-yellow-500 underline">Privacy Policy</a>.</span>
            </label>
        </div>

        <!-- Checkbox for Terms and Conditions -->
        <div>
            <label class="flex items-center">
                <input type="checkbox" id="termsCheckbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-500 shadow-sm focus:ring-green-500 dark:focus:ring-green-500 dark:focus:ring-offset-gray-800" />
                <span class="m-2 pt-4 text-sm leading-5 text-gray-600 dark:text-gray-400"> I agree that my preparation of food is done only at my home kitchen.</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-light-dark-toggle />
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const termsCheckbox = document.getElementById('termsCheckbox');
        const myForm = document.getElementById('myForm');

        myForm.addEventListener('submit', function(event) {
            if (!termsCheckbox.checked) {
                event.preventDefault(); // Prevent form submission
                alert("Please agree to the Terms and Conditions by cheking the box.");
            }
        });
    </script>

</x-guest-layout>
