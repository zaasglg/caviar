<main>
    <!-- MARK: CAROUSEL -->
    <livewire:sections.carousel-section />

    <livewire:sections.offer-section color="black" />

    <!-- MARK: CATALOGS -->
    <section class="w-11/12 lg:w-9/12 mx-auto py-2 lg:py-12 grid grid-cols-2 gap-2 lg:gap-10 my-10">

        <a href="{{ route('catalog', ['id' => 1]) }}"
            class="flex flex-col items-center justify-between py-3 lg:py-8 border border-white hover:border-[#C8B082] transition">
            <h2 class="font-semibold text-center text-base lg:text-2xl">Черная икра</h2>

            <div class="my-5">
                <img src="{{ asset('assets/images/black.png') }}" alt="black" class="w-[100px] lg:w-[300px]">
            </div>

            <span
                class="text-xs lg:text-[14px] bg-[#C8B082] font-medium transition hover:bg-[#755D2D] px-3 lg:px-10 py-2 lg:py-3 rounded text-white">
                Смотреть каталог
            </span>
        </a>

        <a href="{{ route('catalog', ['id' => 2]) }}"
            class="flex flex-col items-center justify-between py-3 lg:py-8 border border-white hover:border-[#C8B082] transition">
            <h2 class="font-semibold text-center text-base lg:text-2xl">Красная икра</h2>

            <div class="my-5">
                <img src="{{ asset('assets/images/red.png') }}" alt="red" class="w-[100px] lg:w-[300px]">
            </div>

            <span
                class="text-xs lg:text-[14px] bg-[#C8B082] font-medium transition hover:bg-[#755D2D] px-3 lg:px-10 py-2 lg:py-3 rounded text-white">
                Смотреть каталог
            </span>
        </a>

    </section>

    <!-- MARK: Benefits -->
    <livewire:sections.benefits-section />

    <!-- MARK: SLIDER PRODUCTS -->
    <livewire:sections.products-section position="HOME" />

    <!-- MARK: NEWS PART -->
    <livewire:sections.posts-section titlePage="Новости, статьи и интересные факты" />

    <!-- MARK: Partners -->
    <livewire:sections.partners-section />

    <!-- MARK: Footer -->
    <livewire:components.footer />
</main>
