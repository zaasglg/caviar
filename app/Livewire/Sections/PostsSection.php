<?php

namespace App\Livewire\Sections;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

/**
 * PostsSection Component
 * 
 * Displays news posts with caching for improved performance
 */
class PostsSection extends Component
{
    public $titlePage = "";
    public $news = [];

    /**
     * Initialize component with title parameter
     * 
     * @param string $titlePage The title for the posts section
     * @return void
     */
    public function mount($titlePage)
    {
        $this->titlePage = $titlePage;
        
        // Cache news for 1 hour to improve performance
        $this->news = Cache::remember('news_posts', 3600, function () {
            return News::query()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.sections.posts-section');
    }
}
