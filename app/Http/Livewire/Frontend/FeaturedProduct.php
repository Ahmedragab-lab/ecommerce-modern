<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Cart;
use Illuminate\Support\Facades\Auth;

class FeaturedProduct extends Component
{
    use LivewireAlert;

    public function addToCart($id){
        $product = Product::whereId($id)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $duplicate =  Cart::instance('cart')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;

        });
        if ($duplicate->isNotEmpty()) {
            $this->alert('warning', 'This product is already in your cart!');
        }
        else {
            Cart::instance('cart')->add($product->id, $product->name, 1, $product->price)
            ->associate(Product::class);
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
        // if(Auth::check()){
        //     Cart::instance('cart')->store(Auth::user()->email);
        //     Cart::instance('wishlist')->store(Auth::user()->email);
        //   }
        $feat_products = Product::with('firstMedia')->orderByDesc('created_at')->Featured()->Active()->HasQuantity()->ActiveCategory()->take(8)->get();
        return view('livewire.frontend.featured-product', compact('feat_products'));
    }
}
