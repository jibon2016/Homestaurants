<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartQuantity extends Component
{
    public $cartItem;
    public $quantity;

    public function mount($cartItem): void
    {
        $this->cartItem = $cartItem;
        $this->quantity = $cartItem->quantity;
    }

    public function updateQuantity():void
    {
        if ($this->cartItem->food->available_quantity < $this->quantity) {
            $this->cartItem->quantity = $this->cartItem->food->available_quantity;
            $this->cartItem->save();
            $this->dispatch('notify', ['message' => 'Stock finish']);
        }else{
            $this->cartItem->quantity = $this->quantity;
            $this->cartItem->save();
        }
    }

    public function increment():void
    {
        if ($this->cartItem->food->available_quantity < $this->quantity) {
            $this->dispatch('notify', ['message' => 'Stock Finish']);
        }else{
            $this->quantity++;
            $this->cartItem->quantity = $this->quantity;
            $this->cartItem->save();
        }
    }

    public function decrement(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->cartItem->quantity = $this->quantity;
            $this->cartItem->save();
        }
    }
    public function render(): \Illuminate\View\View
    {
        return view('livewire.cart-quantity');
    }
}
