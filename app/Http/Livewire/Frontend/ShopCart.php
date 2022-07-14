<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class ShopCart extends Component
{
    public function render()
    {
        return view('livewire.frontend.shop-cart')->layout('layouts.master');
    }
}
