<main>
    <livewire:single-header-product :product="$product" />

    <section class="w-11/12 lg:w-9/12 mx-auto py-4 lg:py-12">
        <p class="text-[12px]">{!! $product->description !!}</p>

        <div class="mt-12">
            <h2 class="text-[24px] font-bold">Характеристики:</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 mt-5">
                <div class="space-y-4">

                    <div class="flex flex-col">
                        <span class="font-bold text-[#C8B082] text-[16px]">Срок годности</span>
                        <span class="text-[16pxz">{{ $product->expiration_date }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-[#C8B082] text-[16px]">Условия хранения</span>
                        <span class="text-[16pxz">{{ $product->storage_conditions }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-[#C8B082] text-[16px]">Изготовлено по</span>
                        <span class="text-[16pxz">{{ $product->made_by }}</span>
                    </div>

                </div>
                <div class="col-span-1 lg:col-span-2 space-y-4">
                    <div class="flex flex-col">
                        <span class="font-bold text-[#C8B082] text-[16px]">Состав </span>
                        <span class="text-[16pxz">{{ $product->composition }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-[#C8B082] text-[16px]">Пищевая ценность </span>
                        <span class="text-[16pxz">{{ $product->food_value }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-[#C8B082] text-[16px]">Энергетическая ценность</span>
                        <span class="text-[16pxz">{{ $product->energy_value }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="py-12 border-t">
        <div class="w-9/12 mx-auto">
            <h2 class="text-xl lg:text-2xl font-bold">Спецпредложения:</h2>

            <div class="grid lg:grid-cols-2 mt-10 gap-5">

                <a href="{{ route('catalog') }}" class="w-full rounded-2xl group overflow-hidden">
                    <img src="{{ asset('assets/images/spec_1.svg') }}" alt=""
                        class="w-full transition duration-200 group-hover:hover:scale-105">
                </a>
                <a href="{{ route('catalog') }}" class="w-full rounded-2xl group overflow-hidden">
                    <img src="{{ asset('assets/images/spec_2.svg') }}" alt=""
                        class="w-full transition duration-200 group-hover:hover:scale-105">
                </a>
            </div>
        </div>
    </section> --}}

    <livewire:sections.offer-section color="black" single="true" />

    <livewire:sections.products-section position="SINGLE" />

    <livewire:sections.benefits-section />

    <livewire:components.footer />

</main>
