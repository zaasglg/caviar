<div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-10 items-center border border-[#D5D5D5] p-3 lg:p-10 mt-10"
    x-data="catalogGift">
    <a href="{{ route('gift.single', ['id' => $gift->id]) }}" class="flex justify-center">
        <img src="/storage/{{ $gift->image }}" alt="">
    </a>

    <div class="lg:col-span-2">
        <a href="{{ route('gift.single', ['id' => $gift->id]) }}"
            class="block text-sm lg:text-2xl font-bold">{{ $gift->name }}</a>


        <div class="w-full lg:w-[200px] grid grid-cols-3 py-1 lg:py-2 border border-[#B9B9B9] rounded-[3px] mt-10">
            <button type="button" class="text-[#C8B082] font-bold" @click="decrement()">-</button>
            <span class="font-bold text-center text-xs lg:text-base leading-loose" x-text="qty + ' шт'"></span>
            <button type="button" class="text-[#C8B082] font-bold" @click="increment()">+</button>
        </div>

        <div class="flex flex-wrap lg:flex-nowrap items-center mt-10 lg:space-x-10 space-y-5 lg:space-y-0">
            <div>
                <p
                    class="font-bold text-left {{ $gift->new_price ? 'text-[#C7A771] text-xs lg:text-xl line-through' : 'text-sm lg:text-2xl' }}">
                    {{ number_format($gift->old_price, 0, '.', ' ') }} Тг</p>
                @if ($gift->new_price)
                    <p class="text-sm lg:text-2xl font-bold text-left">{{ number_format($gift->new_price, 0, '.', ' ') }} Тг</p>
                @endif
            </div>

            <div class="flex flex-wrap lg:flex-nowrap items-center lg:space-x-3 space-y-5 lg:space-y-0">

                <button type="button"
                    @click="$wire.addToCart(qty, {{ $gift->old_price }}, {{ $gift->new_price ?? 0 }})"
                    class="border border-[#C8B082] transition duration-500 hover:bg-[#C8B082] hover:text-white py-1.5 lg:py-2.5 lg:w-[14rem] px-5 lg:px-0 rounded-[3px] text-black text-xs lg:text-[14px] font-bold text-center">В
                    корзину</button>
            </div>
        </div>
    </div>

</div>


@script
    <script>
        Alpine.data('catalogGift', () => {
            return {
                qty: 1,
                increment() {
                    this.qty++;
                },
                decrement() {
                    if (this.qty > 0) {
                        this.qty--;
                    }
                },
            }
        })
    </script>
@endscript
