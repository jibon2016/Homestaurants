<x-main-layout>

    <div class="bg-gray-100 dark:bg-gray-950 py-8 mt-5 pt-20">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                class="bg-green-300 max-w-sm mx-auto items-right text-gray-800 dark:text-gray-950 font-semibold px-4 py-2 rounded-md">
                {{ session('message') }}
            </div>
        @endif

            <div class="flash-msg hidden bg-green-300 max-w-sm mx-auto items-right text-gray-800 dark:text-gray-950 font-semibold px-4 py-2 rounded-md">
                {{ session('message') }}
            </div>

        <div class="container mx-auto px-4">
            <h1 class="text-2xl dark:text-gray-200 font-semibold mb-4 text-center lg:mt-5">My Plate</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-4">
                        <table class="w-full">
                            <thead>
                                @if ($cartCount > 0)
                                <tr>
                                    <th class="text-left dark:text-gray-50 font-semibold">Foods</th>
                                    <th class="text-left dark:text-gray-50 font-semibold">Quantity</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if ($cartCount == 0)
                                <tr>
                                    <td class="text-red-500 text-center md:text-left">No Food item added to the plate</td>
                                </tr>
                                @else
                                @foreach($cartItems as $cartItem)
                                <tr>
                                    <td class="py-4">
                                        <div class="lg:flex lg:gap-2">
                                            <img class="h-16 w-16 mr-4" src="{{asset('storage/'.$cartItem->food->featured_image)}}" alt="Product image">
                                            <span class="font-semibold lg:pt-5 dark:text-gray-100">{{$cartItem->food->food_name}}</span>
                                            <p class="font-extrabold lg:pt-5 dark:text-gray-100">{{$cartItem->food->final_price}}{{$cartItem->food->currency}}</p>
                                            <form action="{{route('cart-remove', ['cart' => $cartItem->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 lg:pt-5">Remove</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <livewire:cart-quantity :cartItem="$cartItem" :key="$cartItem->id" />
{{--                                        <form action="{{route('cart-update', ['cart' =>$cartItem->id])}}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('PUT')--}}
{{--                                            --}}{{-- <div x-data="{ count: {{$cartItem->quantity}} }" class="flex items-center">--}}
{{--                                                <button type="button" class="px-2 py-1 text-gray-600 bg-gray-100 rounded-md" x-on:click="count++">+</button>--}}
{{--                                                <input type="number" min="1" name="quantity" class="w-16 px-2 py-1 text-center text-gray-700 bg-gray-100 rounded-md" x-model="count" x-on:input="count = parseInt($event.target.value)">--}}
{{--                                                <button type="button" class="px-2 py-1 text-gray-600 bg-gray-100 rounded-md" x-on:click="count > 1 ? count-- : null">-</button>--}}
{{--                                            </div> --}}
{{--                                            <div x-data="{ count: {{$cartItem->quantity}} }" class="flex items-center space-x-0">--}}
{{--                                                <button type="button" class="px-2 py-1 text-gray-800 bg-gray-100 border border-gray-700 rounded-l-sm" x-on:click="count > 1 ? count-- : null">-</button>--}}
{{--                                                <input type="number" min="1" name="quantity" class="w-16 px-2 py-1 text-center text-gray-700 bg-gray-100" x-model="count" x-on:input="count = parseInt($event.target.value)">--}}
{{--                                                <button type="button" class="px-2 py-1 text-gray-800 bg-gray-100 rounded-r-sm border border-gray-700" x-on:click="count++">+</button>--}}
{{--                                            </div>--}}

{{--                                            <button type="submit" class="text-green-500">Update</button>--}}
{{--                                        </form>--}}
                                    </td>

                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($cartCount == 0)
                <div class="md:w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <a class="bg-green-500 text-white py-2 px-4 rounded-lg mt-4 w-full" href="{{route('nearby.all.foods')}}"> Add Foods and Groceries</a>
                    </div>
                </div>
                @else
                <div class="md:w-1/3">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4 dark:text-gray-200">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span class="dark:text-gray-200">Subtotal</span>
                            <span class="dark:text-gray-200">{{$totalPrice}}{{$cartItem->food->currency}}</span>
                        </div>

                        <div class="flex justify-between mb-2">
                            <span class="dark:text-gray-200">Tax</span>
                            <span class="dark:text-gray-200">0.00</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold dark:text-gray-50">Total</span>
                            <span class="font-semibold dark:text-gray-50">{{$totalPrice}}{{$cartItem->food->currency}}</span>
                        </div>
                        <button onclick="window.location.href='{{route('order-form')}}'" class="bg-green-500 text-white py-2 px-4 font-bold rounded-lg mt-4 w-full">Checkout</button>
                        <button onclick="window.location.href='/nearby-foods'" class="bg-yellow-400 text-white py-2 px-4 rounded-lg mt-4 font-bold w-full">Add More</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    {{-- <script>
        function validateQuantity(input) {
            let value = Math.floor(input.value); // Round down to the nearest integer

            if (value < 1) {
                value = 1;
            }

            input.value = value;
        }

    </script> --}}
    </x-main-layout>
