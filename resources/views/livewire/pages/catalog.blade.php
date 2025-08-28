<main x-data="catalog" class="pt-[93px] lg:pt-0">
    <div class="bg-[#0B2443]">
        <livewire:sections.offer-section color="white" />
    </div>

    <section class="w-11/12 lg:w-9/12 mx-auto py-12">
        <div class="flex justify-center space-x-5">
            <button @click="active = 1" class="tab-link text-sm lg:text-[24px] font-bold"
                :class="active == 1 ? 'text-black' : 'text-[#9E9E9E]'">
                Черная икра
            </button>
            <button @click="active = 2" class="tab-link text-sm lg:text-[24px] font-bold"
                :class="active == 2 ? 'text-black' : 'text-[#9E9E9E]'">
                Красная икра
            </button>
            <button @click="active = 3" class="tab-link text-sm lg:text-[24px] font-bold"
                :class="active == 3 ? 'text-black' : 'text-[#9E9E9E]'">
                Подарочные наборы
            </button>
        </div>

        <div x-show="active == 1" class="grid grid-cols-2 lg:grid-cols-1 gap-2">
            @if(count($products_black) > 0)
                @foreach ($products_black as $product)
                    <livewire:parts.product-catalog :product="$product">
                @endforeach
            @else
                <div class="col-span-2 lg:col-span-1 flex justify-center items-center py-32 lg:py-40">
                    <div class="text-center">
                        <p class="text-lg lg:text-xl text-gray-600 font-medium">В данный момент данная продукция отсутствует</p>
                    </div>
                </div>
            @endif
        </div>
        <div x-show="active == 2" class="grid grid-cols-2 lg:grid-cols-1 gap-2">
            @if(count($products_red) > 0)
                @foreach ($products_red as $product)
                    <livewire:parts.product-catalog :product="$product">
                @endforeach
            @else
                <div class="col-span-2 lg:col-span-1 flex justify-center items-center h-96 py-32 lg:py-40">
                    <div class="text-center">
                        <p class="text-lg lg:text-xl text-gray-600 font-regular">В данный момент данная продукция отсутствует</p>
                    </div>
                </div>
            @endif
        </div>
        <div x-show="active == 3" class="grid grid-cols-2 lg:grid-cols-1 gap-2">
            @if(count($gifts) > 0)
                @foreach ($gifts as $gift)
                    {{-- @livewire('catalog-product', ['product' => $gift]) --}}
                    <livewire:parts.gift-catalog :gift="$gift">
                @endforeach
            @else
                <div class="col-span-2 lg:col-span-1 flex justify-center items-center h-96 py-32 lg:py-40">
                    <div class="text-center">
                        <p class="text-base lg:text-xl text-gray-800 font-regular">В данный момент данная продукция отсутствует</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <livewire:sections.advantages-section />

    <livewire:components.footer-short>
</main>


@script
    <script>
        Alpine.data('catalog', () => {
            return {
                active: 1,
                init() {
                    this.active = $wire.active
                }
            };
        });
    </script>
@endscript
