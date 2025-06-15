<section class="w-11/12 lg:w-9/12 mx-auto py-4 pt-[103px] lg:pt-0" x-data="singleProduct">
    <span class="text-[14px]">Главная / Магазин / Икра / {{ $product->name }}</span>

    <div class="grid lg:grid-cols-2 lg:gap-20 mt-5 lg:mt-20">
        <div>
            <div class="main-image mb-4 relative">
                <img x-ref="mainImage" :src="'/storage/' + attachment"
                    class="w-full lg:h-[450px] object-contain cursor-zoom-in transition-transform duration-300 ease-in-out hover:scale-105"
                    alt="Zoomable Image">

                <div id="imageOverlay"
                    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden cursor-zoom-out">
                    <img x-ref="zoomImage" :src="'/storage/' + attachment"
                        class="max-w-full max-h-full transition-transform duration-300 ease-in-out" alt="Zoomed Image">
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
            <span class="font-bold text-[#C8B082] block mt-10 lg:mt-0">{{ $product->category }}</span>
            <h2 class="block text-[20px] lg:text-4xl font-bold mt-3">{{ $product->name }}</h2>
            <div>
                <p x-text="price + ' KZT'" class="text-2xl font-bold text-left"
                    :class="new_price ? '!text-[#C7A771] !text-xl line-through' : ''"></p>
                <p class="text-2xl font-bold text-left" x-show='new_price' x-text="new_price + ' KZT'"></p>
            </div>

            <div class="flex items-center justify-start space-x-3 mt-5">
                <template x-for="(item, index) in sizes" :key="index">
                    <button type="button" x-show="item.is_stock"
                        @click="update(item.name, item.old_price, item.new_price, index)"
                        class="w-[50px] h-[50px] flex justify-center items-center rounded-full border border-[#E1C37A] text-[12px] cursor-pointer">
                        <span class="font-bold w-full h-full flex justify-center items-center rounded-full"
                            :class="size === item.name ? 'bg-[#E1C37A] text-white' : ''">
                            <span x-text="item.name"></span> г
                        </span>
                    </button>
                </template>
            </div>


            <div class="w-full lg:w-[200px] grid grid-cols-3 py-2 border border-[#B9B9B9] rounded-[3px]">
                <button type="button" class="text-[#C8B082] font-bold flex justify-center" @click="decrement()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                </button>
                <span class="font-bold text-center" x-text="qty + ' шт'"></span>
                <button type="button" class="text-[#C8B082] font-bold flex justify-center" @click="increment()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-wrap lg:flex-nowrap items-center lg:space-x-3 space-y-5 lg:space-y-0">
                <button type="button" @click="$wire.addToCart(qty, size, price, new_price)"
                    class="border bg-[#C8B082] py-2.5 w-full lg:w-[14rem] rounded-[3px] text-white text-sm lg:text-[14px] h-[43px] font-bold text-center">
                    В корзину
                </button>
            </div>
        </div>
    </div>
</section>

@script
    <script>
        Alpine.data('singleProduct', () => {
            return {
                size: 0,
                qty: 1,
                sizes: [],
                price: '',
                new_price: '',
                attachments: [],
                attachment: '',

                init() {
                    this.sizes = {!! json_encode($product->sizes) !!};
                    this.attachments = this.sizes[0]?.attachments || [];
                    this.attachment = "{{ $product->image }}";
                    this.price = this.sizes[0]?.old_price || 0;
                    this.new_price = this.sizes[0]?.new_price ? this.sizes[0]?.new_price : 0;
                },

                update(size, price, new_price, index) {
                    this.size = size;
                    this.price = price;
                    this.new_price = this.sizes[0]?.new_price ? new_price : 0;
                    this.attachments = this.sizes[index]?.attachments || [];
                    this.attachment = this.sizes[index]?.attachments[0] || "{{ $product->image }}";
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
