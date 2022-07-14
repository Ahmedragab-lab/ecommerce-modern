<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Cart;
class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
    //    $cartcount=Cart::instance('cart')->content()->pluck('model')->count();
        // $cartcount = Cart::instance('cart')->model->count();
        return view('livewire.frontend.cart-count-component');
    }
}
