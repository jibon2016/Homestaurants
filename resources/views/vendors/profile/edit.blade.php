<x-vendor-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> --}}

    <div class="py-2 mt-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        {{-- <header>

                            <div class="lg:flex gap-4 dark:text-gray-300">
                                <p>Email: {{$vendor->email}}</p>
                                <p>Country: {{$vendor->country}}</p>
                                <p>Currency: {{$vendor->currency}}</p>
                                <p>Location on Google Map: {{$vendor->vendor_address}}</p>
                                <p>Approval Status: {{$vendor->approval_status}}</p>
                            </div>
                        </header> --}}

                        <form method="post" action="{{ route('vendor.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')


                                <h2 class="dark:text-gray-100 text-lg mb-4">Kitchen Information</h2>
                                <div>
                                    <img id="cover_photo_preview" src="{{$vendor->cover_photo ? asset('storage/'.$vendor->cover_photo): asset('images/vendor_default_cover.jpg')}}" width="200" height="200" alt="Profile Pic">
                                    <x-input-label for="cover_photo" :value="__('Cover Photo')" />
                                    <x-text-input id="cover_photo" name="cover_photo" type="file" class="mt-1 block w-full" />
                                    <x-input-error class="mt-2" :messages="$errors->get('cover_photo')" />
                                    {{-- <img id="cover_photo_preview" alt="Preview" class="mt-2" src="" width="200" height="200" style="display: none;" /> --}}
                                </div>
                                <div>
                                    <x-input-label for="vendor_name" :value="__('Homestaurant\'s Name')" />
                                    <x-text-input id="vendor_name" name="vendor_name" type="text" class="mt-1 block w-full" :value="old('vendor_name', $vendor->vendor_name)" required autofocus autocomplete="vendor_name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('vendor_name')" />
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $vendor->phone)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>
                                <div>
                                    <x-input-label for="whatsapp_number" :value="__('WhatsApp No.')" />
                                    <x-select-dial-code />
                                    <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full" :value="old('whatsapp_number', $vendor->whatsapp_number)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('dial_code')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('whatsapp_number')" />
                                </div>


                                <h2 class="dark:text-gray-100 text-lg mb-4">Chef Information</h2>


                            <div>
                                <img id="avatar_preview" src="{{$vendor->avatar ? asset('storage/'.$vendor->avatar): asset('images/food-avatar.png')}}" width="150" height="200" alt="Profile Pic">
                                <x-input-label for="avatar" :value="__('Profile Photo')" />
                                <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                                {{-- <img id="avatar_preview" alt="Preview" class="mt-2" src="" width="200" height="200" style="display: none;" /> --}}
                            </div>



                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $vendor->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="profession" :value="__('Profession')" />
                                <x-text-input id="profession" name="profession" type="text" class="mt-1 block w-full" :value="old('profession', $vendor->chef->profession)" required autofocus autocomplete="profession" />
                                <x-input-error class="mt-2" :messages="$errors->get('profession')" />
                            </div>



                            <div>
                                <x-input-label for="facebook_link" :value="__('Facebook')" />
                                <x-text-input id="facebook_link" name="facebook_link" type="text" class="mt-1 block w-full" :value="old('facebook_link', $vendor->chef->facebook_link)"  />
                                <x-input-error class="mt-2" :messages="$errors->get('facebook_link')" />
                            </div>

                            <div>
                                <x-input-label for="twitter_link" :value="__('Twitter')" />
                                <x-text-input id="twitter_link" name="twitter_link" type="text" class="mt-1 block w-full" :value="old('twitter_link', $vendor->chef->twitter_link)"  />
                                <x-input-error class="mt-2" :messages="$errors->get('twitter_link')" />
                            </div>

                            <div>
                                <x-input-label for="instagram_link" :value="__('Instagram')" />
                                <x-text-input id="instagram_link" name="instagram_link" type="text" class="mt-1 block w-full" :value="old('instagram_link', $vendor->chef->instagram_link)"  />
                                <x-input-error class="mt-2" :messages="$errors->get('instagram_link')" />
                            </div>

                            <div>
                                <x-input-label for="linkedin_link" :value="__('Linkedin')" />
                                <x-text-input id="linkedin_link" name="linkedin_link" type="text" class="mt-1 block w-full" :value="old('linkedin_link', $vendor->chef->linkedin_link)"  />
                                <x-input-error class="mt-2" :messages="$errors->get('facebook_link')" />
                            </div>

                            <div>
                                <x-input-label for="youtube_link" :value="__('Youtube')" />
                                <x-text-input id="youtube_link" name="youtube_link" type="text" class="mt-1 block w-full" :value="old('youtube_link', $vendor->chef->youtube_link)"  />
                                <x-input-error class="mt-2" :messages="$errors->get('youtube_link')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('About You')" />
                                <textarea name="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm mt-1 block w-full" id="description" cols="30" rows="6">{{old('description', $vendor->chef->description)}}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
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

                        <script>
                            // Add event listener to avatar file input
                        document.getElementById('avatar').addEventListener('change', previewImage);
                        document.getElementById('cover_photo').addEventListener('change', previewCoverImage);

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

                         // Function to handle avatar image preview
                         function previewCoverImage(event) {
                            const input = event.target;
                            const preview = document.getElementById('cover_photo_preview');

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
                    </section>

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
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

                        <form method="post" action="{{ route('vendor.password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
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

        </div>
    </div>

    <x-session-success-msg />

</x-vendor-app-layout>
