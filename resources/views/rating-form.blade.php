<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leave Rating & Comment') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('submit.rating.form', $orderItemId->id) }}" class="max-w-md mx-auto px-2 items-center">
        @csrf

        <!-- Name -->
        <h2 class="text-xl dark:text-gray-300 pt-8">Rating on:</h2>
        <img src="{{asset('storage/'.$orderItemId->food->featured_image)}}" alt="Item Image" width="150" height="150">
        <h2 class="text-md dark:text-gray-300 mt-2"><a class="text-yellow-400 underline" href="{{route('food-details', $orderItemId->food->id)}}">{{$orderItemId->food->food_name}}</a></h2>
        <div class="mt-4">
            <x-input-label for="rating" :value="__('What\'s your rating on food?')" />
            <select name="rating" id="rating" class="border-gray-300 block mt-1 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                <option value="">Select your rating</option>
                <option value="1" {{$ratingByUser?->rating == 1 ? 'selected' : '' }}>1 star</option>
                <option value="2" {{$ratingByUser?->rating == 2 ? 'selected' : '' }}>2 star</option>
                <option value="3" {{$ratingByUser?->rating == 3 ? 'selected' : '' }}>3 star</option>
                <option value="4" {{$ratingByUser?->rating == 4 ? 'selected' : '' }}>4 star</option>
                <option value="5" {{$ratingByUser?->rating == 5 ? 'selected' : '' }}>5 star</option>
            </select>
            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
        </div>

        <!-- cooment -->
        <div class="mt-4">
            <x-input-label for="comment" :value="__('Comment')" />
            <textarea name="comment" id="comment"  rows="4" class="w-full rounded-md focus:border-green-500 focus:ring-green-500">{{$ratingByUser?->comment}}</textarea>
            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
        </div>

        @if ($orderItemId->delivery_option === 1)
        <h2 class="text-xl dark:text-gray-300 pt-8">Experience in our delivery service:</h2>
        <p class="dark:text-gray-300"><span class="font-extrabold">Rider:</span> {{$orderItemId->delivery_man->name}}</p>
        <p class="dark:text-gray-300"><span class="font-extrabold">Phone:</span> {{$orderItemId->delivery_man->phone}}</p>
        <div class="mt-4">
            <x-input-label for="drating" :value="__('What\'s your rating on delivery man?')" />
            <select name="drating" id="drating" class="border-gray-300 block mt-1 w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm">
                <option value="">Select your rating</option>
                <option value="1" {{$ratingByUser->drating == 1 ? 'selected' : '' }}>1 star</option>
                <option value="2" {{$ratingByUser->drating == 2 ? 'selected' : '' }}>2 star</option>
                <option value="3" {{$ratingByUser->drating == 3 ? 'selected' : '' }}>3 star</option>
                <option value="4" {{$ratingByUser->drating == 4 ? 'selected' : '' }}>4 star</option>
                <option value="5" {{$ratingByUser->drating == 5 ? 'selected' : '' }}>5 star</option>
            </select>
            <x-input-error :messages="$errors->get('drating')" class="mt-2" />
        </div>

        <!-- cooment -->
        <div class="mt-4">
            <x-input-label for="dcomment" :value="__('Comment')" />
            <textarea name="dcomment" id="dcomment"  rows="4" class="w-full rounded-md focus:border-green-500 focus:ring-green-500">{{$ratingByUser->dcomment}}</textarea>
            <x-input-error :messages="$errors->get('dcomment')" class="mt-2" />
        </div>
        @endif

        <div class="items-center justify-end mt-4 pb-8">
            <x-primary-button class="ml-0">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
