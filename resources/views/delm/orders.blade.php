<x-delm-app-layout>
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
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">#{{$order->order_id}}00{{$order->id}}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Price: {{$order->price}}{{$order->currency}} {{"Qty:". $order->quantity}}
                </p>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Customer wants on: {{$order->order->expected_receive_time}}
                </p>
                @php
                $customerId = $order->order->user_id;
                $customer = App\Models\User::findOrFail($customerId);
                @endphp

                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Ordered by:   {{$customer->name }} <br>
                    Phone: {{$customer->phone}} <br>
                    Option: {{$order->delivery_option == 1 ? 'Delivery':'Pickup'}} <br>
                    Address: {{$customer->address}}
                </p>

                <p class="mb-3 font-normal text-red-500 dark:text-red-400 {{$order->delivery_option ==0 ? 'hidden':''}}">
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
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                    Homestaurant's Name: {{$order->vendor->vendor_name}} <br>
                    Homestaurant's Phone: {{$order->vendor->phone}} <br>
                    Address: {{$order->vendor->vendor_address}}
                </p>

                <a href="{{route('delm.edit.order', $order->id)}}" class="inline-flex items-center text-yellow-500 underline">
                    Accept delivery request and update status
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
</x-delm-app-layout>
