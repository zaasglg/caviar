<main class="pt-[93px] lg:pt-0">
    <section class="py-12 w-11/12 lg:w-9/12 mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div>
                <h4 class="text-[#C7A771] font-bold text-3xl">Казахстан, Алматы</h4>
                <div class="mt-10">
                    <div class="space-y-7">
                        <div class="flex space-x-3">
                            <span class="text-[14px] w-[40px]">моб.</span>
                            <a href="tel:+77001013494" class="col-span-2 text-[14px] font-bold transition hover:text-blue-500">+7 700 101 34 94</a>
                        </div>

                        <div>
                            <a href="https://wa.me/+77001013494"
                            target="__blank"
                                class="border border-[#E1E1E1] group hover:bg-[#E1E1E1] rounded-[7px] inline-flex items-center space-x-3 py-3 px-7 ">
                                <img src="{{ asset('assets/images/whatsapp.svg') }}" l alt="">
                                <span class="text-[12px] font-bold">+7 700 101 34 94</span>
                            </a>
                        </div>
                        <div>
                            <div class="flex space-x-3">
                                <span class="text-[14px] w-[40px]">email:</span>
                                <a href="mailto:info@caviar.com.kz" class="text-[14px] font-bold transition hover:text-blue-500">info@caviar.com.kz</a>
                            </div>
                            <div class="flex space-x-3">
                                <span class="text-[14px] w-[40px]">insta:</span>
                                <a href="https://www.instagram.com/caviar.com.kz/" class="text-[14px] font-bold transition hover:text-blue-500">caviar.com.kz</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="font-bold text-2xl">Обратная связь: </h2>
                <form action="#" method="POST" class="mt-5">
                    @csrf
        
                    <div>
                        <input type="text" name="name"
                            class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                            placeholder="Ваше имя">
                    </div>
        
                    <div class="mt-3">
                        <input type="text" name="email"
                            class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                            placeholder="E-mail адрес">
                    </div>
        
                    <div class="mt-3">
                        <textarea name="message"
                            class="w-full bg-[#ECECEC] p-5 rounded-[6px] border-none w-full text-xs placeholder:text-xs focus:border-none"
                            rows="10" placeholder="Напишите ваш пожелания или комментарий к заказу"></textarea>
                    </div>
        
                    <div class="flex items-center space-x-5 mt-5">
                        <button type="submit"
                            class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-black text-sm lg:text-[14px] font-bold text-center">Отправить</button>
                    </div>
        
                </form>
            </div>
            
        </div>
    </section>



    <livewire:components.footer-short />
</main>
