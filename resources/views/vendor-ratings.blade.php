<x-main-layout>
        <div class="grid grid-cols-1 md:grid-cols-2 py-10 mt-16 px-6 md:px-10 lg:px-24">
           <div class="md:pt-16">
            <div class="flex items-center mb-2">
                <svg class="w-4 h-4 @if ($avg_rating >= 1.0) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($avg_rating >= 1.5 ) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($avg_rating >= 2.5) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($avg_rating >= 3.5) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($avg_rating >= 4.5) text-yellow-300 @else text-gray-300 @endif mr-1 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <p class="ml-2 text-lg font-medium text-gray-900 dark:text-white">{{number_format($avg_rating, 1)}} out of 5</p>
            </div>
            <p class="text-lg font-medium text-gray-500 dark:text-gray-400">{{$total_rating}} global ratings</p>
           </div>

           <div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-green-600 dark:text-green-500 hover:underline">5 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: {{$fiveStarsPercentage}}"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$fiveStarsPercentage}}%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-green-600 dark:text-green-500 hover:underline">4 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: {{$fourStarsPercentage}}"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$fourStarsPercentage}}%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-green-600 dark:text-green-500 hover:underline">3 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: {{$threeStarsPercentage}}"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$threeStarsPercentage}}%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-green-600 dark:text-green-500 hover:underline">2 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: {{$twoStarsPercentage}}"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$twoStarsPercentage}}%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-green-600 dark:text-green-500 hover:underline">1 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: {{$oneStarPercentage}}"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$oneStarPercentage}}%</span>
            </div>
           </div>

        </div>

        <div class="relative bg-white dark:bg-gray-950 pb-10">
            <div class="m-auto px-6 pt-10 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="px-2 md:px-0">
                    <h1 class="text-2xl font-extrabold font-sans text-center hover:uppercase text-gray-700 dark:text-gray-200 md:text-4xl mx-auto lg:w-10/12">{{__("All Reviews")}}</h1>
                </div>
            </div>
        </div>

        @foreach ($ratings_reviews as $review)
        <article class="px-6 md:px-10 lg:px-24 pb-16">
            <div class="flex items-center mb-4 space-x-4">
                <img class="w-10 h-10 rounded-full" src="{{asset('storage/'. $review->user->avatar)}}" alt="">
                <div class="space-y-1 font-medium dark:text-white">
                    <p>{{$review->user->name}}
                        <time datetime="{{$review->user->created_at->toIso8601String()}}" class="block text-sm text-gray-500 dark:text-gray-400">
                        Joined on {{$review->user->created_at->format('F Y')}}
                        </time>
                    </p>
                </div>
            </div>
            <div class="flex items-center mb-1">
                <svg class="w-4 h-4 @if ($review->rating >= 1) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($review->rating >= 2) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($review->rating >= 3) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($review->rating >= 4) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 @if ($review->rating == 5) text-yellow-300 @else text-gray-300 @endif mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <h3 class="ml-2 text-sm font-semibold text-gray-900 dark:text-white"></h3>
            </div>
            <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400"><p>Reviewed on <time datetime="{{$review->created_at->toIso8601String()}}">{{$review->created_at->format('F Y')}}</time></p></footer>
            <p class="mb-2 text-gray-500 dark:text-gray-400">{{$review->comment}}</p>

        </article>
        @endforeach

</x-main-layout>
