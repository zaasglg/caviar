<?php

namespace App\Livewire\Parts;

use App\Models\Address;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalProfile extends ModalComponent
{
    public $name;
    public $city;

    protected $rules = [
        'name' => 'required|min:3',
        'city' => 'required',
    ];

    public function saveAddress()
    {
        $this->validate();

        $address = Address::query()->create([
            'address' => $this->name,
            'city_id' => $this->city,
            'user_id' => Auth::user()->id
        ]);

        $this->dispatch('addedCity', 'true');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.parts.modal-profile', [
            'cities' => City::all()
        ]);
    }
}
