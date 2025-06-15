<div>
    <div>
        <select wire:model="city"
            class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
            <option value="#">--------------</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
    
    @error('city')
        <span class="text-xs text-red-500 font-thin">это поле является обязательным</span>
    @enderror
    
    <div class="mt-3">
        <input type="text" wire:model="address"
            class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
            placeholder="Адрес">
    </div>
    
    @error('address')
        <span class="text-xs text-red-500 font-thin">это поле является обязательным</span>
    @enderror
    
    <div class="flex items-center space-x-5 mt-5">
        <button type="button" wire:click="saveAddress()"
            class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-black text-sm lg:text-[14px] font-bold text-center">Создать</button>
    </div>
</div>