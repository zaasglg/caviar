<main>
    <section class="w-11/12 lg:w-9/12 mx-auto py-12">
        <div class="flex justify-center">
            @if (auth()->user()->avatar)
                <button wire:click="deleteImage" class="focus:outline-none">
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar"
                        class="w-[246px] h-[246px] rounded-full" id="avatarImage">
                </button>
            @else
                <div
                    class="w-[246px] h-[246px] bg-[url('{{ asset('assets/images/ava-border.svg') }}')] flex items-center justify-center">
                    <div class="w-[194px] h-[194px] bg-gray-50 flex items-center justify-center rounded-full relative">
                        <div wire:loading wire:target="avatar"
                            class="absolute inset-0 bg-gray-50/80 rounded-full flex items-center justify-center z-10">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#C7A771]"></div>
                        </div>
                        <input type="file" wire:model="avatar" wire:change="uploadImage"
                            class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                        <img src="{{ asset('assets/images/camera.svg') }}" alt="camera" class="w-9">
                    </div>

                    @error('avatar')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
            @endif
        </div>

        <div class="mt-10">
            <h2 class="text-4xl font-bold text-center">{{ auth()->user()->name }}</h2>
            <span class="text-[#C7A771] font-bold text-center block mt-3">г. Алматы</span>
        </div>

        <div class="flex justify-center w-full mt-10">
            <span wire:click='logout()'
                class="text-black py-2 px-5 border text-xs rounded-md flex items-center space-x-3 cursor-pointer transition duration-200 hover:scale-105 hover:border-red-900">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm5.03 4.72a.75.75 0 0 1 0 1.06l-1.72 1.72h10.94a.75.75 0 0 1 0 1.5H10.81l1.72 1.72a.75.75 0 1 1-1.06 1.06l-3-3a.75.75 0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </span>

                <span>Выйти с аккаунта</span>
            </span>
        </div>
    </section>


    <livewire:parts.address-profile />

    <livewire:sections.orders-section />

    <livewire:components.footer-short />
</main>


@script
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('avatarUpdated', function() {
                // Обновляем изображение, чтобы избежать кеширования
                const avatarImage = document.getElementById('avatarImage');
                if (avatarImage) {
                    avatarImage.src = avatarImage.src + '?' + new Date().getTime();
                }
            });
        });
    </script>
@endscript
