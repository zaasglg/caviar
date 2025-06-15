<section class="w-11/12 lg:w-9/12 mx-auto">
    <h2 class="text-2xl font-bold text-center">Мои адреса</h2>
    <div class="mt-10 {{ count($addresses) > 0 ? 'grid grid-cols-2 gap-5' : 'flex justify-center w-full' }}">
        @foreach ($addresses as $address)
            <div wire:key='{{ $address->id }}'
                class="relative h-[112px] flex flex-col border border-[#CACACA] justify-center px-10 w-full rounded-2xl transition duration-200 group cursor-pointer">

                <button wire:click='deleteAddress({{ $address->id }})'
                    class="absolute top-0 right-0 transition duration-200 w-full h-full hidden group-hover:flex items-center justify-center bg-white rounded-2xl cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-1/2 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>

                <span class="font-bold text-[#C7A771]">{{ $address->city['name'] }}</span>
                <span class="font-bold">{{ $address->address }}</span>
            </div>
        @endforeach
        <button
            class="h-[112px] {{ count($addresses) > 0 ? 'w-full' : 'w-[500px]' }} border border-[#CACACA] py-5 rounded-[19px] flex justify-center items-center transition duration-200 group hover:bg-[#C7A771] hover:border-[#C7A771]"
            wire:click="$dispatch('openModal', {component: 'parts.modal-profile' })">
            <div
                class="bg-[#F2F2F2] transition duration-200 group-hover:bg-white w-[88px] h-[88px] rounded-full flex items-center justify-center">
                <img src="{{ asset('assets/images/plus.svg') }}" alt="">
            </div>
        </button>

    </div>
</section>
