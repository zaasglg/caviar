<?php

namespace App\Livewire\Sections;

use App\Models\Slider;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class CarouselSection extends Component
{
    /**
     * Render the carousel section with optimized slider data
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Cache sliders for 1 hour to improve performance
        $sliders = Cache::remember('carousel_sliders', 3600, function () {
            return Slider::orderBy('id', 'asc')->get();
        });
        
        return view('livewire.sections.carousel-section', [
            'sliders' => $sliders
        ]);
    }
}
