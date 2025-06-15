<main class="pt-[93px] lg:pt-0">
    <section class="w-11/12 lg:w-9/12 mx-auto py-12 grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div>
            <span
                class="text-[12px] font-bold text-[#C7A771]">{{ \Carbon\Carbon::parse($news[0]['created_at'])->format('Y-m-d') }}</span>
            <a href="{{ route('post.single', ['id' => $news[0]['id']]) }}" class="text-[30px] font-bold mt-2 block">
                {{ $news[0]['name'] }}
            </a>

            <p class="text-[16px] mt-10">
				{{ $news[0]['exception'] }}
			</p>
        </div>
        <div>
            <img src="{{ asset('/storage/' . $news[0]['hero']) }}" alt="news-p-1">
        </div>
    </section>

    <section class="w-11/12 lg:w-9/12 mx-auto py-12">
        <h2 class="text-3xl font-bold">Интересные факты</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-10">
            @foreach ($news->take(3) as $item)
                <a href="{{ route('post.single', ['id' => $item->id]) }}" class="relative">
                    <img src="{{ asset('/storage/' . $item->hero) }}" alt="news" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <span
                            class="text-[#C8B082] font-bold text-[12px]">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                        <p class="text-[16px] text-white font-bold mt-3">{{ $item->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <livewire:sections.posts-section titlePage="Новости, статьи и интересные факты" />

    <livewire:components.footer-short />
</main>
