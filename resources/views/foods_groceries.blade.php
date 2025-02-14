<x-main-layout>
    <div class="p-4 bg-gray-50 dark:bg-gray-950 mt-20">
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
            class="bg-green-300 max-w-sm mx-auto items-right text-gray-800 dark:text-gray-950 font-semibold px-4 py-2 rounded-md">
            {{ session('message') }}
        </div>
        @endif

        @if (session()->has('restrictMessage'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="bg-red-300 max-w-sm mx-auto items-right text-gray-800 dark:text-gray-950 font-semibold px-4 py-2 rounded-md">
            {{ session('restrictMessage') }}
        </div>
        @endif

        <div class="mt-4 md:mt-8 rounded-lg dark:border-gray-700">
           {{-- <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-950">
            <form action="{{route('update-location-on-foods-page')}}" method="POST" class="w-full md:w-3/4 mt-0">
                @csrf
                <label for="search-btn" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="location-input" name="location" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-300 dark:focus:border-green-300" value="{{$location}}" required>
                    <input type="hidden" name="latitude" id="location-lat" value="{{$latitude}}">
                    <input type="hidden" name="longitude" id="location-lng" value="{{$longitude}}">
                    <button type="submit" id="search-btn" class="text-white absolute right-2.5 bottom-2.5 bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">{{__('Find Foods')}}</button>
                </div>
            </form>
           </div> --}}

           @include('nearby_foods')
        </div>


           {{-- @include('nearby_foods') --}}

        @include('partials.app-footer')
     </div>

     <script>
        function initAutocomplete() {
        const input = document.getElementById("location-input");
        const autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            const latitude = place.geometry.location.lat();
            const longitude = place.geometry.location.lng();

            document.getElementById("location-input").value = place.formatted_address;
            document.getElementById("search-btn").disabled = false;
            document.getElementById("search-btn").classList.remove("disabled");

            document.getElementById("location-lat").value = latitude;
            document.getElementById("location-lng").value = longitude;
        });

            const searchBtn = document.getElementById("search-btn");

            searchBtn.addEventListener("click", () => {
                document.getElementById("location-form").submit();
            });
        }

        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initAutocomplete"></script>
</x-main-layout>
