<?php

namespace App\Http\Livewire\Frontend;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShopCart extends Component
{
    use LivewireAlert;
    public $item = [];
    public $item_quantity;
    // public function mount(){
    //     foreach(Cart::instance('cart')->content() as $item){
    //         $this->item[] = $item;
    //     }
    //     $this->item_quantity = Cart::instance('cart')->get($this->item)->qty ?? 1 ;
    // }

    public function decreaseQuantity($rowID)
    {
        $product = Cart::instance('cart')->get($rowID);
        if ($product->qty > 1) {
            Cart::instance('cart')->update($rowID, $product->qty - 1);
            $this->emitTo('frontend.cart-count-component','refreshComponent');
        }
        else {
            $this->alert('error', 'This is minimum quantity you can add!');
        }
    }
    public function increaseQuantity($rowID)
    {
        $product = Cart::instance('cart')->get($rowID);
        if ( $product->qty < $product->model->quantity) {
            Cart::instance('cart')->update($rowID , $product->qty + 1);
            $this->emitTo('frontend.cart-count-component','refreshComponent');
        }
        else {
            $this->alert('error', 'This is maximum quantity you can add!');
        }
    }
    public function removeItem($rowID)
    {
        Cart::instance('cart')->remove($rowID);
        $this->emitTo('frontend.cart-count-component','refreshComponent');
        $this->alert('success', 'Product removed from cart!');
    }
    public function destroyAll()
    {
        if(Cart::instance('cart')->count() > 0){
            Cart::instance('cart')->destroy();
            $this->emitTo('frontend.cart-count-component','refreshComponent');
            $this->alert('success', 'All products removed from cart!');
        }
        else{
            $this->alert('error', 'Cart is empty!');
        }
    }
    public function render()
    {
        return view('livewire.frontend.shop-cart')->layout('layouts.master');
    }
}
