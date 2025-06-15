<?php

namespace App\Livewire\Pages;

use App\Models\News;
use App\Models\Product;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

/**
 * Home Page Component
 * 
 * Main landing page of the application
 */
class Home extends Component
{
    /**
     * Set the page title
     */
    #[Title("Caviar - Главная страница")]
    
    /**
     * Render the home page
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view("livewire.pages.home");
    }
}
