<x-guest-layout>
    <form method="POST" action="{{ route('vendor.register.submit') }}" enctype="multipart/form-data" id="myForm">
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

        <!-- Vendor Name -->
        <div class="mt-4">
            <x-input-label for="vendor_name" :value="__('Homestaurant\'s Name')" />
            <x-text-input id="vendor_name" class="block mt-1 w-full" type="text" name="vendor_name" :value="old('vendor_name')" required autocomplete="vendor_name" />
            <x-input-error :messages="$errors->get('vendor_name')" class="mt-2" />
        </div>

        <!-- Verification Photo - Front -->
        <div class="mt-4">
            <x-input-label for="govt_front" :value="__('Government ID (Front image)')" />
            <x-text-input id="govt_front" class="block mt-1 w-full" type="file" name="govt_front" required autocomplete="govt_front" />
            <img id="govt_front_preview" src="#" alt="Government ID Front Preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;" />
            <x-input-error :messages="$errors->get('govt_front')" class="mt-2" />
        </div>

        <!-- Verification Photo - Back -->
        <div class="mt-4">
            <x-input-label for="govt_back" :value="__('Government ID (Back image)')" />
            <x-text-input id="govt_back" class="block mt-1 w-full" type="file" name="govt_back" required autocomplete="govt_back" />
            <img id="govt_back_preview" src="#" alt="Government ID Back Preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;" />
            <x-input-error :messages="$errors->get('govt_back')" class="mt-2" />
        </div>

        <!-- Utility Bill Photo -->
        <div class="mt-4">
            <x-input-label for="current_utility_bill" :value="__('Residence Utility Bill')" />
            <x-text-input id="current_utility_bill" class="block mt-1 w-full" type="file" name="current_utility_bill" required autocomplete="current_utility_bill" />
            <img id="current_utility_bill_preview" src="#" alt="Utility Bill Preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;" />
            <x-input-error :messages="$errors->get('current_utility_bill')" class="mt-2" />
        </div>

        <!-- Country Selection -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Select Your Country')" />
            <x-select-country id="country" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- Currency Selection -->
        <div class="mt-4">
            <x-input-label for="currency" :value="__('Select Your Currency')" />
            <x-select-currency id="currency" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('currency')" class="mt-2" />
        </div>

        <!-- Vendor Address -->
        <div class="mt-4">
            <x-input-label for="VendorAddress" :value="__('Homestaurant\'s Address')" />
            <x-text-input id="location-input" class="block mt-1 w-full" type="text" name="vendor_address" placeholder="Type homestaurant's address..." required autocomplete="vendor_address" />
            <x-text-input id="location-lat" class="block mt-1 w-full" type="hidden" name="vendor_latitude" :value="old('vendor_latitude')" required autocomplete="vendor_latitude" />
            <x-text-input id="location-lng" class="block mt-1 w-full" type="hidden" name="vendor_longitude" :value="old('vendor_longitude')" required autocomplete="vendor_longitude" />
            <x-input-error :messages="$errors->get('vendor_address')" class="mt-2" />
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

        <div class="flex items-center justify-end mt-4">
            <x-light-dark-toggle />
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('vendor.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function initAutocomplete() {
        const input = document.getElementById("location-input");
        const autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            const latitude = place.geometry.location.lat();
            const longitude = place.geometry.location.lng();

            document.getElementById("location-input").value = place.formatted_address;

            document.getElementById("location-lat").value = latitude;
            document.getElementById("location-lng").value = longitude;
        });


        }

        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initAutocomplete"></script>

        <script>
            // Get the file inputs and preview elements
        const govtFrontInput = document.getElementById('govt_front');
        const govtFrontPreview = document.getElementById('govt_front_preview');
        const govtBackInput = document.getElementById('govt_back');
        const govtBackPreview = document.getElementById('govt_back_preview');
        const currentUtilityBillInput = document.getElementById('current_utility_bill');
        const currentUtilityBillPreview = document.getElementById('current_utility_bill_preview');

        // Function to update the preview image
        function updatePreview(input, preview) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
        }

        // Event listener for file input change - Front
        govtFrontInput.addEventListener('change', function () {
        updatePreview(this, govtFrontPreview);
        });

        // Event listener for file input change - Back
        govtBackInput.addEventListener('change', function () {
        updatePreview(this, govtBackPreview);
        });

        // Event listener for file input change - Utility bill
        currentUtilityBillInput.addEventListener('change', function () {
        updatePreview(this, currentUtilityBillPreview);
        });

        </script>

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
