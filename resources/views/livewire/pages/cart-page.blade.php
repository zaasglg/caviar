<main class="pt-[93px] lg:pt-0">

    {{-- cart info --}}
    <section class="w-11/12 lg:w-9/12 mx-auto py-12">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('assets/icons/cart.svg') }}" alt="cart"
                    class="w-[26,94px] lg:w-[46,94px] h-[29px] lg:h-[49px]">
                <h2 class="text-[12px] lg:text-[24px] font-bold">Корзина</h2>
            </div>

            <div
                class="flex font-bold text-[12px] lg:text-[24px] border border-[#979797] py-1 lg:py-2 px-2 lg:px-4 rounded lg:rounded-[10px]">
                {{ $totalCount }} шт.
            </div>
        </div>
    </section>
    {{-- end cart info --}}

    {{-- cart items --}}
    <section class="w-11/12 lg:w-9/12 mx-auto pb-12 space-y-5">

        @if (count($carts) == 0)
            <div class="w-full text-center">
                <span class="">Пусто</span>
            </div>
        @endif


        @foreach ($carts as $cart)
            <div
                class="grid grid-cols-2 lg:grid-cols-11 items-center gap-5 lg:gap-10 border border-[#DADADA] p-3 lg:p-5 rounded-[19px]">
                <div class="lg:col-span-2">
                    <img src="{{ asset('/storage/' . $cart['options']['hero']) }}" alt="hero">
                </div>

                <div class="lg:col-span-3">
                    <span class="font-bold text-[8px] lg:text-sm text-[#C8B082] block">Осетровая</span>
                    <a href="{{ route('catalog.single', ['id' => $cart['id']]) }}"
                        class="block text-sm lg:text-2xl font-bold">{{ $cart['name'] }}</a>
                    <span class="text-xs lg:text-lg font-thin block lg:mt-3">{{ $cart['weight'] }} г</span>
                </div>

                <div class="lg:col-span-3">
                    <div class="w-full py-1 lg:py-3 grid grid-cols-5 border border-[#B9B9B9] rounded-[10px] px-5">
                        <button type="button" class="text-[#C8B082] font-bold"
                            wire:click="decrement('{{ $cart['rowId'] }}', {{ $cart['qty'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>

                        </button>
                        <div class="col-span-3 flex justify-center">
                            <span class="font-bold text-center text-xs lg:text-base leading-loose">{{ $cart['qty'] }}
                                шт</span>
                        </div>
                        <button type="button" class="text-[#C8B082] font-bold"
                            wire:click="increment('{{ $cart['rowId'] }}', {{ $cart['qty'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>

                        </button>
                    </div>
                </div>

                <div class="lg:col-span-2 flex justify-start lg:justify-end">
                    <div>
                        <p @class([
                            'text-sm lg:text-2xl font-bold text-left',
                            '!text-[#C7A771] text-xs lg:!text-xl line-through' =>
                                $cart['options']['new_price'],
                        ])>
                            {{ $cart['options']['price'] }} Тг
                        </p>
                        @if ($cart['options']['new_price'])
                            <p class="text-sm lg:text-2xl font-bold text-left">
                                {{ $cart['options']['new_price'] }} Тг
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex justify-center col-span-2 lg:col-span-1">
                    <button type="button" wire:click='destroy("{{ $cart['rowId'] }}")'>
                        <img src="{{ asset('assets/images/x_mark.svg') }}" alt="">
                    </button>
                </div>

            </div>
        @endforeach

    </section>
    {{-- end cart items --}}

    @if (count($carts) > 0)
        <section class="w-11/12 lg:w-9/12 mx-auto pb-12">
            <div class="border border-[#DADADA] p-5 rounded-[19px] flex flex-wrap items-center justify-between">
                <div class="text-sm lg:text-xl">
                    <span>Итого:</span>
                    <b>{{ $totalCount }} шт.</b>
                    <b>{{ number_format(str_replace([',', '.00'], '', $total), 0, '.', ' ') }} Тг</b>
                </div>
                <div class="mt-10 lg:mt-0">
                    <div x-data="cartAddress">
                        <button type="button" wire:click="fetchCart"
                            class="text-[14px] bg-[#C8B082] transition hover:bg-[#755D2D] px-10 py-3 rounded text-white">
                            Перейти к оплате
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-11/12 lg:w-9/12 mx-auto pb-12">
            <div class="border border-[#DADADA] p-5 rounded-[19px] space-y-2">
                <div class="flex items-center space-x-2">
                    <input type="radio" name="type" id="nal" value="Наличными" wire:model='type'>
                    <label for="nal">Оплата наличными</label>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="radio" name="type" id="visa" value="Visa" wire:model='type'>
                    <label for="visa">Оплата Visa / Master card</label>
                </div>

                @error('type')
                    <span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>
                @enderror
            </div>
        </section>

        <section class="w-11/12 lg:w-9/12 mx-auto pb-12">
            <div class="border border-[#DADADA] p-5 rounded-[19px]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div>
                        <h2 class="text-2xl font-bold">Доставка</h2>

                        <div class="mt-10">
                            <input type="text" name="name" wire:model='name'
                                class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                                placeholder="Ваше имя">

                            @error('name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <input type="email" name="email" wire:model='email'
                                class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                                placeholder="E-mail адрес">

                            @error('email')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <input type="text" name="phone_number" wire:model='phone_number'
                                class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                                placeholder="Номер телефона">

                            @error('phone_number')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- <livewire:cart-address address="{{ $address }}" :errors="$errors->get('address')"  /> --}}

                    {{-- Cart Address --}}
                    <div x-data="cartAddress">
                        <div class="flex justify-around">
                            <button @click="active=0" class="tab-link text-sm font-bold"
                                :class="active == 0 ? 'text-black' : 'text-[#9E9E9E]'">Выбрать свои адрес</button>
                            @auth
                                <button @click="active=1" class="tab-link text-sm font-bold"
                                    :class="active == 1 ? 'text-black' : 'text-[#9E9E9E]'">Добавить новый</button>
                            @endauth
                        </div>

                        <div class="mt-10" x-show="active==0">
                            @auth
                                @if (auth()->user()->addresses)
                                    @foreach ($user_addresses as $address)
                                        <div class="cursor-pointer w-full mb-3 flex justify-between items-center border border-[#D8D8D8] px-5 py-3 rounded-[8px]"
                                            @click="setAddress({{ $address->id }})">
                                            <div class="flex flex-col">
                                                <span class="font-bold text-[#C7A771]">{{ $address->city['name'] }}</span>
                                                <span>{{ $address->address }}</span>
                                            </div>
                                            <div>
                                                <img src="{{ asset('assets/images/checked_address.svg') }}"
                                                    alt="" x-show="address == {{ $address->id }}">
                                                <img src="{{ asset('assets/images/unckecked_address.svg') }}"
                                                    alt="" x-show="address != {{ $address->id }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    @error('address_id')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                @else
                                    <div class="flex justify-center h-full items-center">
                                        <span class="text-center text-sm">Пусто</span>
                                    </div>
                                @endif
                            @else
                                <div>
                                    <select wire:model='city'
                                        class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
                                        <option selected>--------------</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('city')
                                        <span class="text-xs text-red-500 font-thin">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <input type="text" name="address" id="address" wire:model="address"
                                        class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                                        placeholder="Адрес">

                                    @error('address')
                                        <span class="text-xs text-red-500 font-thin">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endauth
                        </div>
                        <div class="mt-10" x-show="active==1">
                            @auth

                                <livewire:parts.cart-add-address />

                                {{-- <div>
                                    <select wire:model.live="city"
                                        class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
                                        <option value="#">--------------</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('city')
                                    <span class="text-xs text-red-500 font-thin">это поле является обязательным</span>
                                @enderror

                                <div class="mt-3">
                                    <input type="text" wire:model.live="address_name"
                                        class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                                        placeholder="Адрес">
                                </div>

                                @error('name')
                                    <span class="text-xs text-red-500 font-thin">это поле является обязательным</span>
                                @enderror

                                <div class="flex items-center space-x-5 mt-5">
                                    <button type="button" wire:click="saveAddress()"
                                        class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-black text-sm lg:text-[14px] font-bold text-center">Создать</button>
                                </div> --}}


                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="w-11/12 lg:w-9/12 mx-auto pb-12">
            <div class="border border-[#DADADA] p-5 rounded-[19px]">
                <h2 class="text-2xl font-bold">Комментарий к заказу</h2>

                <div class="mt-5">
                    <textarea name="comment" wire:model='comment'
                        class=" g-[#ECECEC] p-5 rounded-[20px] border border-gray-200 w-full text-xs placeholder:text-xs focus:border-none"
                        rows="10" placeholder="Напишите ваш пожелания или комментарий к заказу"></textarea>
                </div>
            </div>
        </section>
    @endif


    {{-- </form> --}}


    <livewire:components.footer-short />
