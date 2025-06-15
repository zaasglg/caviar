<main class="pt-[93px] lg:pt-0">
    <section class="w-11/12 lg:w-9/12 mx-auto pt-10 ">
        <span
            class="text-[#C8B082] font-bold text-sm">{{ \Carbon\Carbon::parse($news->created_at)->format('Y-m-d') }}</span>

        <h2 class="text-xl font-bold mt-1">{{ $news->name }}</h2>

        <img src="{{ asset('storage/' . $news->hero) }}" alt="hero" class="w-full h-[400px] mt-4 object-cover">
    </section>
    <section class="py-5 lg:py-10 w-11/12 lg:w-9/12 mx-auto grid grid-cols-1 lg:grid-cols-6 gap-10">
        <div class="lg:col-span-4">
            {!! $news->description !!}
        </div>

        <div class="space-y-5 lg:col-span-2">
            @foreach ($recommendeds as $item)
                <a href="{{ route('post.single', ['id' => $item->id]) }}" class="relative block h-[250px] w-full">
                    <img src="{{ asset('/storage/'.$item->hero) }}" alt="news" class="w-full h-full object-cover">
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

    <livewire:sections.posts-section titlePage="Больше статьей" />

    <livewire:components.footer-short />

</main>
