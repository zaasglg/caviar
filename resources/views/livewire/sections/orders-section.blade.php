<section class="w-11/12 lg:w-9/12 mx-auto py-12">
    <h2 class="text-2xl font-bold text-center">История заказов</h2>

    <div class="mt-10">
        @if (auth()->user()->orders)
            <div class="space-y-4">
                @foreach (auth()->user()->orders->reverse() as $order)
                    <div class="p-5 border rounded-lg">
                        <div class="grid grid-cols-3 lg:grid-cols-5">
                            <h2 class="font-bold lg:col-span-3">Заказ № 00{{ $order->id }}</h2>
                            <span class="font-bold text-center">{{ count($order->products) }} шт.</span>
                            <span class="font-bold text-center">{{ $order->total_price }} Тг.</span>
                        </div>

                        <div class="">
                            @foreach ($order->products as $product)
                                <div
                                    class="grid grid-cols-1 lg:grid-cols-12 items-center border rounded-md px-5 py-3 my-5 gap-y-5 lg:gap-y-0">
                                    <div class="lg:col-span-1 flex justify-start w-full">
                                        <img class="w-full lg:w-[62px] h-[140px] lg:h-full object-contain"
                                            src="{{ asset('/storage/' . $product['options']['hero']) }}" alt="">
                                    </div>
                                    <div class="lg:col-span-3 flex justify-center">
                                        <span class="text-base font-bold">{{ $product['name'] }}</span>
                                    </div>
                                    <div
                                        class="lg:col-span-4 flex items-center justify-center lg:justify-start space-x-3 lg:space-x-0">
                                        <span class="text-base font-normal lg:font-bold">{{ $product['weight'] }}
                                            г.</span>
                                        <span class="block lg:hidden"> | </span>
                                        <span class="text-base block lg:hidden">{{ $product['qty'] }} шт.</span>
                                    </div>
                                    <div class="lg:col-span-2 flex justify-center">
                                        <span class="text-base font-bold">{{ $product['price'] }} Тг.</span>
                                    </div>
                                    <div class="lg:col-span-2 hidden lg:flex justify-center">
                                        <span class="text-base font-bold">{{ $product['qty'] }} шт.</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="grid grid-cols-2 lg:grid-cols-5 mt-5 gap-5 lg:gap-0">
                            <div>
                                <p class="font-semibold text-sm">Ваше имя</p>
                                <p class="text-sm mt-2">{{ auth()->user()->name }}</p>
                            </div>

                            <div>
                                <p class="font-semibold text-sm">Номер телефона</p>
                                <p class="text-sm mt-2">{{ auth()->user()->phone_number }}</p>
                            </div>

                            <div>
                                <p class="font-semibold text-sm">Горд</p>
                                <p class="text-sm mt-2">г. {{ auth()->user()->addresses[0]['city']['name'] }}</p>
                            </div>

                            <div class="lg:col-span-2">
                                <p class="font-semibold text-sm">Адрес</p>
                                <p class="text-sm mt-2">{{ auth()->user()->addresses[0]['address'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <span class="text-center block text-sm">Пусто</span>
        @endif
    </div>
</section>
