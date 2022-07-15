<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductDetails extends Component
{
    use LivewireAlert;
    public $slug;
    public $quantity=1;
    public $product_details;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product_details = Product::whereSlug($slug)->firstOrFail();
    }
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    public function increaseQuantity()
    {
        if ( $this->product_details->quantity > $this->quantity) {
            $this->quantity++;
        }
        else {
            $this->alert('error', 'This is maximum quantity you can add!');
        }
    }
    public function addToCart($id){
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $duplicate =  Cart::instance('cart')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;

        });
        if ($duplicate->isNotEmpty()) {
            $this->alert('warning', 'This product is already in your cart!');
        }
        else {
            Cart::instance('cart')->add($product->id, $product->name, $this->quantity, $product->price)
            ->associate(Product::class);
            $this->quantity = 1;
            $this->emitTo('frontend.cart-count-component','refreshComponent');
            $this->alert('success', 'Product added to cart!');
        }
    }
    public function addToWishlist($id){
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $duplicate =  Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($duplicate->isNotEmpty()) {
            $this->alert('warning', 'This product is already in your wishlist!');
        }
        else {
            Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)
            ->associate(Product::class);
            $this->emitTo('frontend.wishlist-count-component','refreshComponent');
            $this->alert('success', 'Product added to wishlist!');
        }
    }
    public function render()
    {
        $product = Product::whereSlug($this->slug)->withAvg('reviews','rating')->with('media','category','tags','reviews')
                    ->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $related_products = Product::where('product_category_id',$product->product_category_id)
                            ->with('firstMedia')->Active()->HasQuantity()->ActiveCategory()->take(4)->get();
        return view('livewire.frontend.product-details',compact('product','related_products'))->layout('layouts.master');
    }
}
