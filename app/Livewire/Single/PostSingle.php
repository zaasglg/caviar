<?php

namespace App\Livewire\Single;

use App\Models\News;
use Livewire\Component;

class PostSingle extends Component
{
    public News $news;

    public function mount($id)
    {
        $this->news = News::find($id);
    }
    public function render()
    {
        return view('livewire.single.post-single', [
            'recommendeds' => News::all()->shuffle()->take(2)
        ]);
    }
}
