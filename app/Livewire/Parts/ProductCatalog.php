<?php

namespace App\Livewire\Parts;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ProductCatalog extends Component
{
    public $product;
    public $border = true;

    public function mount(Product $product, $border = true)
    {
        $this->product = $product;
        $this->border = $border;
    }

    public function addToCart($id, $name, $qty, $size, $price, $img, $new_price)
    {
        // dd($name);

        $product = Product::find($id);

        $price = $new_price ? $new_price : $price;

        $weight = $size ? $size : $product->sizes[0]["name"];

        Cart::add(
            [
                'id' => $id,
                'name' => $name,
                'qty' => $qty,
                'price' => (int) str_replace(' ', '', $price),
                'weight' => $weight,
                'options' => [
                    'hero' => $img,
                    'price' => $price,
                    'new_price' => $new_price,
                    'type' => 'product'
                ]
            ]
        );

        $this->dispatch('cartAdded', true);

        Toaster::success('Вы успешно добавили товар в корзину!');

    }

    public function render()
    {
        return view('livewire.parts.product-catalog');
    }
}
