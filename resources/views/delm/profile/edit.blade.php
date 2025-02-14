<x-delm-app-layout>
    <x-session-success-msg />
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="px-2 py-12 rounded-md">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Profile Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update your account's profile information.") }}
                            </p>
                            <p class="mt-1 text-gray-600 dark:text-gray-300">{{$deliveryMan->email}}</p>
                            <p class="mt-1 text-gray-600 dark:text-gray-300">{{$deliveryMan->delm_address}}</p>
                        </header>

                        <form method="post" action="{{ route('update.delm.profile') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <img id="avatar_preview" src="{{$deliveryMan->avatar ? asset('storage/'.$deliveryMan->avatar): asset('images/food-avatar.png')}}" width="200" height="300" alt="Profile Pic">
                                <x-input-label for="avatar" :value="__('Profile Photo')" />
                                <x-text-input id="avatar" name="avatar" type="file" class="block w-full mt-1" />
                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                                {{-- <img id="avatar_preview" alt="Preview" class="mt-2" src="" width="200" height="200" style="display: none;" /> --}}
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $deliveryMan->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="block w-full mt-1" :value="old('phone', $deliveryMan->phone)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label for="bank_anme" :value="__('Withdraw Bank Name')" />
                                <x-text-input id="bank_name" name="bank_name" type="text" class="block w-full mt-1" :value="old('bank_name', $deliveryMan->bank_name)" required autofocus autocomplete="bank_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />
                            </div>

                            <div>
                                <x-input-label for="account_number" :value="__('Bank Account No.')" />
                                <x-text-input id="account_number" name="account_number" type="text" class="block w-full mt-1" :value="old('account_number', $deliveryMan->account_number)" required autofocus autocomplete="account_number" />
                                <x-input-error class="mt-2" :messages="$errors->get('account_number')" />
                            </div>

                            <div>
                                <x-input-label for="whatsapp_number" :value="__('WhatsApp No.')" />
                                <x-select-dial-code />
                                <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="block w-full mt-1" :value="old('whatsapp_number', $deliveryMan->whatsapp_number)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('dial_code')" />
                                <x-input-error class="mt-2" :messages="$errors->get('whatsapp_number')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Password') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('delm.password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" name="current_password" type="password" class="block w-full mt-1" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" name="password" type="password" class="block w-full mt-1" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block w-full mt-1" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            {{-- <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
    <script>
        // Add event listener to avatar file input
    document.getElementById('avatar').addEventListener('change', previewImage);

    // Function to handle avatar image preview
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('avatar_preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.setAttribute('src', e.target.result);
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
    </script>
</x-delm-app-layout>
