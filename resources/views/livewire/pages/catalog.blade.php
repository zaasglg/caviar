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
            @foreach ($products_black as $product)
                <livewire:parts.product-catalog :product="$product">
            @endforeach
        </div>
        <div x-show="active == 2" class="grid grid-cols-2 lg:grid-cols-1 gap-2">
            @foreach ($products_red as $product)
                <livewire:parts.product-catalog :product="$product">
            @endforeach
        </div>
        <div x-show="active == 3" class="grid grid-cols-2 lg:grid-cols-1 gap-2">
            @foreach ($gifts as $gift)
                {{-- @livewire('catalog-product', ['product' => $gift]) --}}
                <livewire:parts.gift-catalog :gift="$gift">
            @endforeach
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
