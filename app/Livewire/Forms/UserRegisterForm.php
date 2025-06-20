<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserRegisterForm extends Form
{
    #[Validate('required|min:5')]
    public $title = '';
}
