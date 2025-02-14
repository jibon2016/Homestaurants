<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnverifiedVendorDelmController extends Controller
{
    public function showMessageForVendor(){
        return view('unverified-vendor');
    }

    public function showMessageForDelm(){
        return view('unverified-delm');
    }
}
