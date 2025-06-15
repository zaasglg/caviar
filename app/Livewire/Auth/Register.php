<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required', message: "Это поле является обязательным!")]
    public $name;

    #[Validate('required', message: "Это поле является обязательным!")]
    public $phone_number;

    #[Validate('required', message: "Это поле является обязательным!")]
    #[Validate('email', message: "Введите email вида example@gmail.com")]
    #[Validate('unique:users', message: "Пользователь уже существует!")]
    public $email;

    #[Validate('required', message: "Это поле является обязательным!")]
    #[Validate('min:8', message: "Пароль должен состоять из 8 или более символов, содержать цифры, заглавные и строчные буквы.")]
    public $password;

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'ok.');
    }


    public function render()
    {
        return view('livewire.auth.register');
    }
}
