<?php

namespace App\Livewire\Auth;

use App\Mail\ForgotPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ForgotPassword extends Component
{
    #[Validate('required', message: "Это поле является обязательным!")]
    #[Validate('email', message: "Введите email вида example@gmail.com")]
    public $email;

    public function sendResetLink() {
        $this->validate();

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::raw("Перейдите по ссылке для сброса пароля: " . url('/reset-password/' . $token), function ($message) {
            $message->to($this->email)
                ->subject('Сброс пароля');
        });

        session()->flash('success', 'Ссылка для сброса отправлена на Email!');
        
    }
    
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
