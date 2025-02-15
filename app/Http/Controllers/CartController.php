<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
//use Illuminate\Queue\Jobs\RedisJob;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $cartItems = Cart::where('user_id', $user_id)->get();
        //dd($cartItems);
        $cartCount = $cartItems->count();
        //dd($cartCount);
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->food->final_price * $cartItem->quantity;
        });
        return view('cart', compact('cartItems', 'totalPrice', 'cartCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Food $food, Request $request)
    {
        $userId = Auth::user()->id;
        // dd($userId);
        $formFields = $request->validate([
            'food_id' => ['required', 'numeric'],
            'request_message' => ['nullable', 'string', 'max:300'],
        ]);

        // Check if the same user and same item already in cart or not
        $cartItem = Cart::where('user_id', $userId)->where('food_id', $formFields['food_id'])->first();

        // Get the selected food item from the database
        $selectedFood = Food::find($formFields['food_id']);
        if ($selectedFood->available_quantity === 0 || ($cartItem && $selectedFood->available_quantity - $cartItem->quantity === 0)) {
            // If the available_quantity is 0 or there are already enough items in the cart, the item can't be added to the cart
            return redirect()->back()->with('message', 'The selected food item is currently unavailable.');
        }

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $formFields['user_id'] = $userId;
            $formFields['quantity'] = 1;

            Cart::create($formFields);
        }

        return redirect()->back()->with('message', 'Food item added to your plate successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->food->available_quantity < $request->quantity) {
            return redirect()->back()->with('message', $request->quantity . ' items are not available for ' . $cart->food->food_name);
        }
        $formFields = $request->validate([
            'quantity' => ['required', 'numeric'],
        ]);

        $cart->update($formFields);

        return redirect()->back()->with('message', 'Quantity Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back()->with('message', 'Cart Item deleted successfully!');
    }
}
