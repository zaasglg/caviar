<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Toaster extends Component
{
    public $notifications = [];


    #[On('post-created')]

    public function notify($message, $type = 'success')
    {
        $this->notifications[] = [
            'id' => uniqid(),
            'message' => $message,
            'type' => $type,
        ];
    }

    public function dismiss($id)
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $id);
    }

    public function render()
    {
        return view('livewire.components.toaster');
    }
}
