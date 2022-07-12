<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class WishlistCountComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.frontend.wishlist-count-component');
    }
}
