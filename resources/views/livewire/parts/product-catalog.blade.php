<div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-10 items-center {{ $border ? 'border border-[#D5D5D5]' : '' }} p-3 lg:p-10 mt-10"
    x-data="catalogProduct">
    <a href="{{ route('catalog.single', ['id' => $product->id]) }}" class="flex justify-center">
        <img :src="'/storage/' + attachment" alt="">
    </a>

    <div class="lg:col-span-2">

        <span class="font-bold text-[#C8B082] block text-xs lg:text-base">{{ $product->category }}</span>

        <a href="{{ route('catalog.single', ['id' => $product->id]) }}"
            class="block text-sm lg:text-2xl font-bold lg:mt-3">{{ $product->name }}</a>
        @if ($product->sizes)
            <div class="flex items-center justify-start space-x-1 lg:space-x-3 mt-2 lg:mt-5">
                @foreach ($product->sizes as $item)

				@if($item['is_stock'])
                    <button 
                        type="button" 
                    
                        wire:key='{{ $item['name'] }}' 

                        x-init="
                            id = {{ $product->id }};
                            name = '{{ $product->name }}';
                            price = '{{ number_format($product->sizes[0]['old_price'], 0, ',', ' ') }}';
                            new_price = '{{ $product->sizes[0]['new_price'] ? number_format($product->sizes[0]['new_price'], 0, ',', ' ') : '' }}';
                            attachment = '{{ $product->image }}';
                        "

                        @click="
                            update(
                                '{{ $item['name'] }}',
                                '{{ number_format($item['old_price'], 0, ',', ' ') }}',
                                '{{ $item['attachments'][0] }}',
                                '{{ $item['new_price'] ? number_format($item['new_price'], 0, ',', ' ') : '' }}'
                            )
                        "

                        class="w-[35px] lg:w-[50px] h-[35px] lg:h-[50px] flex justify-center items-center rounded-full border border-[#E1C37A] text-[7px] lg:text-[12px] cursor-pointer"
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
            class="w-full lg:w-[200px] grid grid-cols-3 py-1 lg:py-2 border border-[#B9B9B9] rounded-[3px] mt-5 lg:mt-10">
            <button type="button" class="text-[#C8B082] font-bold" @click="decrement()">-</button>
            <span class="font-bold text-center text-xs lg:text-base leading-loose" x-text="qty + ' шт'"></span>
            <button type="button" class="text-[#C8B082] font-bold" @click="increment()">+</button>
        </div>

        <div class="flex flex-wrap lg:flex-nowrap items-center mt-5 lg:mt-10 lg:space-x-10 space-y-5 lg:space-y-0">
            <div>
                <p x-text="price + ' Тг'" class="text-sm lg:text-2xl font-bold text-left"
                    :class="new_price ? '!text-[#C7A771] text-xs lg:!text-xl line-through' : ''"></p>
                <p class="text-sm lg:text-2xl font-bold text-left" x-show='new_price' x-text="new_price + ' Тг'"></p>
            </div>

            <div class="flex flex-wrap lg:flex-nowrap items-center lg:space-x-3 space-y-5 lg:space-y-0">
                <button type="button" @click="addToCart()"
                    class="border border-[#C8B082] transition duration-500 hover:bg-[#C8B082] hover:text-white py-1.5 lg:py-2.5 lg:w-[14rem] px-5 lg:px-0 rounded-[3px] text-black text-xs lg:text-[14px] font-bold text-center">В
                    корзину</button>
            </div>
        </div>
    </div>

</div>


@script
    <script>
        Alpine.data('catalogProduct', () => {
            return {
                id: 0,
                name: '',
                size: '',
                price: '',
                new_price: '',
                qty: 1,
                attachment: '',
                update(size, price, attachment, new_price) {
                    this.size = size;
                    this.price = price;
                    this.new_price = new_price;
                    this.attachment = attachment;
                },
                increment() {
                    this.size = "{{ $product->sizes[0]['name'] }}"
                    this.qty++;
                },
                decrement() {
                    this.size = "{{ $product->sizes[0]['name'] }}"
                    if (this.qty > 0) {
                        this.qty--;
                    }
                },
                addToCart() {

                    $wire.addToCart(this.id, this.name, this.qty, this.size, this.price, this.attachment, this.new_price)

                }
            }
        })
    </script>
@endscript
