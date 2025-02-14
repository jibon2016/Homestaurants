<x-app-layout>
    <div class="pt-4 py-10">
        <div class="relative bg-gray-50 dark:bg-gray-800 pb-10">
            <div class="m-auto px-6 pt-24 md:px-12 lg:pt-[4.8rem] lg:px-7">
                <div class="px-2 md:px-0">
                    <h1 class="text-2xl font-semibold font-sans text-center mx-auto lg:ml-20 hover:capitalize text-gray-700 dark:text-gray-200 md:text-2xl lg:w-10/12">Notifications</h1>
                </div>
            </div>
        </div>

        <div class="mx-4">
            @forelse ($notifications as $notification)
        <div id="alert-additional-content-5" class="p-4 px-8 my-4 mx-auto justify-center border max-w-lg border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800" role="alert">
            <div class="mt-2 mb-4 text-sm {{ $notification->read_at ? 'text-gray-500 dark:text-gray-400' : 'text-black dark:text-gray-100' }}">
                @php
                    $data = json_decode($notification->data, true);
                @endphp
            {{ $data['message'] ?? '' }} Status: {{ $data['status'] ?? '' }}
            </div>
            <div class="flex gap-2">
                <form action="{{ route('customer.notifications.markAsRead') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                    <button type="submit" class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-yellow-600 dark:border-yellow-600 dark:text-yellow-500 dark:hover:text-white dark:focus:ring-yellow-800">Mark as Read</button>
                </form>
                <form action="{{ route('customer.notifications.markAsUnread') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                    <button type="submit" class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-yellow-600 dark:border-yellow-600 dark:text-yellow-500 dark:hover:text-white dark:focus:ring-yellow-800">Mark as Unread</button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-red-500 text-center">No notification is found</div>
        @endforelse
        </div>

    </div>
</x-app-layout>


