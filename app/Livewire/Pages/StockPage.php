<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Promotion;

class StockPage extends Component
{
    public $id;

    public function mount($id = null)
    {
        $this->id = $id;
    }

    public function render()
    {
        $promotion = null;

        if ($this->id) {
            $promotion = Promotion::with('products')
                ->where('id', $this->id)
                ->where('is_active', true)
                ->first();
        }

        return view('livewire.pages.stock-page', [
            'promotion' => $promotion,
        ]);
    }
}
