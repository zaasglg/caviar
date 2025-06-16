<main>
    @if($promotion)
        <!-- Большой баннер для внутренней страницы -->
        <div class="w-full h-[300px] md:h-[400px] lg:h-[500px] relative">
            <img src="{{ $promotion->banner_url }}" 
                 alt="{{ $promotion->title }}" 
                 class="w-full h-full object-cover">
            
        </div>

        <!-- Контент акции -->
        <div class="mb-8 w-11/12 lg:w-9/12 mx-auto px-4 py-8 lg:py-12">
            @if($promotion->description)
                <div class="prose prose-lg max-w-none mb-8">
                    <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                        {{ $promotion->description }}
                    </p>
                </div>
            @else
                <!-- Дефолтный контент, если нет описания -->
                <h2 class="text-2xl md:text-3xl lg:text-[36px] font-bold mb-4">
                    Зона бесплатной доставки по <br class="hidden md:block"> г.Алматы (Заказ на любую сумму):
                </h2>
                <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                    Так же бесплатная доставка по Алматы действует при заказе на сумму от 30 000 тг., При заказе на меньшую сумму стоимость доставки составит 
                    2500 тг. Либо Экспресс-доставка по Алматы через службы такси, при условии оформления заказа до 17:00 по тарифам службы такси.
                </p>
            @endif
        </div>

        <!-- Товары по акции -->
        @if($promotion->products && $promotion->products->count() > 0)
            <div class="w-11/12 lg:w-9/12 mx-auto px-4 py-8 lg:py-12">
                <h2 class="text-2xl md:text-3xl lg:text-[36px] font-bold mb-6 md:mb-8">Товары по акции:</h2>
                @foreach($promotion->products as $product)
                    <div class="mb-6 last:mb-0">
                        <hr class="mb-6">
                        <livewire:parts.product-catalog :product="$product" :border="false" />
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
