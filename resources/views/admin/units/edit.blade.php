<x-admin-app-layout>
    <div class="mt-10 pb-4 relative overflow-x-auto shadow-md sm:rounded-lg max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('units.update', $unit) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Unit Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="unit_name" value="{{$unit->unit_name}}" required autofocus autocomplete="unit_name" />
                <x-input-error :messages="$errors->get('unit_name')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-app-layout>
