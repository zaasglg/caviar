<?php

namespace App\Livewire\Parts;

use App\Models\Address;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CartAddAddress extends Component
{
    public $cities = [];

    #[Validate('required', message: "Поле «Город» обязательно для заполнения")] 
    public $city;

    #[Validate('required', message: "Поле Адрес обязательно для заполнения")]
    public $address = "";

    public function mount() {
        $this->cities = City::all() ?? [];
    }


    public function saveAddress() {
        $this->validate();

        $address = Address::query()->create([
            'address' => $this->address,
            'city_id' => $this->city,
            'user_id' => Auth::user()->id
        ]);

        $this->reset(['address', 'city']);
    
        $this->dispatch('addedCity', true);

    }

    public function render()
    {
        return view('livewire.parts.cart-add-address');
    }
}
