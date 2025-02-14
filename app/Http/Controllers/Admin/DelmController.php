<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Notifications\DelmStatusUpdated;
use Illuminate\Support\Facades\Notification;

class DelmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieving all vendors data
        $delms = DeliveryMan::orderBy('id', 'desc')->paginate(5);
        //dd($vendors);

        $delms->each(function ($delm) {
            $delm->govt_front = Storage::url($delm->govt_front);
            $delm->govt_back = Storage::url($delm->govt_back);
            $delm->driving_license = Storage::url($delm->driving_license);
            $delm->car_license = Storage::url($delm->car_license);
        });

        return view('admin.delm.index', ['delms' => $delms]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryMan $delm)
    {
        return view('admin.delm.edit', compact('delm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryMan $delm)
    {
         // Update vendor approval status after revision
         $validatedData = $request->validate([
            'approval_status' => 'required|string',
            ]);

            $delm->update($validatedData);

            Notification::send($delm, new DelmStatusUpdated($delm));

            return redirect()->route('delm.index')->withSuccess('You have successfully updated delivery man status!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryMan $delm)
    {
        $delm->delete();
        return redirect()->route('delm.index')->withSuccess('Rider Deleted Successfully');
    }
}
