<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
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
