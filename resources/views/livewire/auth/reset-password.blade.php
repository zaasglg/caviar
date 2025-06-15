<main>
    <section class="py-24 w-11/12 lg:w-5/12 mx-auto">
        <div class="rounded-[15px] border border-[#DADADA] p-5 lg:p-10">
            <h2 class="text-xl font-bold">Сброс пароля</h2>

            @if (session()->has('success'))
                <div class="text-green-600 text-xs mt-3">
                    {{ session('success') }} Теперь Вы можете <a href="{{ route('login') }}" class="underline">Войти</a>
                    на сайт, используя Ваш логин и пароль.
                </div>
            @endif

            @if (session()->has('error'))
                <div class="text-red-600 text-xs mt-3">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="resetPassword" class="mt-5">
                <div class="mb-4">
                    <div class="relative">

                        <input id="hs-toggle-password" type="password" wire:model='password'
                            class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                            placeholder="Пароль">
                        <button type="button"
                            data-hs-toggle-password='{
                        "target": "#hs-toggle-password"
                      }'
                            class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600">
                            <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path class="hs-password-active:hidden"
                                    d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                </path>
                                <path class="hs-password-active:hidden"
                                    d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                </path>
                                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2"
                                    y2="22"></line>
                                <path class="hidden hs-password-active:block"
                                    d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3">
                                </circle>
                            </svg>
                        </button>

                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                {{-- <div class="mb-4">
                    <input type="password" wire:model="password" placeholder="Новый пароль" class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
                    
                </div> --}}

                <div class="mb-4">
                    <div class="relative">
                        <input id="hs-toggle-confirm-password" type="password" wire:model='password_confirmation'
                            class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                            placeholder="Пароль">
                        <button type="button"
                            data-hs-toggle-password='{
                        "target": "#hs-toggle-confirm-password"
                      }'
                            class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-blue-600">
                            <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path class="hs-password-active:hidden"
                                    d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                </path>
                                <path class="hs-password-active:hidden"
                                    d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                </path>
                                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2"
                                    y2="22"></line>
                                <path class="hidden hs-password-active:block"
                                    d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3">
                                </circle>
                            </svg>
                        </button>
                    </div>

                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="mb-4">
                    <input type="password" wire:model="password_confirmation" placeholder="Подтвердите пароль" class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
                </div> --}}

                <button type="submit"
                    class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-sm lg:text-[14px] font-bold text-center">Сбросить
                    пароль</button>
            </form>
        </div>
    </section>

    <livewire:components.footer-short>

</main>
