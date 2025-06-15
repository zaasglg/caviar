<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use App\Models\Promotion;
use Illuminate\Support\Facades\Cache;

class OfferSection extends Component
{
    public $promotions = [];

    public function mount()
    {
        $this->promotions = Cache::remember('active_promotions', 3600, function () {
            return Promotion::where('is_active', true)->get();
        });
    }

    public function render()
    {
        return view('livewire.sections.offer-section', [
            'promotions' => $this->promotions
        ]);
    }
}
