<section class="w-11/12 lg:w-9/12 mx-auto py-12">
    <h2 class="font-bold text-3xl">{{ $titlePage }}</h2>

    <div class="mt-10 grid grid-cols-1 lg:grid-cols-6 gap-5">
        <div class="space-y-5 lg:col-span-2 h-[550px] grid grid-rows-2">
            @foreach ($news as $key => $item)
                @if ($key < 2)
                    <a href="{{ route('post.single', ['id' => $item->id]) }}"
                        class="relative transition duration-200 group overflow-hidden">
                        <img src="{{ asset('/storage/' . $item->hero) }}" alt="news"
                            class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-[#C8B082] font-bold text-[12px]">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
                            </span>
                            <p class="text-[16px] text-white font-bold mt-1">
                                {{ $item->name }}
                            </p>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

        <div class="lg:col-span-4">
            <a href="{{ route('post.single', ['id' => $news[2]['id']]) }}"
                class="h-[250px] lg:h-[550px] relative block transition duration-200 group overflow-hidden">
                <img src="{{ asset('/storage/' .$news[2]['hero']) }}" alt="news"
                    class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105">
                <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black to-transparent"></div>
                <div class="absolute bottom-4 lg:bottom-8 left-4 lg:left-10 right-10">
                    <span class="text-[#C8B082] font-bold text-[12px]">
                        {{ \Carbon\Carbon::parse($news[2]['created_at'])->format('Y-m-d') }}
                    </span>
                    <p class="text-[16px] lg:text-[30px] text-white font-bold lg:leading-8 mt-1">
                        {{ $news[2]['name'] }}
                    </p>
                </div>
            </a>
        </div>
    </div>
</section>
