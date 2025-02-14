<x-vendor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Orders') }}
        </h2>
    </x-slot>
    <div class="relative overflow-x-auto grid md:grid-cols-2 lg:grid-cols-3 gap-4  py-12 max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        @if ($countOrders > 0 )
            @foreach ($orders as $order)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$order->food->food_name}}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Price: {{$order->price}}{{$order->currency}} {{"Qty:". $order->quantity}}
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Preferred Delivery Time: <br><span class="font-bold">{{ \Carbon\Carbon::parse($order->order->expected_receive_time)->format('d-m-Y h:i A') }}</span>
                </p>
                <p class="mb-3 font-normal text-green-500 dark:text-gray-400">
                    {{$order->request_message ? 'Request: '. $order->request_message : ''}}
                </p>
                @php
                $customerId = $order->order->user_id;
                $customer = App\Models\User::findOrFail($customerId);
                @endphp

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Ordered by:   {{$customer->name }}
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Phone: {{$customer->phone}}
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Option: {{$order->delivery_option == 1 ? 'Delivery':'Pickup'}}
                </p>

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 {{$order->delivery_option ==0 ? 'hidden':''}}">
                    Address: {{$customer->address}}
                </p>

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 {{$order->delivery_option ==0 ? 'hidden':''}}">
                    Delivery Charge: {{$order->delivery_charge}}{{$order->currency}}
                </p>

                <p class="mb-3 font-normal text-green-500 dark:text-green-400">
                    Order Status: {{$order->order_status}}
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Payment Method: {{$order->payment_method}}
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Payment Status: {{$order->order->payment_status}}
                </p>

                @php
                    $rider = App\Models\DeliveryMan::get();
                    $deliveryManId = $order->delivery_men_id;
                    $deliveryMan = null; // Initialize to null

                    if (!empty($deliveryManId) && !empty($rider)) {
                        try {
                            $deliveryMan = App\Models\DeliveryMan::findOrFail($deliveryManId);
                        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                            // Handle the exception (e.g., redirect to an error page)
                            // $deliveryMan will remain null in case of an exception
                        }
                    }
                @endphp

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 {{$deliveryManId === null ? 'hidden' : ''}}">
                    Delivery Man: {{$deliveryManId === null ? '' : $deliveryMan->name ?? 'Name not available'}}, Phone: {{$deliveryMan->phone ?? 'Not available'}}
                </p>


                <a href="{{route('vendor.edit.order', $order->id)}}" class="inline-flex items-center text-yellow-500 underline">
                     Update Status
                    <svg class="w-3 h-3 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                    </svg>
                </a>
            </div>
            @endforeach
            @else
            <div>
                <p class="dark:text-gray-300">No ordered placed yet.</p>
            </div>
        @endif

        {!! $orders->links() !!}
    </div>
    <x-session-success-msg />
</x-vendor-app-layout>
