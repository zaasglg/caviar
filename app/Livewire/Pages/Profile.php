<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')]
    public $avatar;

    public function uploadImage()
    {
        $this->validate();

        $user = auth()->user();

        if ($this->avatar) {
            // Удаляем старый аватар
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Сохраняем новый аватар
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->update(['avatar' => $avatarPath]);

            // Эмитим событие для обновления UI
            $this->emit('avatarUpdated');
        }
    }
    public function deleteImage()
    {
        if (auth()->user()->avatar) {
            Storage::disk('public')->delete(auth()->user()->avatar);
            User::find(auth()->user()->id)->update(['avatar' => null]);
        }
    }


    public function logout()
    {
        Auth::logout();

        return $this->redirect('/login');
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
