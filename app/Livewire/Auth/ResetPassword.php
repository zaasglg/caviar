<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email;

    #[Validate('required', message: "Это поле является обязательным!")]
    #[Validate('min:8', message: "Пароль должен состоять из 8 или более символов, содержать цифры, заглавные и строчные буквы.")]
    #[Validate('confirmed', message: "Пароли не совпадают повторите попытку.")]
    public $password;
    public $password_confirmation;


    public function mount($token)
    {
        $reset = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$reset) {
            session()->flash('error', 'Неверный или просроченный токен');
            return;
        }

        $this->email = $reset->email;
    }

    public function resetPassword()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        $user->update(['password' => Hash::make($this->password)]);

        DB::table('password_reset_tokens')->where('email', $this->email)->delete();

        session()->flash('success', 'Пароль успешно изменен!');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
