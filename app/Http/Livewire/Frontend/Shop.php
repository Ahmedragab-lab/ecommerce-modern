<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Cart;
use Livewire\WithPagination;

class Shop extends Component
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
        // $shop_categories_menu=ProductCategory::tree();
        // if( $this->sorting == 'popularity'){
        //     $products = Product::orderBy('created_at','asc');
        // }
        // elseif($this->sorting == 'low-high'){
        //     $products = Product::orderBy('price', 'asc');
        // }
        // elseif($this->sorting == 'high-low'){
        //     $products = Product::orderBy('price', 'desc');
        // }
        // else{
        //     $products = Product::orderBy('created_at','desc');
        // }
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
            // dd($this->slug);
            $product_category = ProductCategory::whereSlug($this->slug)->whereStatus(true)->first();
            if (is_null($product_category->parent_id)) {
                $categoriesIds = ProductCategory::whereParentId($product_category->id)
                    ->whereStatus(true)->pluck('id')->toArray();
                $products = $products->whereHas('category', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                })
                ->Active()
                ->HasQuantity()
                ->orderBy($sort_field,$sort_type)
                ->paginate($this->pagesize);
            } else {
                $products = $products->with('category')->whereHas('category', function ($query) {
                    $query->where([
                        'slug' => $this->slug,
                        'status' => true
                    ]);
                })
                ->Active()
                ->HasQuantity()
                ->orderBy($sort_field,$sort_type)
                ->paginate($this->pagesize);
            }
        }
        // $products = Product::Active()
        // // ->Featured()
        // ->HasQuantity()
        // ->orderBy($sort_field,$sort_type)
        // // ->ActiveCategory()
        // ->paginate($this->pagesize);
        return view('livewire.frontend.shop',['products' => $products])
                                              ->layout('layouts.master');
    }
}
