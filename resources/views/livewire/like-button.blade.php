<!-- livewire/like-button.blade.php -->
<div class="py-4 text-gray-600 items-center dark:text-gray-200">
    <button wire:click="toggleLike" class="flex">
        @if ($isLiked)
        <svg fill="none" class="w-5 h-5 mt-1 text-pink-600" stroke="red" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
        </svg>
        @else
        <svg fill="none" class="w-5 h-5 mt-1" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
        </svg>
        @endif
        <span class="ml-2 mb-1 text-lg font-extralight">{{ $totalLikes }}</span>
    </button>

   <x-session-message />
</div>



