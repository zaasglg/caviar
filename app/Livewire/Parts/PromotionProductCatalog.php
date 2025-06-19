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
            'price' => str_replace(' ', '', $new_price ?: $price),
            'weight' => $size, // Добавляем поле weight для совместимости с другими частями системы
            'options' => [
                'size' => $size,
                'hero' => $attachment, // Используем 'hero' вместо 'image' для единообразия
                'price' => str_replace(' ', '', $price),
                'new_price' => $new_price ? str_replace(' ', '', $new_price) : null,
                'old_price' => str_replace(' ', '', $price), // Оставляем old_price для обратной совместимости
                'type' => 'product' // Добавляем тип продукта для единообразия
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
