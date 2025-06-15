<?php

namespace App\Livewire\Sections;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

/**
 * ProductsSection Component
 * 
 * Displays products based on position parameter with caching for improved performance
 */
class ProductsSection extends Component
{
    public $position = "HOME";
    public $products = [];

    /**
     * Initialize component with position parameter
     * 
     * @param string $position The position where products will be displayed
     * @return void
     */
    public function mount($position)
    {
        $this->position = $position;
        
        // Cache products for 1 hour to improve performance
        $this->products = Cache::remember('products_' . $this->position, 3600, function () {
            return Product::query()
                ->where('status', '=', true)
                ->orderBy('id', 'asc')
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.sections.products-section');
    }
}
