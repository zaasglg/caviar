<main class="pt-[93px] lg:pt-0">
    <livewire:sections.advantages-section />

    <section class="py-12 w-11/12 lg:w-9/12 mx-auto">
        <h1 class="text-4xl font-bold text-center"><span class="text-[#C7A771]">Наша </span> Икра</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 mt-20 gap-10">
            <div class="text-center transition duration-500 hover:bg-[#C7A771] py-10">
                <h6 class="text-[24px] font-bold">ОСЕТРОВАЯ  <br> ИКРА</h6>
                <p class="mt-5 w-3/4 mx-auto">Производится с соблюдением стандартов и проходит контроль качества на каждом этапе — от добычи до упаковки.</p>
            </div>

            <div class="text-center transition duration-500 hover:bg-[#C7A771] py-10">
                <h6 class="text-[24px] font-bold">ЛОСОСЕВАЯ <br> ИКРА</h6>
                <p class="mt-5 w-3/4 mx-auto">Добыча лососевой икры происходит в экологически чистых условиях и произведена с учетом высоких стандартов качества.</p>
            </div>

            <div class="text-center transition duration-500 hover:bg-[#C7A771] py-10">
                <h6 class="text-[24px] font-bold">ПОДАРОЧНЫЕ <br> НАБОРЫ </h6>
                <p class="mt-5 w-3/4 mx-auto">Мы уверены, что наша продукция станет достойным украшением вашего стола. "Русская Каспийская Икра" — это качество, проверенное временем.</p>
            </div>

        </div>
    </section>

    <section
        class="py-12 w-full lg:w-9/12 mt-24 mx-auto flex items-center justify-center text-center lg:h-[914px] bg-benefit-img bg-no-repeat bg-center bg-cover lg:bg-contain">
        <div class="w-full lg:w-4/6 mx-auto text-center space-y-10 p-10 lg:p-0">
            <h1 class="text-4xl font-bold">Икра которая Вас Покорит </h1>

            <p class="text-xs lg:text-lg px-10">
                Отличительная особенность нашей черной икры — традиционный вкус, так как икра получается методом забоя и не пастеризуется. Вся рыба проходит двухмесячную очистку на проточной воде для устранения посторонних запахов и улучшения качества икры. Продукция компании широко представлена во всех регионах Казахстана. Мы сотрудничаем с крупными национальными и локальными торговыми сетями. Нашими клиентами так же являются рестораны, гостиницы и предприятия общественного питания.
            </p>

            <a href="{{ route('catalog') }}"
                class="py-3 font-bold px-5 lg:px-10 border rounded-[8px] border-[#C7A771] inline-block transition duration-200 hover:bg-[#C7A771] hover:text-white">
                Перейти в каталог
            </a>
        </div>
    </section>

    <section class="w-11/12 lg:w-9/12 mx-auto py-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 items-center gap-10">
            <div class="lg:col-span-2">
                <img src="{{ asset('assets/images/about-img.svg') }}" alt="about img" class="w-full">
            </div>

            <div>
                <h1 class="text-4xl font-bold"><span class="text-[#C7A771]">Экологически </span> безопасная Икра</h1>
                <p class="mt-10 text-[16px]">
                    Мы работаем только с заводами, которые добывают лосось в районах промысла с международным сертификатом экологической безопасности MSC. MSC – Морской Попечительский совет – Международная некоммерческая организация, которая разработала стандарты экологически ответственного рыболовства и прослеживаемой цепей поставок. Знак MSC на продукции гарантирует, чтоб рыба и морепродукты поступают только от законных и экологически ответственных промыслов, которые заботятся о сохранении морских биоресурсов.
                </p>
            </div>
        </div>
    </section>

    <livewire:sections.partners-section />

    <livewire:components.footer />
</main>
