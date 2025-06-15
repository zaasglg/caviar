<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SingleHeaderProduct extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart($qty, $size, $price, $new_price) {

        $price = $new_price ? $new_price : $price;

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $qty,
            'price' => (int) str_replace(' ', '', $price),
            'weight' => $size,
            'options' => [
                'hero' => $this->product->image,
                'price' => $price,
                'new_price' => $new_price,
                'type' => 'product'
                ]
            ]
        );

        Toaster::success('Товар успешно добавлен в корзину!');

        $this->dispatch('cartAdded', true);
    }

    public function render()
    {
        return view('livewire.single-header-product');
    }
}
