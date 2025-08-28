<main>
    @if($promotion)
        <!-- Большой баннер для внутренней страницы -->
        <div class="w-full h-[200px] sm:h-[250px] md:h-[350px] lg:h-[500px] relative">
            <img src="{{ '/storage/' . $promotion->banner_image_path }}" 
                 alt="{{ $promotion->title }}" 
                 class="w-full h-full object-cover">
        </div>

        <div class="mb-6 sm:mb-8 w-11/12 lg:w-9/12 mx-auto px-3 sm:px-4 py-6 sm:py-8 lg:py-12">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-[36px] font-bold mb-3 sm:mb-4 leading-tight">
                {{ $promotion->title }}
            </h2>
            <div class="text-gray-700 text-sm sm:text-base md:text-lg leading-relaxed prose prose-sm sm:prose max-w-none">
                {!! $promotion->description !!}
            </div>
        </div>

        @if($promotion->products && $promotion->products->count() > 0)
            <div class="w-11/12 lg:w-9/12 mx-auto px-3 sm:px-4 py-6 sm:py-8 lg:py-12">
                <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-[36px] font-bold mb-4 sm:mb-6 md:mb-8">Товары по акции:</h2>
                @foreach($promotion->products as $product)
                    @php
                        $selectedSizes = $product->pivot->selected_sizes ?? [];
                        // Декодируем JSON если это строка
                        if (is_string($selectedSizes)) {
                            $selectedSizes = json_decode($selectedSizes, true) ?? [];
                        }
                    @endphp
                    <div class="mb-4 sm:mb-6 last:mb-0">
                        <hr class="mb-4 sm:mb-6">
                        <livewire:parts.promotion-product-catalog 
                            :product="$product" 
                            :selectedSizes="$selectedSizes"
                            :border="false" />
                    </div>
                @endforeach
            </div>
        @endif

        <livewire:components.footer-short />
    @else
        <!-- Если акция не найдена -->
        <div class="w-11/12 lg:w-9/12 mx-auto px-4 py-12 text-center">
            <h1 class="text-2xl md:text-3xl font-bold mb-4">Акция не найдена</h1>
            <p class="text-gray-600 mb-8">К сожалению, запрашиваемая акция не существует или была удалена.</p>
            <a href="{{ route('home') }}" 
               class="inline-block bg-[#C8B082] text-white px-6 py-3 rounded-lg hover:bg-[#B8A072] transition-colors">
                Вернуться на главную
            </a>
        </div>
    @endif
</main>
