<section class="w-11/12 lg:w-9/12 mx-auto py-12">
    <h2 class="font-bold text-[30px] text-center">Наши <span class="text-[#C8B082]">партнеры</span> </h2>

    <div class="mt-10 grid grid-cols-2 lg:grid-cols-4 gap-5">
		@for ($i = 1; $i <= 8; $i++)
			<div class="transition duration-500 group overflow-hidden cursor-pointer">
				<img src="{{ asset('assets/images/partners/' . $i . '.png') }}" alt="logo"
					 class="h-auto w-full object-cover transition duration-200 group-hover:scale-95">
			</div>
		@endfor
    </div>
</section>
