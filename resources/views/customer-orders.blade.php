<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-left text-gray-800 dark:text-gray-200">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="px-2 py-6">

        @if ($fullOrders->isEmpty())
            <p class="text-red-500">No orders found</p>
        @else
            @foreach ($fullOrders as $order)

            <div class="w-full p-4 mb-6 text-left bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">#ID: {{$order->id}}</h5>
                {{-- <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Order Date & Time: {{$order->created_at}} GMT</p> --}}
                <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Booking Date & Time: {{ \Carbon\Carbon::parse($order->order?->expected_receive_time)->format('d-m-Y h:i A') ?? '' }}</p>
                <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <a href="#" class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <div class="text-left">
                            <div class="mb-1 text-md">Total Price</div>
                            <div class="-mt-1 font-sans font-semibold text-md">{{$order->total_price}}</div>
                        </div>
                    </a>
                    {{-- <a href="#" class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <div class="text-left">
                            <div class="mb-1 text-md">Payment Status</div>
                            <div class="-mt-1 font-sans text-lg font-extrabold @if($order->payment_status=='paid') text-green-500 @else text-blue-500 @endif">{{$order->payment_status}}</div>
                        </div>
                    </a>
                    @if ($order->payment_status == 'pending')
                    <form id="payment-form" action="{{ route('bkash-create-payment', ['price' => $order->total_price, 'order_id' => $order->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button id="pay-now-btn" type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">Pay Now</button>
                    </form>
                    @endif --}}
                </div>

                @if ($groupedOrderItems->has($order->id))

                @foreach ($groupedOrderItems[$order->id] as $orderItem)


                <div class="w-full p-4 mt-5 text-left bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{$orderItem->food->food_name}}</h5>
                    <p class="mb-5 text-base text-gray-700 sm:text-lg dark:text-gray-200">Price: {{$orderItem->price}}{{$orderItem->vendor->currency}} <br>
                        Item Quantity: {{$orderItem->quantity}} <br>
                        Receive Option: {{ $orderItem->delivery_option === 0 ? 'Pickup': 'Delivery'}} <br>
                        Delivery Charge: {{ $orderItem->delivery_option === 0 ? 'Not Applicable': $orderItem->delivery_charge}}<br>
                        Customization Text: {{$orderItem->request_message == null ? 'No request': $orderItem->request_message}} <br>
                        {{$orderItem->delivery_option === 1 ? 'Delivery': 'Pickup'}} Address: {{ $orderItem->delivery_option === 1 ? auth()->user()->address : $orderItem->vendor->vendor_address}} <br>
                        Homesturant's Name: {{$orderItem->vendor->vendor_name}} <br>
                        Homestaurant's Phone: {{$orderItem->vendor->phone}} <br>
                        @if ($orderItem->delivery_option === 1 && $orderItem->delm_response == 'accept delivery request')
                        Rider Name: {{$orderItem->delivery_men_id === null ? 'Not assign yet.': $orderItem->delivery_man->name}} <br>
                        Rider Phone: {{$orderItem->delivery_men_id === null ? 'Not assign yet.': $orderItem->delivery_man->phone}} <br>
                        @endif
                    </p>
                    <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                        <a href="#" class="w-full sm:w-auto bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                            <div class="text-left">
                                <div class="-mt-1 font-sans font-semibold text-md">Status: {{$orderItem->order_status}}</div>
                            </div>
                        </a>
                        @if ($orderItem->order_status == "delivered")
                        <a href="{{route('rating.form', $orderItem->id)}}" class="w-full sm:w-auto bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5">
                            <div class="text-left">
                                <div class="-mt-1 font-sans font-semibold text-md">Rate Food and Service</div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>


                @endforeach

                    @else
                        <p class="text-red-500">No specific order item found for this order</p>
                    @endif
                        </div>
                    @endforeach

                   <div class="mb-6">
                    {{ $fullOrders->links() }}
                   </div>
                @endif
            </div>
    </div>



   <x-session-success-msg />
</x-app-layout>
