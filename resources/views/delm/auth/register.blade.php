<x-guest-layout>
    <form method="POST" action="{{ route('delm.register.submit') }}" enctype="multipart/form-data" id="myForm">
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

        <!--Car type-->
        <div class="mt-4">
            <x-input-label class="mb-2" for="car_type" :value="__('Select Your Car Type')" />
            <select name="car_type" id="car_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" onchange="toggleLicenseFields()">
                <option value="">Riding Option</option>
                <option value="bike">Bike/Bicycle</option>
                <option value="motorbike">Motorbike/Motorcycle</option>
            </select>
            <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
        </div>

        <!-- Verification Photo - Driving License -->
        <div class="mt-4 hidden" id="driving_license_block">
            <x-input-label for="driving_license" :value="__('Driving License Photo')" />
            <x-text-input id="driving_license" class="block mt-1 w-full" type="file" name="driving_license" autocomplete="driving_license" />
            <img id="driving_license_preview" src="#" alt="Driving License Preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;" />
            <x-input-error :messages="$errors->get('driving_license')" class="mt-2" />
        </div>

        <!-- Verification Photo - Car License -->
        <div class="mt-4 hidden" id="car_license_block">
            <x-input-label for="car_license" :value="__('Motorbike License Photo')" />
            <x-text-input id="car_license" class="block mt-1 w-full" type="file" name="car_license" autocomplete="car_license" />
            <img id="car_license_preview" src="#" alt="Car License Preview" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;" />
            <x-input-error :messages="$errors->get('car_license')" class="mt-2" />
        </div>

        <!-- Delivery Man Address -->
        <div class="mt-4">
            <x-input-label for="" :value="__('Your Present Address')" />
            <x-text-input id="location-input" class="block mt-1 w-full" type="text" name="delm_address" placeholder="Type your present address..." required autocomplete="delm_address" />
            <x-text-input id="location-lat" class="block mt-1 w-full" type="hidden" name="delm_latitude" :value="old('delm_latitude')" required autocomplete="delm_latitude" />
            <x-text-input id="location-lng" class="block mt-1 w-full" type="hidden" name="delm_longitude" :value="old('delm_longitude')" required autocomplete="delm_longitude" />
            <x-input-error :messages="$errors->get('delm_address')" class="mt-2" />
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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800" href="{{ route('delm.login') }}">
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

        </script>

<script>
    // Get the file inputs and preview elements
    const drivingLicenseInput = document.getElementById('driving_license');
    const drivingLicensePreview = document.getElementById('driving_license_preview');
    const carLicenseInput = document.getElementById('car_license');
    const carLicensePreview = document.getElementById('car_license_preview');

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

    // Event listener for file input change - Driving License
    drivingLicenseInput.addEventListener('change', function () {
        updatePreview(this, drivingLicensePreview);
    });

    // Event listener for file input change - Car License
    carLicenseInput.addEventListener('change', function () {
        updatePreview(this, carLicensePreview);
    });

    // Function to toggle the visibility of the fields based on the car type selection
    function toggleLicenseFields() {
        var carType = document.getElementById('car_type').value;
        var drivingLicenseField = document.getElementById('driving_license_block');
        var carLicenseField = document.getElementById('car_license_block');

        if (carType === 'motorbike') {
            drivingLicenseField.style.display = 'block';
            carLicenseField.style.display = 'block';
        } else {
            drivingLicenseField.style.display = 'none';
            carLicenseField.style.display = 'none';
        }
    }
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
