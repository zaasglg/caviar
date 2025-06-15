<div>

    <div class="p-10">
        <h2 class="text-xl font-bold mb-3">Создать адрес</h2>
        <form id="address-form" method="POST" wire:submit="saveAddress()">
            <div>
                <select name="city_id" id="city_id" wire:model.live='city'
                    class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
                    <option value="#">--------------</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <input type="text" name="address" id="address" wire:model.live='name'
                    class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                    placeholder="Адрес">
            </div>

            <div class="flex items-center space-x-5 mt-5">
                <button type="submit"
                    class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-black text-sm lg:text-[14px] font-bold text-center">
                    Создать
                </button>
            </div>

        </form>
    </div>

</div>
