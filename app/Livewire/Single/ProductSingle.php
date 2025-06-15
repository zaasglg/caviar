<?php

namespace App\Livewire\Single;

use App\Models\Product;
use Livewire\Component;

class ProductSingle extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::find($id);
    }

    public function render()
    {
        return view('livewire.single.product-single');
    }
}
