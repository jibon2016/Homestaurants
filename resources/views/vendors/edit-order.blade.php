<x-vendor-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Order') }}
        </h2>
    </x-slot>
    <div class="relative mt-5 bg-gray-50 dark:bg-gray-700 rounded-md overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{route('vendor.update.order', $orderItem->id)}}">
            @csrf
            @method('PUT')

            <div class="mt-4">
                <x-input-label for="order_status" :value="__('Order Status')" />
                <select id="order_status" name="order_status" class="block mt-1 w-full rounded-md">
                    <option value="Pending" {{$orderItem->order_status == 'Pending' ? 'selected': ''  }}>Pending</option>
                    <option value="Accepted" {{$orderItem->order_status == 'Accepted' ? 'selected': ''  }}>Accepted</option>
                    <option value="Preparing"  {{$orderItem->order_status == 'Preparing' ? 'selected': ''  }}>Preparing</option>
                    <option value="Ready to pickup"  {{$orderItem->order_status == 'Ready to pickup' ? 'selected': ''  }}>Ready to pickup</option>
                    <option value="On delivery"  {{$orderItem->order_status == 'On delivery' ? 'selected': ''  }}>On delivery</option>
                    <option value="Delivered"  {{$orderItem->order_status == 'Delivered' ? 'selected': ''  }}>Delivered</option>
                    <option value="Picked up"  {{$orderItem->order_status == 'Picked up' ? 'selected': ''  }}>Picked up</option>
                </select>
            </div>
            {{-- <div class="mt-4 {{$orderItem->delivery_option == 0 ? 'hidden': ''}}">
                <x-input-label for="delivery_men_id" :value="__('Assign a Rider')" />
                <select id="delivery_men_id" name="delivery_men_id" class="block mt-1 w-full rounded-md">

                    @if ($delmCount > 0)
                        @foreach ($nearbyDeliveryMen as $delm)
                        <option value="{{$delm->id}}" {{$orderItem->delivery_men_id == $delm->id ? 'selected': ''}}>{{$delm->name.',' . ' Phone: '. $delm->phone . '('. number_format($delm->distance, 2). 'km)'}}</option>
                        @endforeach
                    @else
                    <option value="">Unavailable</option>
                    @endif
                </select>
            </div> --}}

            <div class="flex items-center justify-end mt-4 pb-4">
                <x-primary-button class="ml-4">
                    {{ __('Update Order') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-vendor-app-layout>
