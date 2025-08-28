<?php

namespace App\Livewire\Parts;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Masmerise\Toaster\Toaster;

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

        Cart::add([
            'id' => $id . '_' . $size,
            'name' => $name . ' (' . $size . ' г)',
            'qty' => $qty,
            'price' => (int) str_replace(' ', '', $new_price ?: $price),
            'weight' => $size,
            'options' => [
                'hero' => $attachment,
                'price' => $price,
                'new_price' => $new_price ?? '',
                'type' => 'product'
            ]
        ]);

        $this->dispatch('cartAdded');
        $this->dispatch('success', 'Товар добавлен в корзину');
        Toaster::success('Вы успешно добавили товар в корзину!');
    }

    public function render()
    {
        return view('livewire.parts.promotion-product-catalog');
    }
}
