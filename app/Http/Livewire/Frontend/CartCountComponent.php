<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.frontend.cart-count-component');
    }
}
