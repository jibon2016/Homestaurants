<x-landing-layout>

    <div class="relative bg-gray-50 dark:bg-gray-950">
        <x-session-success-msg />
        <div class="container m-auto px-6 pt-32 md:px-12 lg:pt-[4.8rem] lg:px-7">
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 10000)"
                    class="max-w-sm px-4 py-2 mx-auto font-semibold text-gray-800 bg-red-300 rounded-md items-right dark:text-gray-950">
                    {{ session('message') }} <a href="{{route('cart-items')}}" class="text-green-500 underline">Your Plate Details</a>
                </div>
            @endif

            @auth
            @if (empty(auth()->user()->email_verified_at))
            <div class="flex items-center px-4 lg:pt-8 ">
                <p class="text-red-500">Verify your email. We have already sent you a link. <a class="text-green-500 underline text-md" href="/profile">Resend</a></p>
            </div>
            @endif
            @endauth


            <div class="flex flex-wrap items-center px-2 md:px-0">
                <div class="relative lg:w-6/12 lg:py-24 xl:py-32">
                    <h1 class="font-sans text-3xl font-black text-gray-900 dark:text-gray-200 md:text-5xl lg:w-10/12">Missing Home Food?</h1>
                    <p class="mt-2 text-lg text-gray-700 dark:text-gray-200 lg:w-10/12">{{__('Let us bring you the flavours that make you feel at home!')}}</p>
                    <form id="location-form" action="{{route('store-location')}}" method="POST" class="w-full mt-10 bg-yellow-400 p-0.5 rounded-md">
                        @csrf
                        <label for="location-input" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="location-input" value="{{$location}}" name="location" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-green-500 focus:border-green-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-300 dark:focus:border-green-300" placeholder="Type your location..." required>
                            <input type="hidden" name="latitude" value="{{$latitude}}" id="location-lat">
                            <input type="hidden" name="longitude" value="{{$longitude}}" id="location-lng">
                            <button type="submit" id="search-btn" class="text-white absolute right-2.5 bottom-2.5 bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">{{__('Find Kitchen')}}</button>
                        </div>
                    </form>

                </div>
                <div class="mt-10 ml-auto lg:w-6/12">
                    <img src="{{asset('images/home.png')}}" class="relative" alt="food illustration" loading="lazy" >
                </div>
            </div>
        </div>
    </div>

   <!-- Include Glide.js CSS & JS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script> --}}

<!-- Component: Logos carousel -->
<div class="relative py-10">
    <div class="glide glide-09">
        <!-- Slides -->
        <div data-glide-el="track" class="overflow-hidden">
            <ul class="flex items-center gap-6 flex-nowrap sm:gap-10">
                <li class="shrink-0">
                    <img src="https://Tailwindmix.b-cdn.net/carousel/logos/carousel-logo-image-1.svg" class="w-auto h-16 max-w-xs sm:h-20 sm:max-w-md" />
                </li>
                <li class="shrink-0">
                    <img src="https://Tailwindmix.b-cdn.net/carousel/logos/carousel-logo-image-2.svg" class="w-auto h-16 max-w-xs sm:h-20 sm:max-w-md" />
                </li>
                <li class="shrink-0">
                    <img src="https://Tailwindmix.b-cdn.net/carousel/logos/carousel-logo-image-3.svg" class="w-auto h-16 max-w-xs sm:h-20 sm:max-w-md" />
                </li>
                <li class="shrink-0">
                    <img src="https://Tailwindmix.b-cdn.net/carousel/logos/carousel-logo-image-4.svg" class="w-auto h-16 max-w-xs sm:h-20 sm:max-w-md" />
                </li>
                <li class="shrink-0">
                    <img src="https://Tailwindmix.b-cdn.net/carousel/logos/carousel-logo-image-5.svg" class="w-auto h-16 max-w-xs sm:h-20 sm:max-w-md" />
                </li>
                <li class="shrink-0">
                    <img src="https://Tailwindmix.b-cdn.net/carousel/logos/carousel-logo-image-6.svg" class="w-auto h-16 max-w-xs sm:h-20 sm:max-w-md" />
                </li>
            </ul>
        </div>
    </div>
</div>
{{-- <section class="relative bg-center bg-no-repeat bg-emerlad-50 dark:bg-gray-950 bg-blend-multiply">
    <div class="grid max-w-4xl px-4 py-12 mx-auto mb-4 justify-items-center sm:grid-cols-1 sm:px-6 lg:px-8">

        <div class="relative flex flex-col max-w-sm text-gray-700 bg-white shadow-md dark:bg-gray-800 md:w-full rounded-xl bg-clip-border">
            <div class="relative h-56 mx-4 -mt-6 overflow-hidden text-white bg-white shadow-lg rounded-xl dark:bg-gray-700 bg-clip-border shadow-blue-gray-500/40">
              <img
                src="{{asset('images/kitchen.png')}}"
                alt="img-blur-shadow"
                layout="fill"
              />
            </div>
            <div class="p-6">
              <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-gray-700 dark:text-gray-200 text-blue-gray-900">
                {{__('Become a Home Chef')}}
              </h5>
              <p class="block font-sans text-base antialiased font-light leading-relaxed text-gray-700 dark:text-gray-200 text-inherit">
                And together, we build a sustainable future by minimising food waste and fostering cultural exchange to create a more integrated society.
              </p>
            </div>
            <div class="p-6 pt-0">
              <a href="{{route('vendor.register')}}" wire:navigate.hover
                class="select-none rounded-lg bg-green-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button"
                data-ripple-light="true"
              >
              Start cooking
            </a>
            </div>
        </div>

    </div>
</section> --}}

<div class="max-w-full mb-10" style="background-image: url('{{asset('images/banner.png')}}')">
    <div class="flex flex-col py-10 mx-auto justify-items-center">
        <h2 class="pt-10 font-sans text-3xl font-extrabold text-center text-white sm:text-5xl">Become a Home Chef</h2>
        <p class="max-w-4xl py-10 mx-auto text-xl font-bold text-center text-gray-100">
            And together, we build a sustainable future by minimising food waste and fostering cultural exchange to create a more integrated society.
        </p>
        <div class="justify-center p-6 pt-0 mx-auto">
            <a href="{{route('vendor.register')}}" wire:navigate.hover
              class="select-none rounded-lg bg-gray-600 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button"
              data-ripple-light="true"
            >
            Start cooking
          </a>
        </div>
    </div>
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

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-IU2pPLhjggY8Nn3lcVgGUMqvY62w1r0&libraries=places&callback=initAutocomplete"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.0.2/glide.js"></script>

<script>
    var glide09 = new Glide('.glide-09', {
        type: 'carousel',
        autoplay: 1,
        animationDuration: 4500,
        animationTimingFunc: 'linear',
        perView: 6,
        classes: {
            activeNav: '[&>*]:bg-slate-700',
        },
        breakpoints: {
            1024: {
                perView: 4
            },
            640: {
                perView: 2,
                gap: 36
            }
        },
    });

    glide09.mount();
</script>
<!-- End Logos carousel -->

</x-landing-layout>
