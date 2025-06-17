<?php

namespace App\Livewire\Parts;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class PromotionProductCatalog extends Component
{
    public $product;
    public $selectedSizes = [];
    public $border = false;

    public function mount($product, $selectedSizes = [], $border = false)
    {
        $this->product = $product;
        $this->selectedSizes = is_string($selectedSizes) ? json_decode($selectedSizes, true) : $selectedSizes;
        $this->border = $border;
    }

    public function addToCart($id, $name, $qty, $size, $price, $attachment, $new_price)
    {
        // Проверяем, разрешен ли этот размер в акции
        if (!empty($this->selectedSizes) && !in_array($size, $this->selectedSizes)) {
            $this->dispatch('error', 'Этот размер не участвует в акции');
            return;
        }

        $cartItem = [
            'id' => $id . '_' . $size,
            'name' => $name . ' (' . $size . ' г)',
            'qty' => $qty,
            'price' => str_replace(' ', '', $new_price ?: $price),
            'options' => [
                'size' => $size,
                'image' => $attachment,
                'old_price' => str_replace(' ', '', $price),
                'new_price' => $new_price ? str_replace(' ', '', $new_price) : null,
            ]
        ];

        Cart::add($cartItem);
        $this->dispatch('cartAdded');
        $this->dispatch('success', 'Товар добавлен в корзину');
    }

    public function render()
    {
        return view('livewire.parts.promotion-product-catalog');
    }
}
