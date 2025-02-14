<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMan;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DelmProfileUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class DelmProfileController extends Controller
{
    // Get delivery man data
    public function edit($id)
    {
        $id = Auth::guard('delivery_man')->user()->id;
        //dd($id);
        $deliveryMan = DeliveryMan::findOrFail($id);
        return view('delm.profile.edit', ['deliveryMan' => $deliveryMan]);
    }

    public function update(DelmProfileUpdateRequest $request): RedirectResponse
    {
        $deliveryMan = $request->user();

        $deliveryMan->name = $request->input('name');
        $deliveryMan->phone = $request->input('phone');
        $deliveryMan->dial_code = $request->input('dial_code');
        $deliveryMan->whatsapp_number = $request->input('whatsapp_number');
        $deliveryMan->bank_name = $request->input('bank_name');
        $deliveryMan->account_number = $request->input('account_number');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatars', 'public');
            $deliveryMan->avatar = $avatarPath;
        }


        $deliveryMan->save();

        return Redirect::route('edit.delm.profile', auth()->user()->id)->with('success', 'Your profile updated successfully!');
    }
}
