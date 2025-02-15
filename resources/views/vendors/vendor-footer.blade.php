@if (auth()->check())
    <div class="fixed shadow-2xl bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
            <a href="/" class="inline-flex flex-col items-center justify-center px-5 border-gray-200 border-x hover:bg-gray-50 dark:hover:bg-gray-800 group dark:border-gray-600">
                <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500">Home</span>
            </a>
            <a href="{{route('customer.notifications.index')}}" class="relative inline-flex flex-col items-center justify-center px-5 border-r border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 group dark:border-gray-600">
                <svg class="w-6 h-6 mt-1 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"/>
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500">Notifications</span>
                @if ($unreadNotifications > 0)
                    <span class="absolute top-0 center ml-4 bg-yellow-500 text-xs text-white rounded-full w-5 h-4 flex items-center justify-center">{{$unreadNotifications}}</span>
                @else
                    {{-- <span class="absolute top-0 center ml-4 bg-yellow-500 text-xs text-white rounded-full w-5 h-4 flex items-center justify-center">0</span> --}}
                    <span></span>
                @endif
            </a>

            <a href="{{route('customer.orders')}}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2"/>
                </svg>
                <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500">Orders</span>
            </a>
            <a href="/profile" class="inline-flex flex-col items-center justify-center px-5 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 group border-x dark:border-gray-600">
                @if (!empty(auth()->user()->avatar))
                    <img src="{{asset('storage/'. auth()->user()->avatar)}}" alt="profile photo" class="w-7 h-7 rounded-full">
                @else
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                @endif
                <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500">{{ isset(auth()->user()->name) ? explode(' ', auth()->user()->name)[0] : 'Profile' }}
            </span>
            </a>
        </div>
    </div>
@endif

<!-- This is an example component -->
<div class="bg-white shadow-lg dark:bg-gray-800 @if(auth()->check()) mb-10 pb-10 @endif">
    <div class="max-w-3xl mx-auto dark:text-white text-gray-900">
        <div class="text-center">
            <div class="flex justify-center pt-5 pb-2">
                <x-flowbite-logo />
            </div>
            <div class="flex justify-center py-5">
                <div class="flex items-center px-4 py-2 border border-gray-600 dark:border-gray-200 rounded-lg w-44 mx-2">
                    <img src="{{asset('images/google-play.png')}}" class="w-7 md:w-8">
                    <div class="text-left ml-3">
                        <p class='text-xs text-gray-800 dark:text-gray-200'>Download on </p>
                        <p class="text-sm md:text-base"> Android </p>
                    </div>
                </div>
                <div class="flex items-center px-4 py-2 border border-gray-600 dark:border-gray-200 rounded-lg w-44 mx-2">
                    <img src="{{asset('images/apple.png')}}" class="w-7 md:w-8 hidden dark:inline">
                    <img src="{{asset('images/apple-black-logo.png')}}" class="w-7 md:w-8 dark:hidden">
                    <div class="text-left ml-3">
                        <p class='text-xs text-gray-800 dark:text-gray-200'>Download on </p>
                        <p class="text-sm md:text-base"> iPhone </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex flex-col py-6 md:flex-row md:justify-between text-center items-center text-sm text-gray-800 dark:text-gray-200">
            <p class="order-2 md:order-1 mt-6 md:mt-0"> &copy; HOMESTAURANT'S 2023 </p>
            <div class="order-1 md:order-2 text-gray-800 dark:text-gray-200">
                <span class="px-2 hover:text-green-400"><a href="{{route('about-us')}}">About</a></span>
                <span class="px-2 hover:text-green-400 border-l border-gray-700 dark:border-gray-300"><a href="{{route('contact')}}">Contact</a></span>
                <span class="px-2 hover:text-green-400 border-l border-gray-700 dark:border-gray-300"><a href="{{route('recipes')}}">Recipes</a></span>
                <span class="px-2 hover:text-green-400 border-l border-gray-700 dark:border-gray-300"><a href="{{route('newsroom')}}">Newsroom</a></span>
                <span class="px-2 hover:text-green-400 border-l border-gray-700 dark:border-gray-300"><a href="{{route('privacy-policy')}}">Privacy Policy</a></span>
            </div>

            <div class="flex py-2 space-x-6 sm:justify-center">
                <a href="https://www.facebook.com/homestaurants" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    <span class="sr-only">Facebook page</span>
                </a>
                <a href="https://instagram.com/homestaurants005?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    <span class="sr-only">Instagram page</span>
                </a>
                <a href="https://www.linkedin.com/in/homestaurants?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"  viewBox="0 0 28 28" fill="currentColor" aria-hidden="true">    <path fill-rule="evenodd" d="M24,4H6C4.895,4,4,4.895,4,6v18c0,1.105,0.895,2,2,2h18c1.105,0,2-0.895,2-2V6C26,4.895,25.105,4,24,4z M10.954,22h-2.95 v-9.492h2.95V22z M9.449,11.151c-0.951,0-1.72-0.771-1.72-1.72c0-0.949,0.77-1.719,1.72-1.719c0.948,0,1.719,0.771,1.719,1.719 C11.168,10.38,10.397,11.151,9.449,11.151z M22.004,22h-2.948v-4.616c0-1.101-0.02-2.517-1.533-2.517 c-1.535,0-1.771,1.199-1.771,2.437V22h-2.948v-9.492h2.83v1.297h0.04c0.394-0.746,1.356-1.533,2.791-1.533 c2.987,0,3.539,1.966,3.539,4.522V22z"/></svg>
                    <span class="sr-only">Linkedin</span>
                </a>

            </div>

        </div>
    </div>
</div>
