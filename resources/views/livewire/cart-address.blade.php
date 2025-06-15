<div x-data="cartAddress">
    <div class="flex justify-around">
        <button @click="active=0" class="tab-link text-sm font-bold"
            :class="active == 0 ? 'text-black' : 'text-[#9E9E9E]'">Выбрать свои адрес</button>
        @auth
            <button @click="active=1" class="tab-link text-sm font-bold"
                :class="active == 1 ? 'text-black' : 'text-[#9E9E9E]'">Добавить новый</button>
        @endauth
    </div>

    <div class="mt-10" x-show="active==0">
        @auth
            @if (auth()->user()->addresses)
                @foreach (auth()->user()->addresses as $address)
                    <div class="cursor-pointer w-full mb-3 flex justify-between items-center border border-[#D8D8D8] px-5 py-3 rounded-[8px]"
                        @click="setAddress({{ $address->id }})">
                        <div class="flex flex-col">
                            <span class="font-bold text-[#C7A771]">{{ $address->city['name'] }}</span>
                            <span>{{ $address->address }}</span>
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/checked_address.svg') }}" alt=""
                                x-show="address == {{ $address->id }}">
                            <img src="{{ asset('assets/images/unckecked_address.svg') }}" alt=""
                                x-show="address != {{ $address->id }}">
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex justify-center h-full items-center">
                    <span class="text-center text-sm">Пусто</span>
                </div>
            @endif
        @else
            <div>
                <select name="city_id" id="city_id"
                    class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs">
                    <option value="#">--------------</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <input type="text" name="address" id="address" wire:model.live="address"
                    class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                    placeholder="Адрес">
                    {{ $address }}

                @if (!empty($errors))
                    <p class="text-red-500 text-xs">{{ $errors[0] }}</p>
                @endif
            </div>
        @endauth
    </div>
    <div class="mt-10" x-show="active==1">
        @auth
            <div>
                <select wire:model.live="city"
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
                <input type="text" wire:model.live="name"
                    class="bg-[#ECECEC] rounded-[6px] border-none w-full h-[50px] text-xs placeholder:text-xs"
                    placeholder="Адрес">
            </div>

            @error('name')
                <span class="text-xs text-red-500 font-thin">это поле является обязательным</span>
            @enderror

            <div class="flex items-center space-x-5 mt-5">
                <button type="button" wire:click="saveAddress()"
                    class="bg-[#C7A771] py-2.5 px-5 text-white transition duration-500 hover:bg-[#A88448] rounded-[6px] text-black text-sm lg:text-[14px] font-bold text-center">Создать</button>
            </div>


        @endauth
    </div>
</div>


@script
    <script>
        Alpine.data('cartAddress', () => {
            return {
                active: 0,
                address: 0,
                setAddress(addressID) {
                    this.address = addressID;
                    console.log(addressID);
                    console.log(this.address);
                }
            }
        })
    </script>
@endscript
