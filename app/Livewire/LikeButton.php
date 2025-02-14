<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LikeButton extends Component
{
    public $vendor;
    public $isLiked;

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;
        $this->isLiked = $vendor->likedByCustomers->contains(Auth::user());
    }

    public function toggleLike()
    {
        if (Auth::check()) {
            if ($this->isLiked) {
                // Unlike the vendor
                $this->vendor->likedByCustomers()->detach(Auth::user());
                $this->isLiked = false;
            } else {
                // Like the vendor
                $this->vendor->likedByCustomers()->attach(Auth::user());
                $this->isLiked = true;
            }
        } else {
            // User is not logged in, display a session message
            Session::flash('message', 'You must be logged in to like.');
        }
    }

    public function render()
    {
        return view('livewire.like-button', ['totalLikes' => $this->vendor->likedByCustomers()->count()]);
    }

}
