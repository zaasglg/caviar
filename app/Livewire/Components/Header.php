<?php

namespace App\Livewire\Components;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

/**
 * Header Component
 * 
 * Displays the site header with cart functionality
 */
class Header extends Component
{
    public $cartCount;

    /**
     * Initialize the component
     * 
     * @return void
     */
    public function mount() {
        $this->cartCount = Cart::count();
    }

    /**
     * Update cart count when items are added
     * 
     * @return void
     */
    #[On('cartAdded')]
    public function updateCount() {
        $this->cartCount = Cart::count();
    }

    /**
     * Render the header component
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.components.header');
    }
}
