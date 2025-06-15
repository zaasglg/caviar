<div x-data="product"
    class="p-2 lg:p-10 border border-[#979797] h-full transition duration-200 hover:scale-[0.99]">
    <a href="{{ route('catalog.single', ['id' => $product->id]) }}" class="flex justify-center">
        <img :src="'/storage/' + attachment" alt="product" class="h-[150px] lg:h-[240px] object-contain">
    </a>

    <div class="flex flex-col items-center my-2 lg:my-10">
        <span class="font-bold text-[#C8B082] text-[14px]">{{ $product->category }}</span>
        <a href="{{ route('catalog.single', ['id' => $product->id]) }}"
            class="text-base lg:text-[24px] font-bold text-center">{{ $product->name }}</a>
    </div>

    <div class="flex items-center justify-center space-x-1 lg:space-x-3 mt-5">
        @foreach ($product->sizes as $item)
            @if ($item['is_stock'])
                <button type="button" wire:key="{{ $item['name'] }}" x-init="price = '{{ number_format($product->sizes[0]['old_price'], 0, ',', ' ') }}';
                new_price = '{{ $product->sizes[0]['new_price'] ? number_format($product->sizes[0]['new_price'], 0, ',', ' ') : '' }}';
                attachment = '{{ $product->image }}';"
                    @click="
                    update(
                        '{{ $item['name'] }}',
                        '{{ number_format($item['old_price'], 0, ',', ' ') }}',
                        '{{ $item['attachments'][0] ?? $product->image }}',
                        '{{ $item['new_price'] ? number_format($item['new_price'], 0, ',', ' ') : '' }}'
                    )
                "
                    class="w-[35px] lg:w-[50px] h-[35px] lg:h-[50px] flex justify-center items-center rounded-full border border-[#C8B082] text-[7px] lg:text-[12px] cursor-pointer transition duration-200 hover:bg-[#C8B082] hover:bg-opacity-30">
                    <span class="font-bold w-full h-full flex justify-center items-center rounded-full"
                        :class="size == '{{ $item['name'] }}' ? 'bg-[#C8B082] text-white' : ''">
                        {{ $item['name'] }} г
                    </span>
                </button>
            @endif
        @endforeach
    </div>




    <div class="flex flex-col items-center mt-5 space-y-3">
        <div class="h-[60px] flex flex-col justify-center items-center">
            <p x-text="price + ' Тг'" class="text-sm font-bold text-left"
                :class="new_price ? '!text-[#C7A771] text-xs lg:text-base line-through' : 'lg:text-xl'"></p>
            <p class="text-sm lg:text-xl font-bold text-left" x-show='new_price' x-text="new_price + ' Тг'"></p>
        </div>

        <button type="button" @click="$wire.addToCart(size, price, attachment, new_price)"
            class="bg-[#C8B082] w-9/12 mx-auto py-2 lg:py-3 rounded lg:rounded-md text-white text-xs border lg:text-base text-center transition duration-200 hover:bg-white border-[#C8B082] hover:text-[#C8B082]"
            wire:loading.attr="disabled">
            В корзину
        </button>
    </div>
</div>


@script
    <script>
        Alpine.data('product', () => {
            return {
                size: 0,
                price: '',
                new_price: '',
                attachment: '',

                update(size, price, attachment, new_price) {
                    this.size = size;
                    this.price = price;
                    this.new_price = new_price;
                    this.attachment = attachment;
                },
            }
        })
    </script>
@endscript
