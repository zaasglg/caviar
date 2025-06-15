<?php

namespace App\Livewire\Parts;


use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressProfile extends Component
{
    public $addresses = [];

    protected $listeners = ['addedCity'];

    public function addedCity($value)
    {
        $this->addresses = Auth::user()?->addresses ?? [];
    }

    public function mount()
    {
        $this->addresses = Auth::user()?->addresses ?? [];
    }

    public function deleteAddress($id)
    {
        Address::find($id)->delete();

        $this->addresses = Auth::user()?->addresses ?? [];

    }

    public function render()
    {
        return view('livewire.parts.address-profile');
    }
}
