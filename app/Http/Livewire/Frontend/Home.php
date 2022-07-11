<?php

namespace App\Http\Livewire\Frontend;

use App\Models\ProductCategory;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $categorys = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
        // dd($categorys);
        return view('livewire.frontend.home',compact('categorys'))->layout('layouts.master');
        // return view('layouts.master');
    }
}
