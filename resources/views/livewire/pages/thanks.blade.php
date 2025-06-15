<main>
    <section class="flex items-center py-24 justify-center">
        <div class="p-8 max-w-md text-center">
            <div class="flex justify-center">
                <img src="{{ asset('assets/images/checked_address.svg') }}" alt="">
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2 mt-10">Ваш заказ принят!</h1>
            <p class="text-gray-600 mb-6">
                Ожидайте доставку
            </p>
            <a href="{{ route('home') }}" class="inline-block bg-[#C8B082] text-white font-semibold py-2 px-4 rounded">
                На главную
            </a>
        </div>
    </section>

    {{-- @include('layouts.copiright') --}}
    <livewire:components.footer-short />
</main>
