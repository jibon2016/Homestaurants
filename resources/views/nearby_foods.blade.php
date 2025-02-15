<!--Category Filtering-->
<div class="py-2 mb-2 flex justify-center items-center">
    <form action="{{ route('nearby.all.foods', $categoryId) }}" method="GET" class="flex">
        <div class="flex sm:flex-row items-center">
            <label for="category"></label>
            <select id="category" name="category" class="rounded-l-md mb-2 w-8 md:w-32 border border-gray-500">
                <option value=""></option>
                @foreach ($categories as $category )
                    <option value="{{ $category->id }}" {{ $category->id == $selectedCategory ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="text" name="food_name" placeholder="Type food name" class="mb-2" value="{{ $food_name }}">
            <button type="submit" class="bg-green-500 border border-green-500 hover:bg-green-600 text-white font-semibold px-2 mb-2 py-2 rounded-r-md">Filter</button>
        </div>
    </form>
</div>

<div class="mt-0 justify-items-center grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-4 px-0 sm:px-4 lg:px-4">
    @if($numberOfRows > 0)
    @foreach ($nearbyFoodItems as $nearbyFood)
    @php
        $totalRatingRows = \App\Models\Rating::where('food_id', $nearbyFood->id)->count();
        //dd($totalRatingRows);
        $totalRating = \App\Models\Rating::where('food_id', $nearbyFood->id)->sum('rating');
        if ($totalRatingRows > 0 ) {
            $avgRating = $totalRating / $totalRatingRows;
        } else {
            $avgRating = 0;
        }
    @endphp

    <div class="flex flex-row justify-between">
        <div class="flex shadow-md rounded-md dark:bg-gray-800">
            <div class="w-20 h-20 ml-2 mt-2">
                <a href="{{route('food-details', $nearbyFood->id)}}">
                <img src="{{asset('storage/' . $nearbyFood->featured_image)}}" alt="Food Image" class="w-16 h-16 mt-1">
                </a>
            </div>
            <div class="px-4 pt-2">
               <h2><a class="text-lg dark:text-white font-semibold" href="{{route('food-details', $nearbyFood->id)}}">{{Str::limit($nearbyFood->food_name, 10)}}</a></h2>
               <p class="text-sm dark:text-gray-100 flex gap-1">
                {{number_format($avgRating, 1)}}
                <svg fill="none" stroke="currentColor" class="w-4 h-4 text-green-500" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                </svg>
                @if ($totalRatingRows > 0)
                ({{$totalRatingRows . ' reviews'}})
                @else
                ({{__('0 reviews')}})
                @endif
               </p>
               <p>
                <span class="text-sm text-gray-700 dark:text-gray-100 pt-0.5 pr-2">{{$nearbyFood->unit_amount}}{{$nearbyFood->unit_name}}</span>
                <span class="text-md font-semibold dark:text-white">{{$nearbyFood->final_price}}</span>
               </p>
            </div>
        </div>
        <div class="ml-2">
            <a href="{{route('vendor.foods', $nearbyFood->vendor->id)}}">
             <img class="mx-2 mt-2 w-14 h-14 my-2 rounded-full" src="{{asset('storage/' . $nearbyFood->vendor->avatar)}}" alt="Vendor Image">
            </a>
        </div>
    </div>
    @endforeach
    @endif
</div>

<div class="px-2 mb-10 rounded-sm max-w-sm mx-auto items-center mt-4">
    {{$nearbyFoodItems->links()}}
</div>








