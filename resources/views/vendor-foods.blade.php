<x-main-layout>
<x-session-message />

   <div class="bg-gray-50 w-full pb-6 dark:bg-gray-950">
    @foreach ($vendor_details as $owner)
    <!-- Modal HTML -->
    <div id="mapModal" class="modal">
        <div class="modal-content">
        <span class="close">&times;</span>
        <div id="map"></div>
        </div>
    </div>

    <div class="dark:bg-gray-950 mt-10 pt-16 shadow-shadow-500 shadow-3xl rounded-md relative mx-auto flex h-full w-full max-w-[550px] flex-col items-center bg-cover bg-clip-border p-[16px] dark:text-white dark:shadow-none">
        <div class="relative mt-1 flex h-32 w-full justify-center rounded-xl bg-cover" style='background-image: url("{{asset('storage/'.$owner->cover_photo)}}");'>
          <div class="absolute -bottom-12 flex h-[88px] w-[88px] items-center justify-center rounded-full border-[4px] border-white bg-pink-400">
              <img class="h-full w-full rounded-full" src="{{asset('storage/'.$owner->avatar)}}" alt="" />
          </div>
        </div>

        <div class="mt-16 flex flex-col items-center">
          <h4 class="text-yellow-400 dark:text-yellow-300 text-xl font-bold">{{$owner->vendor_name}}</h4>
          <p class="text-lightSecondary text-sm font-normal">
             <span>
                Since {{$owner->created_at->format('F Y')}}
             </span>
          </p>
        </div>
        <div class="mt-6 mb-3 flex gap-4 md:gap-14">
          <div class="flex flex-col items-center justify-center">
            <h3 class="text-2xl font-bold">
                <a href="https://wa.me/{{$owner->whatsapp_number}}" target="_blank">
                <img src="{{asset('images/whatsapp_icon2.png')}}" alt="WhatsappIcon" class="w-6 h-6">
                </a>
            </h3>
            {{-- <p class="text-sm font-normal"><a href="https://wa.me/{{$owner->whatsapp_number}}" target="_blank">@if ($owner->whatsapp_number === null) Not Added @else WhatsApp @endif</a></p> --}}
          </div>
          <div class="flex flex-col items-center justify-center">
            <h3 class="text-2xl font-bold">
                <a href="tel:{{$owner->phone}}" target="_blank">
                    <img src="{{asset('images/mobile_icon.png')}}" alt="MobileIcon" class="w-6 h-6">
                </a>
            </h3>
            {{-- <p class="text-sm font-normal">Phone</p> --}}
          </div>
          <div class="flex flex-col items-center justify-center">
            <h3 class="text-2xl font-bold">
                <a href="#" id="openMapModal">
                  <img src="{{asset('images/google-maps.png')}}" alt="MapIcon" class="w-6 h-6">
                </a>
            </h3>
            {{-- <p class="text-sm font-normal">Address</p> --}}
          </div>
        </div>
    </div>
    @endforeach


   <div class="mx-2 pt-1" style="background-image: url('{{asset('images/bg-yellow.jpg')}}')">
    <div class="mt-5 mx-auto sm:w-3/4 p-5 rounded-3xl text-black">
        <h1 class="bg-clip-text text-white text-2xl text-center font-black font-serif mt-4">
           <b class="bg-yellow-600 px-2 py-2 rounded-3xl">MENU CARD</b>  <br>
            {{-- <small class="text-green-600 text-sm"><i>~ always fresh..always hot ~</i></small> --}}
        </h1>
        @foreach ($vendorFoodCategories as $categoryName => $categoryId)
            <h2 class="bg-clip-text text-center text-gray-700 text-lg font-serif mt-8"><b>{{ $categoryName }}</b></h2>
            <ul class="text-lg list-none font-sans font-extrabold pl-5 my-5">
                @foreach ($vendorFoods as $item)
                    @if ($item->category_id == $categoryId)
                        <li class="flex justify-between md:justify-center md:space-x-60">
                            <span><a class="text-black" href="{{route('food-details', $item->id)}}">{{$item->food_name}}</a></span>
                            <span class="text-black">
                                {{ $item->final_price }}
                            </span>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endforeach

        <p class="text-right mt-10 mb-4"><small class="text-yellow-700 text-xl font-extrabold">Thank You</small></p>
    </div>
   </div>

  <div class="mx-2 mb-10">
    <div class="mt-4 px-2 py-2 text-center w-full bg-green-500 shadow-lg rounded-md">
        <a href="{{route('nearby.all.foods')}}" class="px-2 py-2 text-white text-lg font-extrabold">Your Favourite Food</a>
    </div>
  </div>




    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}"></script>
    <script>
        // JavaScript to open the modal
    document.getElementById("openMapModal").addEventListener("click", function () {
    document.getElementById("mapModal").style.display = "block";
    initializeMap(); // Initialize the map when the modal is opened
    });

    // JavaScript to close the modal
    document.getElementsByClassName("close")[0].addEventListener("click", function () {
    document.getElementById("mapModal").style.display = "none";
    });

    // Initialize the Google Map
    function initializeMap() {
    // Replace '{{$owner->vendor_address}}' with the actual address you want to display
    var address = '{{$owner->vendor_address}}';

    // Use Geocoding to convert the address to LatLng
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
        var mapOptions = {
            center: results[0].geometry.location,
            zoom: 15
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
        } else {
        alert("Geocode was not successful for the following reason: " + status);
        }
    });
    }

    </script>

</x-main-layout>
