<footer class="py-12 border-t">
    <div class="w-11/12 lg:w-9/12 mx-auto">
        <div class="flex flex-wrap justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/images/logoo.svg') }}" alt="logo" class="w-[95px]">
                <span class="font-bold">
                    Русская <br>
                    Каспийская <br>
                    Икра</span>
            </div>

            <div class="mt-5 lg:space-x-3 space-y-1 lg:space-y-0 flex flex-col lg:flex-row [&_a]:text-md [&_a]:lg:text-sm">
                <a href="{{ route('about') }}" class="hover:underline">
                    О компании
                </a>
                <a href="{{ route('catalog') }}" class="hover:underline">
                    Каталог
                </a>
                <a href="{{ route('news') }}" class="hover:underline">
                    Интересное
                </a>
                <a href="{{ route('delivery') }}" class="hover:underline">
                    Доставка и оплата
                </a>
                <a href="{{ route('public.sec') }}" class="hover:underline">
                    Политика конфиденциальности
                </a>
                <a href="{{ route('public.offer') }}" class="hover:underline">
                    Публичная Оферта
                </a>
                <a href="{{ route('contact') }}" class="hover:underline">
                    Контакты
                </a>
            </div>
        </div>

        <div class="flex flex-wrap justify-between mt-12">
            <span>2016-2024 © Русская Каспийская Икра</span>

            <span>Разработка <a href="https://dnmc.kz" target="_blank" class="font-bold">Dynamica</a></span>
        </div>
    </div>

</footer>
