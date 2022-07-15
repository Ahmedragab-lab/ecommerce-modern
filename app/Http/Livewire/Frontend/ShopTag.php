<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;

class ShopTag extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $pagesize=12;
    public $sorting='default';
    public $slug;
    public function mount($slug=null){
        if($slug != null){
            // dd($slug);
            $this->slug=$slug;
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
        switch ($this->sorting) {
            case 'popularity':
                $sort_field = 'created_at';
                $sort_type = 'asc';
                break;
            case 'low-high':
                $sort_field = 'price';
                $sort_type = 'asc';
                break;
            case 'high-low':
                $sort_field = 'price';
                $sort_type = 'desc';
                break;
            default:
                $sort_field = 'created_at';
                $sort_type = 'asc';
        }
        $products = Product::with('firstMedia');
        if ($this->slug == null) {
            $products = $products->ActiveCategory()
            ->Active()
            ->HasQuantity()
            ->orderBy($sort_field,$sort_type)
            ->paginate($this->pagesize);
        } else {
            $products = $products->with('tags')->whereHas('tags', function ($query) {
                $query->where([
                    'slug' => $this->slug,
                    'status' => true,
                ]);
            })->Active()
            ->HasQuantity()
            ->orderBy($sort_field,$sort_type)
            ->paginate($this->pagesize);
        }
        return view('livewire.frontend.shop-tag',['products' => $products])
                                               ->layout('layouts.master');
    }
}
