<footer class="bg-footer-m-img lg:bg-footer-img bg-cover bg center bg-no-repeat relative">
    <div class="w-11/12 lg:w-9/12 mx-auto py-12 lg:py-24 relative lg:static z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div>
                <img src="{{ asset('assets/images/footer-img.svg') }}" alt="footer-img"
                    class="absolute top-0 left-0 hidden lg:block">
            </div>
            <div>
                <h2 class="text-4xl text-white font-bold text-center leading-16">Русская <br> Каспийская Икра</h2>
                <p class="text-sm lg:text-md text-white text-center mt-5 w-full lg:w-4/5 mx-auto">
                    Купить Настоящую Черную икру в Алматы? Конечно же в интернет-магазине «Русской Каспийской Икры».
                    Если вы ищите качественную черную и красную икру в Казахстане, вы попали в правильное место. Русская
                    Каспийская Икра предлагает продукт наивысшего качества. У нас вы найдете икру по привлекательной
                    цене. Независимо от того, нужна ли вам икра для особого случая или для ежедневных удовольствий, у
                    нас есть идеальный вариант. Мы предлагаем конкурентоспособные цены, которые обеспечивают отличное
                    соотношение цены и качества. Также мы обеспечиваем доставку по всему Казахстану.
                </p>
                {{-- <h6 class="text-center text-white font-bold text-[20px]">Сертификаты</h6> --}}

                {{-- <div class="flex justify-center items-center mt-10 space-x-5">
                    <div>
                        <img src="{{ asset('assets/images/cer-1.svg') }}" alt="cer" class="h-[230px]">
                    </div>
                    <div>
                        <img src="{{ asset('assets/images/cer-2.svg') }}" alt="cer" class="h-[230px]">
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="mt-[12%]">
            <div class="flex flex-wrap justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/logoo.svg') }}" alt="logo" class="w-[95px]">
                    <span class="text-white font-bold leading-6">Русская <br>
                        Каспийская <br>
                        Икра</span>
                </div>

                <div
                    class="mt-5 lg:space-x-3 space-y-1 lg:space-y-0 flex flex-col lg:flex-row [&_a]:text-md [&_a]:lg:text-sm">
                    <a href="{{ route('about') }}" class="text-white hover:underline">
                        О компании
                    </a>
                    <a href="{{ route('catalog') }}" class="text-white hover:underline">
                        Каталог
                    </a>
                    <a href="{{ route('news') }}" class="text-white hover:underline">
                        Интересное
                    </a>
                    <a href="{{ route('delivery') }}" class="text-white hover:underline">
                        Доставка и оплата
                    </a>
                    <a href="{{ route('public.sec') }}" class="text-white hover:underline">
                        Политика конфиденциальности
                    </a>
                    <a href="{{ route('public.offer') }}" class="text-white hover:underline">
                        Публичная Оферта
                    </a>
                    <a href="{{ route('contact') }}" class="text-white hover:underline">
                        Контакты
                    </a>
                </div>
            </div>

            <div class="flex flex-wrap justify-between items-center mt-10 lg:mt-0">
                <p class="text-white lg:mt-5">2016-2024 © Русская Каспийская Икра</p>
                <span class="text-white">Разработка <a href="https://dnmc.kz" target="_blank"
                        class="font-bold">Dynamica</a></span>
            </div>
        </div>
    </div>

    <div class="block lg:hidden absolute top-0 left-0 bg-black bg-opacity-50 w-full h-full"></div>
</footer>
