<main x-data="singleGift">

    <section class="w-9/12 mx-auto py-4 pt-[103px] lg:pt-0">
        <span class="text-[14px]">Главная / Магазин / Икра / {{ $gift->name }}</span>

        <div class="grid lg:grid-cols-2 lg:gap-20 mt-5 lg:mt-20">
            <div>
                <div class="main-image mb-4 relative">
                    <img x-ref="mainImage" :src="'/storage/' + attachment"
                        class="w-full lg:h-[450px] object-contain cursor-zoom-in transition-transform duration-300 ease-in-out hover:scale-105"
                        alt="Zoomable Image">

                    <div id="imageOverlay"
                        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden cursor-zoom-out">
                        <img x-ref="zoomImage" :src="'/storage/' + attachment"
                            class="max-w-full max-h-full transition-transform duration-300 ease-in-out"
                            alt="Zoomed Image">
                    </div>
                </div>

                <div class="flex space-x-2 mt-5 lg:mt-10">
                    <template x-for="(attachment, index) in attachments" :key="index">
                        <button type="button" @click="setHero(attachment)">
                            <img :src="'/storage/' + attachment"
                                class="p-2 w-14 h-14 border border-[#DDDDDD] cursor-pointer object-contain">
                        </button>
                    </template>

                </div>
            </div>

            <div class="space-y-5">
                <h2 class="block text-[20px] lg:text-4xl font-bold">{{ $gift->name }}</h2>
                <div>
                    <p
                        class="text-2xl font-bold text-left {{ $gift->new_price ? '!text-[#C7A771] !text-xl line-through' : '' }}">
                        {{ $gift->old_price }} KZT
                    </p>
                    @if ($gift->new_price)
                        <p class="text-2xl font-bold text-left">
                            {{ $gift->new_price }} KZT
                        </p>
                    @endif
                </div>

                <div class="flex items-center justify-start space-x-3 mt-5">

                </div>


                <div class="w-full lg:w-[200px] grid grid-cols-3 py-2 border border-[#B9B9B9] rounded-[3px]">
                    <button type="button" class="text-[#C8B082] font-bold" @click="decrement()">-</button>
                    <span class="font-bold text-center" x-text="qty + ' шт'"></span>
                    <button type="button" class="text-[#C8B082] font-bold" @click="increment()">+</button>
                </div>

                <div class="flex flex-wrap lg:flex-nowrap items-center lg:space-x-3 space-y-5 lg:space-y-0">
                    <button type="button"
                        @click="$wire.addToCart(qty, {{ $gift->old_price }}, {{ $gift->new_price ?? 0 }})"
                        class="border bg-[#C8B082] py-2.5 w-full lg:w-[14rem] rounded-[3px] text-white text-sm lg:text-[14px] h-[43px] font-bold text-center">
                        В корзину
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="w-9/12 mx-auto py-4 lg:py-12">
        <p class="text-[12px]">{!! $gift->description !!}</p>
    </section>

    {{-- <section class="py-12 border-t">
        <div class="w-9/12 mx-auto">
            <h2 class="text-2xl lg:text-4xl font-bold">Спецпредложения:</h2>


            <div class="grid lg:grid-cols-2 mt-10 gap-5">

                <div class="w-full">
                    <img src="{{ asset('assets/images/spec_1.svg') }}" alt="" class="w-full rounded-2xl">
                </div>

                <div class="w-full">
                    <img src="{{ asset('assets/images/spec_2.svg') }}" alt="" class="w-full rounded-2xl">
                </div>
            </div>
        </div>

    </section> --}}

    <livewire:sections.offer-section color="black" single="true" />

    <livewire:sections.products-section position="SINGLE" />

    <livewire:sections.benefits-section />

    <livewire:components.footer />

    {{-- @include('components.benefit')

    @include('layouts.footer') --}}

</main>


@script
    <script>
        Alpine.data('singleGift', () => {
            return {
                qty: 1,
                sizes: [],
                price: '',
                new_price: '',
                attachments: [],
                attachment: '',
                init() {
                    this.attachment = "{{ $gift->image }}";
                    this.attachments = {!! json_encode($gift->gallery) !!}
                },
                increment() {
                    this.qty++;
                },
                decrement() {
                    if (this.qty > 0) {
                        this.qty--;
                    }
                },
                setHero(attachment) {
                    this.attachment = attachment;
                    this.$refs.mainImage.src = '/storage/' + attachment;
                    this.$refs.zoomImage.src = '/storage/' + attachment;
                }
            };
        });
    </script>
@endscript
