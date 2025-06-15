<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartAddress extends Component
{
    public $cities = [];
    #[Validate('required')] 
    public $name;

    #[Validate('required')] 
    public $city;

    #[Modelable]
    public $address = "";

    public $errors = [];

    public function mount() {
        $this->cities = City::all() ?? [];
    }

    public function saveAddress() {
        $this->validate();

        $address = Address::query()->create([
            'address' => $this->name,
            'city_id' => $this->city,
            'user_id' => Auth::user()->id
        ]);

        $this->reset(['name', 'city']);
    
        $this->dispatch('addedCity', true);

    }

    public function render()
    {
        return view('livewire.cart-address');
    }
}
