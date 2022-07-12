<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Cart;

class ProductModalShared extends Component
{
    use LivewireAlert;
    public $slug;
    public $productModalCount=false;
    public $productModal;
    public $quantity=1;

    protected $listeners = ['showProductModalAction'];
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    public function increaseQuantity()
    {
        if ( $this->productModal->quantity > $this->quantity) {
            $this->quantity++;
        }
        else {
            $this->alert('error', 'This is maximum quantity you can add!');
        }
    }

    public function addToCart(){
        $duplicate =  Cart::instance('cart')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->productModal->id;
        });
        if ($duplicate->isNotEmpty()) {
            $this->alert('warning', 'This product is already in your cart!');
        }
        else {
            Cart::instance('cart')->add($this->productModal->id, $this->productModal->name, $this->quantity, $this->productModal->price)
            ->associate(Product::class);
            $this->quantity = 1;
            $this->emitTo('frontend.cart-count-component','refreshComponent');
            $this->alert('success', 'Product added to cart!');
        }
    }

    public function addToWishlist(){
        $duplicate =  Cart::instance('wishlist')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->productModal->id;
        });
        if ($duplicate->isNotEmpty()) {
            $this->alert('warning', 'This product is already in your wishlist!');
        }
        else {
            Cart::instance('wishlist')->add($this->productModal->id, $this->productModal->name, 1, $this->productModal->price)
            ->associate(Product::class);
            $this->emitTo('frontend.wishlist-count-component','refreshComponent');
            $this->alert('success', 'Product added to wishlist!');
        }
    }
    public function showProductModalAction($slug){
        // $this->slug = $slug;
        $this->productModalCount = true;
        $this->productModal = Product::whereSlug($slug)->withAvg('reviews','rating')->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
    }
    public function render()
    {
        return view('livewire.frontend.product-modal-shared');
    }
}
