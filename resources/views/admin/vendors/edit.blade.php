<x-admin-app-layout>
    <div class="relative mt-5 overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('vendors.update', $vendor) }}">
            @csrf
            @method('PUT')

            <div class="mt-4">
                <x-input-label for="approval_status" :value="__('Approval Status')" />
                <select id="approval_status" name="approval_status" class="block mt-1 w-full">
                    <option value="pending" {{$vendor->approval_status == "pending" ? "selected":""}}>Pending</option>
                    <option value="approved" {{$vendor->approval_status == "approved" ? "selected":""}}>Approved</option>
                    <option value="rejected" {{$vendor->approval_status == "rejected" ? "selected":""}}>Rejected</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Update Status') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-app-layout>
