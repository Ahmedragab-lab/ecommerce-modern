<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        return view('livewire.frontend.cart')->layout('layouts.master');
    }
}
