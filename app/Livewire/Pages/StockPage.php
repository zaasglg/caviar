<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Promotion;

class StockPage extends Component
{
    public $id;

    public function render()
    {
        $promotions = Promotion::query();

        if ($this->id) {
            $promotions->where('id', $this->id);
        }

        return view('livewire.pages.stock-page', [
            'promotion' => $promotions->first(),
        ]);
    }
}
