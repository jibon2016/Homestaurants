<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('vendor.login.submit') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full pr-10"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-700"
                        width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" id="password-toggle">
                        <path d="M10 12C11.654 12 13 10.654 13 9C13 7.346 11.654 6 10 6C8.346 6 7 7.346 7 9C7 10.654 8.346 12 10 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.071 17.071L14.95 14.95M14.95 14.95C13.091 16.809 10.909 18 8 18C3.589 18 0 14.411 0 10C0 5.589 3.589 2 8 2C10.909 2 13.091 3.191 14.95 5.05M14.95 14.95C16.809 13.091 18 10.909 18 8C18 3.589 14.411 0 10 0C5.589 0 2 3.589 2 8C2 10.909 3.191 13.091 5.05 14.95" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-500 shadow-sm focus:ring-green-500 dark:focus:ring-green-500 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-light-dark-toggle />
                @if (Route::has('vendor.password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('vendor.password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <div class="flex items-center justify-start mt-4 gap-4">
                <p class="text-gray-600 text-md dark:text-gray-400">Not registered yet?</p>
                <p>
                    <a class="underline text-md text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('vendor.register') }}">
                        {{ __('Create your account.') }}
                    </a>
                </p>
            </div>

            {{-- <div class="text-center mt-4">
                <p class="text-gray-600 text-md dark:text-gray-400">OR</p>
            </div>

            <div class="text-center mt-4">
                <p class="text-gray-600 text-md dark:text-gray-400 w-full"><a class="px-2 py-2 bg-blue-400 rounded-md text-white" href="{{route('delm.register')}}">Join as a Rider</a></p>
                <p class="text-gray-600 text-md dark:text-gray-400 m-5"><a href="{{route('register')}}" class="px-2 py-2 bg-blue-400 rounded-md text-white">Join as a Customer</a></p>

            </div> --}}

        </form>


    <script>
        const passwordToggle = document.getElementById('password-toggle');
        const passwordInput = document.getElementById('password');

        passwordToggle.addEventListener('click', function() {
            togglePasswordVisibility(passwordInput, passwordToggle);
        });

        function togglePasswordVisibility(input, toggleIcon) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            // Toggle eye icon appearance based on password visibility
            if (type === 'password') {
                toggleIcon.classList.remove('text-gray-700 dark:text-gray-400');
                toggleIcon.classList.add('text-gray-400 dark:text-gray-700');
            } else {
                toggleIcon.classList.remove('text-gray-400 dark:text-gray-700');
                toggleIcon.classList.add('text-gray-700 dark:text-gray-400');
            }
        }
    </script>
</x-guest-layout>
