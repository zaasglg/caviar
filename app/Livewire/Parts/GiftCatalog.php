<?php

namespace App\Livewire\Parts;

use App\Models\Gift;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class GiftCatalog extends Component
{
    public Gift $gift;

    public function mount(Gift $gift)
    {
        $this->gift = $gift;
    }

    public function addToCart($qty, $price, $new_price)
    {

        $price = $new_price ? $new_price : $price;

        Cart::add(
            [
                'id' => $this->gift->id,
                'name' => $this->gift->name,
                'qty' => $qty,
                'price' => (int) str_replace(' ', '', $price),
                'weight' => 0,
                'options' => [
                    'hero' => $this->gift->image,
                    'price' => $price,
                    'new_price' => $new_price,
                    'type' => 'gift'
                ]
            ]
        );

        $this->dispatch('cartAdded', true);

    }

    public function render()
    {
        return view('livewire.parts.gift-catalog');
    }
}
