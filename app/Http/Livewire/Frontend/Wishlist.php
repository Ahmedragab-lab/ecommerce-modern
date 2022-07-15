<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gloudemans\Shoppingcart\Facades\Cart;

class Wishlist extends Component
{
    use LivewireAlert;
    public function removetocart($rowId){
        $item = Cart::instance('wishlist')->get($rowId);
        $duplicate =  Cart::instance('cart')->search(function ($cartItem, $rId) use ($rowId) {
            return $rId === $rowId;
        });
        if ($duplicate->isNotEmpty()) {
            Cart::instance('wishlist')->remove($rowId);
            $this->alert('warning', 'Product removed from wishlist! but already in cart');
        }
        else {
            Cart::instance('wishlist')->remove($rowId);
            Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate(Product::class);
            $this->alert('success', 'Product added to cart successfully! & removed from wishlist');
        }
        $this->emitTo('frontend.wishlist-count-component','refreshComponent');
        $this->emitTo('frontend.cart-count-component','refreshComponent');
    }
    public function removeItem($rowID)
    {
        Cart::instance('wishlist')->remove($rowID);
        $this->emitTo('frontend.wishlist-count-component','refreshComponent');
        $this->alert('success', 'Product removed from wishlist!');
    }
    public function destroyAll()
    {
        if(Cart::instance('wishlist')->count() > 0){
            Cart::instance('wishlist')->destroy();
            $this->emitTo('frontend.wishlist-count-component','refreshComponent');
            $this->alert('success', 'All products removed from wishlist!');
        }
        else{
            $this->alert('error', 'Wishlist is empty!');
        }
    }
    public function render()
    {
        return view('livewire.frontend.wishlist')->layout('layouts.master');
    }
}
