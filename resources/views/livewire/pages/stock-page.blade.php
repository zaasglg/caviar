<main>

    <div class="w-full h-[500px]">
        <img src="{{ asset('storage/' . $promotion->image_path) }}" alt="image" class="w-full h-full object-cover">
    </div>
    <div class="mb-8 w-11/12 lg:w-9/12 mx-auto px-4 py-12">
        <h2 class="text-[36px] font-bold mb-4">Зона бесплатной доставки по <br> г.Алматы (Заказ на любую сумму):</h2>
        <p class="text-gray-700 text-[18px]">
        Так же бесплатная доставка по Алматы действует при заказе на сумму от 30 000 тг., При заказе на меньшую сумму стоимость доставки составит 
        2500 тг.  Либо Экспресс-доставка по Алматы через службы такси, при условии оформления заказа до 17:00 по тарифам службы такси.
        </p>
    </div>

    <div class="w-11/12 lg:w-9/12 mx-auto px-4 py-12">
        <h2 class="text-[36px] font-bold mb-4">Товар по акции:</h2>
        @forelse($promotion->products as $product)
            <hr>
            <livewire:parts.product-catalog :product="$product" :border="false">
        @empty
            <p>Нет товаров, участвующих в этой акции.</p>
        @endforelse
        
    </div>

    <livewire:components.footer-short />
</div>