</main>


@script
    <script>
        Alpine.data('cartAddress', () => {
            return {
                active: 0,
                address: 0,
                setAddress(addressID) {
                    this.address = addressID;
                    $wire.$set('address_id', addressID, true);
                },
                async fetchCart() {
                    try {
                        const amount = '350.00';
                        const currency = '398';
                        const orderId = '3558714461568';
                        const merchant = 'merchantname';
                        const terminal = '90033910';
                        const merchGmt = '6';
                        const trtype = '1';
                        const timestamp = new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0, 14);
                        const nonce = this.generateRandomHex(32); // генерируем новое NONCE
                        const merchRnId = "AG8POST900339103";

                        // Формируем строку для макирования по правилам
                        const fields = [
                            amount,
                            currency,
                            orderId,
                            merchant,
                            terminal,
                            merchGmt,
                            timestamp,
                            trtype,
                            nonce
                        ];

                        let macDataString = '';
                        for (const field of fields) {
                            macDataString += field.length + field;
                        }

                        const secretKeyHex = '699edf9c7c02d5776e84e46d59b74257'; 
                        const pSign = await this.generateHMACSHA1(secretKeyHex, macDataString);

                        const data = {
                            AMOUNT: amount,
                            CURRENCY: currency,
                            ORDER: orderId,
                            MERCHANT: merchant,
                            TERMINAL: terminal,
                            MERCH_GMT: merchGmt,
                            TIMESTAMP: timestamp,
                            TRTYPE: trtype,
                            NONCE: nonce,
                            MERCH_RN_ID: merchRnId,
                            DESC: 'TRTYPE=1 transaction (Frictionless Flow)',
                            MERCH_NAME: 'TOO "CAVIAR"',
                            BACKREF: 'https://xor.pw/#',
                            LANG: 'ru',
                            P_SIGN: pSign,
                            MK_TOKEN: 'MERCH',
                            NOTIFY_URL: 'https://3dsecure.bcc.kz:5443/cgi-bin/cgi_link',
                            CLIENT_IP: '0.0.0.0',
                            M_INFO: btoa(
                                JSON.stringify({
                                    browserScreenHeight: '1920',
                                    browserScreenWidth: '1080',
                                    mobilePhone: {
                                        cc: '7',
                                        subscriber: '7475558888',
                                    },
                                })
                            ),
                        };

                        const proxy = 'https://cors-anywhere.herokuapp.com/';
                        const url = proxy + 'https://3dsecure.bcc.kz:5443/cgi-bin/cgi_link';

                        const response = await axios.post(url,
                            new URLSearchParams(data).toString(), {
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                    'Access-Control-Allow-Origin': '*',
                                },
                            }
                        );

                        console.log('Response:', response.data);
                    } catch (error) {
                        console.error('Error fetching cart:', error);
                    }
                },
                generateRandomHex(length) {
                    const bytes = new Uint8Array(length / 2);
                    crypto.getRandomValues(bytes);
                    return Array.from(bytes)
                        .map((b) => b.toString(16).padStart(2, '0'))
                        .join('')
                        .toUpperCase();
                },
                async generateHMACSHA1(secretKeyHex, message) {
                    const encoder = new TextEncoder();

                    // Преобразование HEX ключа в бинарный массив
                    const keyBytes = new Uint8Array(secretKeyHex.match(/.{1,2}/g).map(byte => parseInt(byte,
                        16)));

                    const cryptoKey = await crypto.subtle.importKey(
                        'raw',
                        keyBytes, {
                            name: 'HMAC',
                            hash: 'SHA-1'
                        },
                        false,
                        ['sign']
                    );

                    const signature = await crypto.subtle.sign(
                        'HMAC',
                        cryptoKey,
                        encoder.encode(message)
                    );

                    return Array.from(new Uint8Array(signature))
                        .map(b => b.toString(16).padStart(2, '0'))
                        .join('')
                        .toUpperCase();
                }

            };
        });
    </script>
@endscript
