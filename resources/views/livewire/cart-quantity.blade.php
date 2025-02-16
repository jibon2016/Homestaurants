<div>
    <div class="flex items-center space-x-0">
        <button type="button" class="px-2 py-1 text-gray-800 bg-gray-100 border border-gray-700 rounded-l-sm" wire:click="decrement" >-</button>
        <input type="number" min="1" wire:model.blur="quantity" wire:change="updateQuantity" class="w-16 px-2 py-1 text-center text-gray-700 bg-gray-100" >
        <button type="button" class="px-2 py-1 text-gray-800 bg-gray-100 rounded-r-sm border border-gray-700" wire:click="increment" >+</button>
    </div>
</div>
