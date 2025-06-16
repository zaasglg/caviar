<section class="py-12 w-11/12 lg:w-9/12 mx-auto">
    @if ($single)
        <h2 class="text-xl lg:text-2xl font-bold">Спецпредложения:</h2>
    @else
        <h6 class="text-center text-[16px] text-{{ $color }}">Спец. предложения:</h6>
    @endif

    <div class="grid lg:grid-cols-2 mt-10 gap-5">
        @forelse($promotions as $promotion)
            <a href="{{ route('stock', ['id' => $promotion->id]) }}"
                class="w-full h-[140px] lg:h-[200px] transition duration-200 hover:shadow-2xl hover:scale-[1.01] overflow-hidden bg-no-repeat bg-cover px-7 lg:px-10 rounded-3xl flex flex-col justify-around bg-center"
                style='background-image: url("{{ $promotion->image_url }}")' loading="lazy">
            </a>
        @empty
            <span>Пусто</span>
        @endforelse
    </div>
</section>
