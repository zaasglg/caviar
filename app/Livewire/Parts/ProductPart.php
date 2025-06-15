<?php

namespace App\Livewire\Parts;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ProductPart extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart($size, $price, $attachment, $new_price)
    {

        $price = $new_price ? $new_price : $price;

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => 1,
            'price' => (int) str_replace(' ', '', $price),
            'weight' => $size,
            'options' => [
                'hero' => $attachment,
                'price' => $price,
                'new_price' => $new_price ?? '',
                'type' => 'product'
            ]
        ]);

        Toaster::success('Вы успешно добавили товар в корзину!');

        $this->dispatch('cartAdded', true);

    }

    public function render()
    {
        return view('livewire.parts.product-part');
    }
}
