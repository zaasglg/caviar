<nav x-data="{ menuOpen: false, catalogOpen: false }" class="fixed lg:relative w-full bg-[#082140] py-2" style="z-index: 999">
    <div class="w-11/12 lg:w-9/12 mx-auto flex justify-between items-center">
        {{-- Logo and Brand Name --}}
        <div class="flex space-x-3 lg:space-x-5 items-center relative">
            <a href="{{ route('home') }}" class="lg:absolute lg:mt-10">
                <img src="{{ asset('assets/images/logo-header.svg') }}" alt="logo" class="w-[80px] lg:w-[147px]">
            </a>
            <span class="text-white text-sm lg:text-[20px] block lg:!ml-[180px]">
                Русская <br>
                <b class="text-[#C8B082]">Каспийская</b> Икра
            </span>
        </div>

        <div>
            {{-- Desktop Navigation --}}
            <ul class="hidden lg:flex items-center space-x-3 text-white text-[14px]">
                <li>
                    <a href="{{ route('about') }}">О компании</a>
                </li>
                <li class="relative group">
                    <a href="{{ route('catalog') }}" class="flex items-center space-x-2">
                        <span>Каталог</span>
                        <img src="{{ asset('assets/icons/dropdown.svg') }}" alt="dropdown icon">
                    </a>
                    <div class="absolute hidden group-hover:block bg-[#0B2443] divide-y divide-gray-100 rounded-lg shadow w-56">
                        <ul class="py-2 text-sm text-gray-700">
                            @php
                                $catalogItems = [
                                    ['id' => 1, 'name' => 'Черная икра'],
                                    ['id' => 2, 'name' => 'Красная икра'],
                                    ['id' => 3, 'name' => 'Подарочные наборы'],
                                ];
                            @endphp
                            
                            @foreach($catalogItems as $item)
                                <li>
                                    <a href="{{ route('catalog', ['id' => $item['id']]) }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-[#08192D] text-white text-sm">{{ $item['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ route('news') }}">Интересное</a>
                </li>
                <li>
                    <a href="{{ route('delivery') }}">Доставка и оплата</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Контакты</a>
                </li>
                <li class="transition duration-200 hover:scale-105" style="margin-left: 30px">
                    <a href="https://wa.me/+77001013494">
                        <img src="{{ asset('assets/icons/whatsapp.svg') }}" alt="whatsapp" class="w-9">
                    </a>
                </li>
                <li class="transition duration-200 hover:scale-105">
                    <a href="https://www.instagram.com/caviar.com.kz?igsh=NDF6MGI5dHR6OHpw">
                        <img src="{{ asset('assets/icons/instagram.svg') }}" alt="instagram" class="w-9">
                    </a>
                </li>
            </ul>

            {{-- Desktop Contact and User Info --}}
            <div class="hidden lg:flex justify-end mt-3">
                <a href="tel:+77001013494" class="flex items-center space-x-2 mr-5">
                    <img src="{{ asset('assets/icons/call.svg') }}" alt="call icon" class="w-4">
                    <span class="text-white text-[14px] font-medium">+ 7 700 <span class="text-[#C7A771]">101 34 94</span></span>
                </a>

                @auth
                    <a href="{{ route('profile') }}" class="flex items-center space-x-3 mr-2 group">
                        <svg viewBox="0 0 11 16" version="1.1" class="w-3 transition duration-200 text-[#C8B082] group-hover:text-white">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Главная-страница" transform="translate(-858, -69)" stroke="currentColor">
                                    <g id="Group-12" transform="translate(863.5, 77.125) scale(-1, 1) translate(-863.5, -77.125)translate(859, 70)">
                                        <circle id="Oval" cx="4.5" cy="3" r="3"></circle>
                                        <path d="M0,14.25 L9,14.25 L9,12 C9,9.51471863 6.98528137,7.5 4.5,7.5 C2.01471863,7.5 -8.8817842e-16,9.51471863 0,12 L0,14.25 L0,14.25 Z" id="Path-13"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="text-white text-sm">Профиль</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center space-x-3 mr-2 group">
                        <svg viewBox="0 0 11 16" version="1.1" class="w-3 transition duration-200 text-[#C8B082] group-hover:text-white">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Главная-страница" transform="translate(-858, -69)" stroke="currentColor">
                                    <g id="Group-12" transform="translate(863.5, 77.125) scale(-1, 1) translate(-863.5, -77.125)translate(859, 70)">
                                        <circle id="Oval" cx="4.5" cy="3" r="3"></circle>
                                        <path d="M0,14.25 L9,14.25 L9,12 C9,9.51471863 6.98528137,7.5 4.5,7.5 C2.01471863,7.5 -8.8817842e-16,9.51471863 0,12 L0,14.25 L0,14.25 Z" id="Path-13"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="text-white text-sm">Войти/Регистрация</span>
                    </a>
                @endauth

                <a href="{{ route('cart') }}" class="bg-[#0C2D55] flex items-center space-x-3 h-[39px] px-3 rounded-[6px] group transition duration-200 hover:bg-[#C8B082]">
                    <svg viewBox="0 0 14 15" version="1.1" class="w-4 text-[#C8B082] group-hover:text-white">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Главная-страница" transform="translate(-962, -70)" fill="currentColor">
                                <g id="Group-4" transform="translate(962, 70)">
                                    <path d="M2.94218556,1.99840144e-15 C3.19835021,1.94289029e-15 3.4060127,0.207662484 3.4060127,0.46382714 C3.4060127,0.719991795 3.19835021,0.927654279 2.94218556,0.927654279 L2.57357524,0.927654279 L2.57357524,1.80555492 L12.9346204,1.80555492 C13.0074294,1.80555492 13.0800207,1.81350658 13.1511032,1.82926847 C13.6902913,1.94882858 14.030467,2.48284954 13.9109069,3.02203765 L12.7489808,8.26205207 L2.57357524,9.19686635 L2.58040261,9.30678342 C2.63447407,9.73885045 3.00312017,10.0731333 3.44984221,10.0731333 L13.6312694,10.0731333 L13.6312694,11 L3.74088302,11 C2.63631352,11 1.74088302,10.1045695 1.74088302,9 L1.74088302,0.927654279 L0.46382714,0.927654279 C0.207662484,0.927654279 1.83186799e-15,0.719991795 1.77635684e-15,0.46382714 C1.72084569e-15,0.207662484 0.207662484,1.88737914e-15 0.46382714,1.83186799e-15 Z M13.1538196,2.75326197 L2.61039035,2.75326197 L2.61039035,8.22434513 L12.0232945,7.43572252 L13.1538196,2.75326197 Z" id="Combined-Shape"></path>
                                    <path d="M5,11 C6.1045695,11 7,11.8954305 7,13 C7,14.1045695 6.1045695,15 5,15 C3.8954305,15 3,14.1045695 3,13 C3,11.8954305 3.8954305,11 5,11 Z M4.98765432,12.037037 C4.44900623,12.037037 4.01234568,12.4736976 4.01234568,13.0123457 C4.01234568,13.5509938 4.44900623,13.9876543 4.98765432,13.9876543 C5.52630241,13.9876543 5.96296296,13.5509938 5.96296296,13.0123457 C5.96296296,12.4736976 5.52630241,12.037037 4.98765432,12.037037 Z" id="Combined-Shape"></path>
                                    <path d="M10,11 C11.1045695,11 12,11.8954305 12,13 C12,14.1045695 11.1045695,15 10,15 C8.8954305,15 8,14.1045695 8,13 C8,11.8954305 8.8954305,11 10,11 Z M9.98765432,12.037037 C9.44900623,12.037037 9.01234568,12.4736976 9.01234568,13.0123457 C9.01234568,13.5509938 9.44900623,13.9876543 9.98765432,13.9876543 C10.5263024,13.9876543 10.962963,13.5509938 10.962963,13.0123457 C10.962963,12.4736976 10.5263024,12.037037 9.98765432,12.037037 Z" id="Combined-Shape-Copy"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span class="text-white text-sm">Корзина</span>
                    <b class="text-[#C8B082] text-sm group-hover:text-white">{{ Gloudemans\Shoppingcart\Facades\Cart::count() }} шт.</b>
                </a>
            </div>

            {{-- Mobile Controls --}}
            <div class="flex items-center justify-center space-x-4 lg:hidden">
                <a href="tel:+77001013494" class="relative flex items-center justify-center w-9 h-9 rounded-full border border-[#C8B082]">
                    <img src="{{ asset('assets/icons/call.svg') }}" alt="call">
                </a>

                <a href="{{ route('cart') }}" class="relative flex items-center justify-center w-9 h-9 rounded-full border border-[#C8B082]">
                    <img src="{{ asset('assets/icons/cart.svg') }}" alt="cart">
                    <span class="absolute -bottom-1 -right-3 font-bold w-5 h-5 bg-[#C8B082] rounded-full text-xs flex justify-center items-center">{{ $cartCount }}</span>
                </a>

                <button @click="menuOpen = true" class="cursor-pointer ml-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#C8B082" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="menu fixed bg-[#0B2443] w-full h-screen top-0 bottom-0 left-0 hidden lg:hidden z-50" :class="{ 'hidden': !menuOpen, 'block': menuOpen }">
            <button @click="menuOpen = false" class="flex justify-end items-center w-full pt-5 pr-5 space-x-2">
                <span class="text-white leading-0">Закрыть</span>
                <img src="{{ asset('assets/images/close.svg') }}" alt="close icon" class="w-5">
            </button>
            <div class="p-10">
                <ul class="flex flex-col items-center space-y-5 text-white font-semibold">
                    <li>
                        <a href="{{ route('about') }}">О компании</a>
                    </li>
                    <li class="relative w-full text-center">
                        <button @click="catalogOpen = !catalogOpen" class="flex items-center justify-center space-x-2 mx-auto">
                            <span>Каталог</span>
                            <img src="{{ asset('assets/icons/dropdown.svg') }}" alt="dropdown icon" :class="{'rotate-180': catalogOpen}">
                        </button>

                        <ul x-show="catalogOpen" x-transition class="mt-2 w-full bg-[#082140] text-white rounded-lg shadow-lg py-2">
                            @php
                                $catalogItems = [
                                    ['id' => 1, 'name' => 'Черная икра'],
                                    ['id' => 2, 'name' => 'Красная икра'],
                                    ['id' => 3, 'name' => 'Подарочные наборы'],
                                ];
                            @endphp
                            
                            @foreach($catalogItems as $item)
                                <li>
                                    <a href="{{ route('catalog', ['id' => $item['id']]) }}" 
                                       class="block px-4 py-2 hover:bg-[#08192D] text-white text-sm text-center">
                                       {{ $item['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('news') }}">Интересное</a>
                    </li>
                    <li>
                        <a href="{{ route('delivery') }}">Доставка и оплата</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">Контакты</a>
                    </li>
                </ul>

                <div class="flex justify-center space-x-5 mt-10">
                    <a href="https://wa.me/+77001013494">
                        <img src="{{ asset('assets/icons/whatsapp.svg') }}" alt="whatsapp" class="w-9">
                    </a>
                    <a href="https://www.instagram.com/caviar.com.kz?igsh=NDF6MGI5dHR6OHpw/">
                        <img src="{{ asset('assets/icons/instagram.svg') }}" alt="instagram" class="w-9">
                    </a>
                </div>

                <div class="flex flex-col space-y-5 justify-end mt-10">
                    <a href="tel:+77001013494" class="bg-[#052965] flex space-x-3 py-4 px-5 w-full rounded-[6px]">
                        <img src="{{ asset('assets/icons/call.svg') }}" alt="call icon">
                        <span class="text-white text-sm">+7 700 101 34 94</span>
                    </a>

                    @auth
                        <a href="{{ route('profile') }}" class="border border-[#C8B082] flex space-x-3 py-4 px-5 w-full rounded-[6px]">
                            <img src="{{ asset('assets/icons/profile.svg') }}" alt="profile">
                            <span class="text-white text-sm">Профиль</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="border border-[#C8B082] flex space-x-3 py-4 px-5 w-full rounded-[6px]">
                            <img src="{{ asset('assets/icons/profile.svg') }}" alt="profile">
                            <span class="text-white text-sm">Войти/регистрация</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>


@script
    <script>
        Alpine.data('mobile-menu', () => {
            return {
                menu: false,
                open() {
                    menu = !menu
                },
            }
        })
    </script>
@endscript
