<x-main-layout>
    <x-session-message />

    <div class="bg-gray-50 dark:bg-gray-950 mt-10 pt-16">
        {{-- <div class="relative mt-10 pt-16 md:pt-4">
            <div class="m-auto px-6 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="px-2 md:px-0">
                    <h1 class="text-2xl font-extrabold font-sans text-center uppercase hover:capitalize text-gray-700 dark:text-gray-200 md:text-4xl mx-auto lg:w-10/12">{{__("Food Details")}}</h1>
                </div>
            </div>
        </div> --}}


      <section class="container mx-auto max-w-[1200px] border-b py-5 lg:grid lg:grid-cols-2 lg:py-10">
        <!-- image gallery -->

        <div class="container mx-auto px-4">
          <img id="featuredImage" class="w-full"
            src="{{$food->featured_image === null ? asset('images/blank-image.png') : asset('storage/'.$food->featured_image)}}"
            alt="Featured image" />

          <div class="mt-3 grid grid-cols-4 gap-4">
            <div class="@if($food->first_image===null) hidden @endif">
              <img class="cursor-pointer gallery-image w-20 h-20"
                src="{{$food->first_image === null ? asset('images/blank-image.png') : asset('storage/'.$food->first_image)}}"
                alt="Food image" />
            </div>

            <div class="@if($food->second_image===null) hidden @endif">
              <img class="cursor-pointer gallery-image w-20 h-20"
                src="{{$food->second_image === null ? asset('images/blank-image.png') : asset('storage/'.$food->second_image)}}"
                alt="Food2 image" />
            </div>

            <div class="@if($food->third_image===null) hidden @endif">
              <img class="cursor-pointer gallery-image w-20 h-20"
                src="{{$food->third_image === null ? asset('images/blank-image.png') : asset('storage/'.$food->third_image)}}"
                alt="Food3 image" />
            </div>

            <div class="@if($food->fourth_image===null) hidden @endif">
              <img class="cursor-pointer gallery-image w-20 h-20"
                src="{{$food->fourth_image === null ? asset('images/blank-image.png') : asset('storage/'.$food->fourth_image)}}"
                alt="food4 image" />
            </div>
          </div>
          <!-- /image gallery  -->
        </div>


        <!-- description  -->

        <div class="mx-auto px-5 lg:px-5">
          <h2 class="pt-3 text-2xl font-bold lg:pt-0 dark:text-gray-200">{{$food->food_name}}</h2>
          <div class="mt-1">

            @php
                $totalRatingRows = \App\Models\Rating::where('food_id', $food->id)->count();
                $totalRating = \App\Models\Rating::where('food_id', $food->id)->sum('rating');
                if ($totalRatingRows > 0 ) {
                    $avgRating = $totalRating / $totalRatingRows;
                } else {
                    $avgRating = 0;
                }
            @endphp

            <div class="flex items-center">
                <p class="mt-1 text-sm mr-1 text-gray-600 dark:text-gray-300">{{ number_format($avgRating, 1) }}</p>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="h-4 w-4 @if ($avgRating > 0.5) text-yellow-400 @else text-gray-300 @endif">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="h-4 w-4 @if ($avgRating > 1.5) text-yellow-400 @else text-gray-300 @endif">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="h-4 w-4 @if ($avgRating > 2.5) text-yellow-400 @else text-gray-300 @endif">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="h-4 w-4 @if ($avgRating > 3.5) text-yellow-400 @else text-gray-300 @endif">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4 @if ($avgRating > 4.5) text-yellow-400 @else text-gray-300 @endif">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>

              <p class="mt-1 text-sm ml-1 text-gray-600 dark:text-gray-300">{{ '('. $totalRatingRows .')'}}</p>
            </div>
          </div>

          <p class="mt-5 font-bold dark:text-gray-300">
            @if ($food->available_quantity > 0)
            <span class="text-green-600 dark:text-green-500">
                Available
            </span>
            @else
            <span class="text-red-600 dark:text-red-500">
                Unavailable
            </span>
            @endif

          </p>
          {{-- <p class="font-bold dark:text-gray-300">Homestaurant's: <a href="{{route('vendor.foods', $food->vendor->id)}}"><span class="font-normal text-yellow-400 underline">{{$food->vendor->vendor_name}}</span></a></p> --}}
          {{-- <p class="font-bold dark:text-gray-300">
            Category: <span class="font-normal dark:text-gray-300">{{$food->category->name}}</span>
          </p> --}}

          <p class="mt-4 text-2xl lg:text-4xl font-bold text-yellow-500 dark:text-yellow-400">
            {{$food->final_price }} {{$food->currency}} <span class="text-xs text-gray-400 line-through">{{$food->price}}{{$food->currency}}</span>
          </p>

          <div class="mt-0">
            <div class="flex gap-1 text-gray-500 dark:text-gray-300">
                <span>{{$food->unit_amount}}</span>
                <span>{{$food->unit_name}}</span>
            </div>

          </div>

          {{-- <div class="mt-6">
            <p class="pb-2 text-md text-gray-600 dark:text-gray-200">Quantity</p>

            <div class="relative">
                <div class="flex dark:text-gray-300 h-8 w-8 cursor-text items-center justify-center border-t border-b active:ring-gray-500">
                        1
                </div>
                <div class="text-gray-500 dark:text-gray-300">
                    <p>Increase the quantity on the cart page.</p>
                </div>
            </div>
          </div> --}}

          <div class="mt-7 items-center gap-2">
            <form action="{{route('add-to-cart')}}" method="POST">
                @csrf
                <input type="hidden" name="food_id" value="{{$food->id}}">
                <input type="hidden" name="currency" value="{{$food->currency}}">
                <textarea name="request_message" class="w-full rounded-md dark:text-gray-300 dark:bg-gray-900 focus:ring-green-500" cols="30" rows="3" placeholder="Request your preference "></textarea><br>
                <button type="submit"
                class="flex w-full my-4 h-12 px-2 font-bold items-center justify-center rounded-md shadow-md bg-green-500 text-white duration-100 hover:bg-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="mr-1 h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                Add to plate
              </button>
            </form>

            <a href="{{route('vendor.foods', $food->vendor->id)}}" class="flex px-2 h-12 items-center justify-center shadow-md rounded-md text-gray-800  bg-red-200 duration-100 font-bold hover:bg-red-300">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="mr-1 h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
              </svg>

              Something else?
            </a>
          </div>
        </div>
      </section>

      <!-- product details  -->
      <section class="container mx-auto max-w-[1200px] px-5 py-5 lg:py-10">
        <h2 class="text-xl dark:text-gray-200">Food Ingredients </h2>
        <div class="pt-5 text-sm leading-5 text-gray-600 dark:text-gray-300">
            {!! $food->description !!} {{--Syntax converts html tag--}}
        </div>
      </section>

       <!-- product details  -->
       <section class="container mx-auto max-w-[1200px] px-5 py-5 lg:py-10">
        @php
            $reviews = App\Models\Rating::where('food_id', $food->id)->paginate(5);
        @endphp
        <h2 class="text-xl dark:text-gray-200">Ratings and Comments</h2>
        @if ($reviews->isNotEmpty())
            @foreach ($reviews as $review)
                <p class="dark:text-gray-300"><span class="font-extrabold">Rate: </span>
                {{$review->rating}} by <span class="text-yellow-500">{{$review->user->name}}</span></p>
                <div class="pt-5 text-sm leading-5 text-gray-600 dark:text-gray-300">
                    {!! $review->comment !!} {{--Syntax converts html tag--}}
                </div>
            @endforeach
            @else
                <p class="text-red-500 pt-4">No reviews yet.</p>

        @endif

      </section>

      <section class="container mx-auto max-w-[1200px] px-5 py-5 lg:py-5 mb-10">
        <h2 class="text-xl dark:text-gray-200">Browse more foods</h2>
        <a href="{{route('nearby.all.foods')}}" class="dark:text-yellow-400 text-yellow-400 underline">All Nearby Food Items</a>
      </section>
    </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const featuredImage = document.getElementById("featuredImage");
      const galleryImages = document.querySelectorAll(".gallery-image");

      // Store the original featured image source
      const originalFeaturedImageSrc = featuredImage.src;

      galleryImages.forEach((image) => {
        image.addEventListener("click", function () {
          // Get the currently displayed image source
          const currentDisplayedImageSrc = featuredImage.src;

          // Update the featured image's source with the clicked image's source
          featuredImage.src = image.src;

          // Restore the clicked image's source to the original featured image's source
          image.src = currentDisplayedImageSrc;
        });
      });
    });
  </script>



</x-main-layout>
