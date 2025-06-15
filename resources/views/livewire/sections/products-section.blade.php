<section class="py-24"
    data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "isAutoHeight": true,
    "slidesQty": {
        "xs": 1,
        "lg": 3
    }
}'>
    <div class="w-11/12 lg:w-9/12 mx-auto flex flex-wrap items-center justify-between">
        <div>
            <h2 class="font-bold text-xl lg:text-2xl">
                @if ($position == 'HOME')
                    Мы предлагаем икру <span class="text-[#C8B082]">Премиум</span>
                    класса
                @else
                    Смотрите другие предложения
                @endif
            </h2>
        </div>

        <div class="mt-5 lg:mt-0 relative block">
            <div class="flex items-center relative">
                <button
                    class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none mr-3 product-prev-button bg-[#C8B082] cursor-pointer transition duration-500 hover:scale-105 rounded-full flex items-center justify-center"
                    style="width: 40px; height: 40px">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 text-white">
                        <path fill-rule="evenodd"
                            d="M7.28 7.72a.75.75 0 0 1 0 1.06l-2.47 2.47H21a.75.75 0 0 1 0 1.5H4.81l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3.75-3.75a.75.75 0 0 1 0-1.06l3.75-3.75a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd" />
                    </svg>

                </button>
                <button
                    class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none product-next-button bg-[#C8B082] cursor-pointer transition duration-500 hover:scale-105 rounded-full flex items-center justify-center"
                    style="width: 40px; height: 40px">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 text-white">
                        <path fill-rule="evenodd"
                            d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>

                </button>
            </div>
        </div>
    </div>

    <div class="mt-10 w-11/12 mx-auto lg:mx-0 lg:ml-auto">
        <!-- Slider -->
        <div class="relative" style="margin-left: 5%">
            <div class="hs-carousel w-full overflow-hidden bg-white">
                <div class="relative">
                    <div class="hs-carousel-body flex flex-nowrap transition-transform duration-700 opacity-0">
                        @foreach ($products as $product)
                            <div class="hs-carousel-slide pr-5">
                                <livewire:parts.product-part :product='$product'>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
