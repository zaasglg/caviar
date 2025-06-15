<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Title;

/**
 * Login Component
 * 
 * Handles user authentication
 */
class Login extends Component
{
    /**
     * User email for authentication
     */
    #[Validate('required', message: "Это поле является обязательным!")]
    #[Validate('email', message: "Введите email вида example@gmail.com")]
    public $email;

    /**
     * User password for authentication
     */
    #[Validate('required', message: "Это поле является обязательным!")]
    public $password;

    /**
     * Set the page title
     */
    #[Title("Caviar - Вход")]

    /**
     * Handle user login attempt
     * 
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function login()
    {
        $this->validate();

        if (Auth::attempt($this->all())) {
            $user = Auth::user();

            return $this->redirect('/profile');
        }

        session()->flash('error', 'Неверный логин или пароль!');
    }
    
    /**
     * Render the login form
     * 
     * @return \Illuminate\View\View
     */
    public function render()
{
        return view('livewire.auth.login');
    }
}
