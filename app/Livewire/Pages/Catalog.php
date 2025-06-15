<?php

namespace App\Livewire\Pages;

use App\Models\Gift;
use App\Models\Product;
use Livewire\Component;

class Catalog extends Component
{
    public $active;


    public function mount(int $id = 1)
    {
        $this->active = $id;
    }

    public function render()
    {
        return view('livewire.pages.catalog', [
            'products_black' => Product::where("catalog_id", "=", 1)->where('status', '=', true)->get(),
            'products_red' => Product::where("catalog_id", "=", 2)->where('status', '=', true)->get(),
            'gifts' => Gift::all(),
        ]);
    }
}
