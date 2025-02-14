<x-main-layout>
    <div class="p-4 bg-gray-50 dark:bg-gray-950 mt-20">
        @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="bg-red-300 max-w-sm mx-auto items-right text-gray-800 dark:text-gray-950 font-semibold px-4 py-2 rounded-md">
                    {{ session('message') }}
                </div>
        @endif
        <div class="mt-8 rounded-lg dark:border-gray-700">
           <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-950">
            <form action="{{route('store-location')}}" method="POST" class="w-full md:w-3/4 mt-0 bg-yellow-400 p-0.5 rounded-md">
                @csrf
                <label for="search-btn" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="location-input" name="location" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-green-500 focus:border-green-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-300 dark:focus:border-green-300" value="{{$location}}" required>
                    <input type="hidden" name="latitude" id="location-lat" value="{{$latitude}}">
                    <input type="hidden" name="longitude" id="location-lng" value="{{$longitude}}">
                    <button type="submit" id="search-btn" class="text-white absolute right-2.5 bottom-2.5 bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">{{__('Find Foods')}}</button>
                </div>
            </form>
           </div>

           <div class="relative bg-gray-50 dark:bg-gray-950 pb-10">
            <div class="m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="px-2 md:px-0">
                    <h1 class="text-2xl font-extrabold font-sans text-center uppercase hover:capitalize text-gray-700 dark:text-gray-200 md:text-4xl mx-auto lg:w-10/12">{{__("Nearby Homestaurant's")}}</h1>
                    <p class="dark:text-gray-300 text-md px-2 py-1 text-center">

                    @if ($numberOfRows > 0)
                        {{$nearbyVendors->total()}} results found within 20 km

                    @endif
                    </p>
                </div>
            </div>
           </div>

           @include('nearby_kitchen')

           {{-- <div class="w-full px-2 py-2 shadow-xl rounded-lg mt-8 bg-gradient-to-l from-blue-300 via-green-400 to-yellow-300 ">
            <div class="relative shadow-md max-w-lg mx-auto justify-center rounded-md bg-gray-50 mt-8 dark:bg-gray-950 pb-10" style="background-image:linear-gradient(rgba(12, 93, 64, 0.889), rgba(255, 255, 0, 0.5)), url({{asset('images/food2.png')}}); background-repeat: no-repeat; background-position-x: center;">
                <div class="m-auto px-2 pt-14">
                    <div class="px-2">
                        <h2 class="text-md sm:text-xl py-2 font-extrabold font-sans text-center text-gray-200 dark:text-gray-100 mx-auto lg:w-10/12">
                            <span x-data="{ show: false }" x-init="setTimeout(() => { show = true }, 500)" x-show="show"
                                class="inline-block animate-bounce text-gray-100 dark:text-gray-100">
                                Click Here &#8595;
                            </span> <br>
                            <a href="{{route('nearby.all.foods')}}" class=" bg-green-500 dark:bg-green-400 py-2 px-4 rounded-md">
                                {{__("Nearby Foods")}}
                            </a>
                        </h2>
                    </div>
                </div>
               </div>
           </div> --}}



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
