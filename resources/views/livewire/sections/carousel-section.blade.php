<section class="mb-10">
    <div data-hs-carousel='{
            "dotsItemClasses": "hs-carousel-active:bg-[#c7a771] hs-carousel-active:border-[#c7a771] size-3 bg-gray-400 rounded-full cursor-pointer",
            "isAutoPlay": true,
            "isDraggable": true,
            "speed": "8000"
        }'
        class="relative">
        <div class="hs-carousel relative overflow-hidden w-full h-[450px] lg:h-[560px] bg-white">
            <div
                class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap opacity-0 cursor-grab transition-transform duration-700 hs-carousel-dragging:transition-none hs-carousel-dragging:cursor-grabbing">
                @foreach ($sliders as $slider)
                    <div class="hs-carousel-slide" wire:key='{{ $slider->id }}'>
                        @if ($slider->type == 'image')
                            <img src="{{ asset('/storage/' . $slider->file) }}" alt="Img"
                                class="w-full h-full hidden object-cover lg:block">
                            <img src="{{ asset('/storage/' . $slider->file_m) }}" alt="Img"
                                class="w-full h-full block object-cover lg:hidden">
                        @else
                        <div class="w-full h-full relative">
                            {{-- Прелоадер для десктопного видео --}}
                            <div class="hidden lg:flex video-preloader absolute inset-0 z-20 items-center justify-center bg-white">
                                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#c7a771]"></div>
                            </div>
                            <video 
                                src="{{ asset('/storage/' . $slider->file) }}" 
                                class="hidden lg:block absolute top-0 left-0 z-10 w-full h-full object-cover" 
                                autoplay muted loop playsinline 
                                preload="auto"
                                onloadeddata="this.previousElementSibling.style.display='none'">
                            </video>
                            
                            {{-- Прелоадер для мобильного видео --}}
                            <div class="flex lg:hidden video-preloader absolute inset-0 z-20 items-center justify-center bg-white">
                                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[#c7a771]"></div>
                            </div>
                            <video 
                                src="{{ asset('/storage/' . $slider->file_m) }}" 
                                class="block lg:hidden absolute top-0 left-0 z-10 w-full h-full object-cover" 
                                autoplay muted loop playsinline 
                                preload="auto"
                                onloadeddata="this.previousElementSibling.style.display='none'">
                            </video>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="hs-carousel-pagination flex justify-center absolute -bottom-10 start-0 end-0 space-x-2"></div>
    </div>
</section>
