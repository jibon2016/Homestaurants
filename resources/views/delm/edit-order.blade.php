<x-delm-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Order') }}
        </h2>
    </x-slot>
    <div class="relative mt-5 bg-gray-50 dark:bg-gray-700 rounded-md overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{route('delm.update.order', $orderItem->id)}}">
            @csrf
            @method('PUT')

            <div class="mt-4">
                <x-input-label for="delm_response" :value="__('Rider Response')" />
                <select id="delm_response" name="delm_response" class="block mt-1 w-full rounded-md">
                    <option value="accept delivery request" {{$orderItem->order_status == 'accept delivery request' ? 'selected': ''  }}>Accept delivery request</option>
                    <option value="cancel delivery request" {{$orderItem->order_status == 'cancel delivery request' ? 'selected': ''  }}>Cancel delivery request</option>
                    <option value="delivered" {{$orderItem->order_status == 'delivered' ? 'selected': ''  }}>Delivered</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4 pb-4">
                <x-primary-button class="ml-4">
                    {{ __('Update Order') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-delm-app-layout>
