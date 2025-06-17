<section class="py-12 w-11/12 lg:w-9/12 mx-auto">
    @if ($single)
        <h2 class="text-xl lg:text-2xl font-bold">Спецпредложения:</h2>
    @else
        <h6 class="text-center text-[16px] text-{{ $color }}">Спец. предложения:</h6>
    @endif

    <div class="grid lg:grid-cols-2 mt-10 gap-5">
        @forelse($promotions as $promotion)
            <a href="{{ route('stock', ['id' => $promotion->id]) }}"
                class="w-full h-[110px] lg:h-[200px] transition-all duration-300 ease-in-out hover:scale-105 hover:opacity-90 overflow-hidden rounded-3xl flex flex-col justify-around relative group"
                loading="lazy">
                <img src="{{ $promotion->image_url }}" 
                     alt="{{ $promotion->title }}"
                     class="absolute inset-0 w-full h-full object-fill rounded-3xl transition-all duration-300 ease-in-out group-hover:scale-110">
                <div class="relative z-10 px-7 lg:px-10 flex flex-col justify-around h-full">
                    <!-- Здесь можно добавить текст поверх изображения если нужно -->
                </div>
            </a>
        @empty
            <span>Пусто</span>
        @endforelse
    </div>
</section>
