<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Category extends Component
{
    public $slug;
    // public $category;

    public function mount($slug)
    {
        $this->slug = $slug;
        dd($slug);
        // $this->category = ProductCategory::whereSlug($slug)->firstOrFail();
    }
    public function render()
    {
        // $category = ProductCategory::whereSlug($slug)->first();
        // $products = $category->products()->Active()->HasQuantity()->ActiveCategory()->paginate(12);
        return view('livewire.frontend.category')->layout('layouts.master');
    }
}
