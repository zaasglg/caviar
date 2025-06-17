<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 lg:gap-10 items-start md:items-center {{ $border ? 'border border-[#D5D5D5]' : '' }} p-3 sm:p-5 lg:p-10 mt-5 sm:mt-8 lg:mt-10"
    x-data="promotionCatalogProduct">
    <a href="{{ route('catalog.single', ['id' => $product->id]) }}" class="flex justify-center order-1 md:order-none">
        <img :src="'/storage/' + attachment" alt="{{ $product->name }}" class="w-full max-w-[200px] sm:max-w-[250px] md:max-w-none h-auto object-contain">
    </a>    <div class="md:col-span-1 lg:col-span-2 order-2 md:order-none">

        <span class="font-bold text-[#C8B082] block text-xs sm:text-sm lg:text-base mb-1 sm:mb-2">{{ $product->category }}</span>

        <a href="{{ route('catalog.single', ['id' => $product->id]) }}"
            class="block text-sm sm:text-lg md:text-xl lg:text-2xl font-bold mb-3 sm:mb-4 lg:mt-3 hover:text-[#C8B082] transition-colors">{{ $product->name }}</a>
        

        @if ($product->sizes)
            <div class="flex items-center justify-start flex-wrap gap-1 sm:gap-2 lg:gap-3 mt-3 sm:mt-4 lg:mt-5">
                @foreach ($product->sizes as $item)
                    @php
                        $isInPromotion = empty($selectedSizes) || in_array($item['name'], $selectedSizes);
                        $isStock = $item['is_stock'];
                    @endphp

                    {{-- Показываем только размеры, которые в наличии И участвуют в акции --}}
                    @if($isStock && $isInPromotion)
                        <button 
                            type="button" 
                            wire:key='{{ $item['name'] }}'

                            x-init="
                                id = {{ $product->id }};
                                name = '{{ $product->name }}';
                                attachment = '{{ $product->image }}';
                                
                                // Автоматически выбираем первый доступный размер, если еще не выбран
                                if (!size) {
                                    size = '{{ $item['name'] }}';
                                    price = '{{ number_format($item['old_price'], 0, ',', ' ') }}';
                                    new_price = '{{ $item['new_price'] ? number_format($item['new_price'], 0, ',', ' ') : '' }}';
                                    attachment = '{{ $item['attachments'][0] ?? $product->image }}';
                                }
                            "

                            @click="
                                update(
                                    '{{ $item['name'] }}',
                                    '{{ number_format($item['old_price'], 0, ',', ' ') }}',
                                    '{{ $item['attachments'][0] ?? $product->image }}',
                                    '{{ $item['new_price'] ? number_format($item['new_price'], 0, ',', ' ') : '' }}'
                                )
                            "

                            class="w-[32px] sm:w-[40px] lg:w-[50px] h-[32px] sm:h-[40px] lg:h-[50px] flex justify-center items-center rounded-full border border-[#E1C37A] text-[8px] sm:text-[10px] lg:text-[12px] cursor-pointer hover:bg-[#E1C37A] hover:text-white transition-colors"
                        >
                            <span class="font-bold w-full h-full flex justify-center items-center rounded-full"
                                :class="size == {{ $item['name'] }} ? 'bg-[#E1C37A] text-white' : ''">
                                {{ $item['name'] }} г
                            </span>
                        </button>
                    @endif

                @endforeach
            </div>
        @endif

        <div
            class="w-full sm:w-[150px] md:w-[180px] lg:w-[200px] grid grid-cols-3 py-1 sm:py-1.5 lg:py-2 border border-[#B9B9B9] rounded-[3px] mt-4 sm:mt-6 lg:mt-10">
            <button type="button" class="text-[#C8B082] font-bold text-sm sm:text-base hover:bg-[#C8B082] hover:text-white transition-colors rounded-l-[3px]" @click="decrement()">-</button>
            <span class="font-bold text-center text-xs sm:text-sm lg:text-base leading-loose bg-gray-50" x-text="qty + ' шт'"></span>
            <button type="button" class="text-[#C8B082] font-bold text-sm sm:text-base hover:bg-[#C8B082] hover:text-white transition-colors rounded-r-[3px]" @click="increment()">+</button>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between lg:justify-start mt-0 lg:mt-10 space-y-2 lg:space-y-4 sm:space-x-4 lg:space-x-10">
            <div class="order-2 sm:order-1 mt-5 lg:mt-0">
                <p x-text="price + ' Тг'" class="text-sm sm:text-lg md:text-xl lg:text-2xl font-bold text-left"
                    :class="new_price ? '!text-[#C7A771] !text-xs sm:!text-sm md:!text-lg lg:!text-xl line-through' : ''"></p>
                <p class="text-sm sm:text-lg md:text-xl lg:text-2xl font-bold text-left text-green-600" x-show='new_price' x-text="new_price + ' Тг'"></p>
            </div>

            <div class="order-1 sm:order-2">
                <button type="button" @click="addToCart()"
                    class="w-full sm:w-auto border border-[#C8B082] transition duration-500 hover:bg-[#C8B082] hover:text-white py-2 sm:py-2.5 lg:py-2.5 px-4 sm:px-6 lg:px-8 min-w-[120px] sm:min-w-[140px] lg:min-w-[14rem] rounded-[3px] text-black text-xs sm:text-sm lg:text-[14px] font-bold text-center">В
                    корзину</button>
            </div>
        </div>
    </div>

</div>


@script
    <script>
        Alpine.data('promotionCatalogProduct', () => {
            return {
                id: 0,
                name: '',
                size: '',
                price: '',
                new_price: '',
                qty: 1,
                attachment: '',
                selectedSizes: @js($selectedSizes),
                update(size, price, attachment, new_price) {
                    this.size = size;
                    this.price = price;
                    this.new_price = new_price;
                    this.attachment = attachment;
                },
                increment() {
                    this.qty++;
                },
                decrement() {
                    if (this.qty > 0) {
                        this.qty--;
                    }
                },
                addToCart() {
                    if (!this.size) {
                        alert('Пожалуйста, выберите размер');
                        return;
                    }

                    $wire.addToCart(this.id, this.name, this.qty, this.size, this.price, this.attachment, this.new_price)
                }
            }
        })
    </script>
@endscript
