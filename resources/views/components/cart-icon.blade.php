<button class="focus:ring-0" onclick="window.location.href='{{route('cart-items')}}'">
    {{-- <img {{$attributes->merge(['class' => 'w-5 h-5 sm:w-6 sm:h-6']) }} src="{{asset('images/cart-24.png')}}" /> --}}
    <svg fill="none" class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-300"  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
    </svg>
    {{$slot}}
</button>
