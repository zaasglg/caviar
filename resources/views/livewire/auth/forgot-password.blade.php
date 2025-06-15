<main>
    <section class="py-24 w-11/12 lg:w-5/12 mx-auto">
        <div class="rounded-[15px] border border-[#DADADA] p-5 lg:p-10">
            <h6 class="text-xl font-bold">Забыл пароль</h6>


            @if (session()->has('success'))
                <div class="text-green-600 text-xs mt-3">
                    {{ session('success') }}
                </div>
            @endif


            <form wire:submit='sendResetLink()' method="POST" class="mt-5">

                @csrf

                @session('error')
                    <span class="text-red-500 font-medium text-xs block mb-4">{{ session('error') }}</span>
                @endsession

                <div>
                    <input type="text" name="email" wire:model='email'
                        class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                        placeholder="E-mail адрес">

                    @error('email')
                        <span class="mt-2 text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>


                <div class="flex items-center space-x-5 mt-5">
                    <button type="submit"
                        class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-sm lg:text-[14px] font-bold text-center"
                        wire:loading.attr="disabled" wire:target="sendResetLink">
                        <span wire:loading.remove wire:target="sendResetLink">Восстановить</span>
                        <span wire:loading wire:target="sendResetLink">Отправка...</span>
                    </button>

                </div>

            </form>
        </div>
    </section>

    <livewire:components.footer-short>
</main>
