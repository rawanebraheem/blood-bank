<div>
    <select name="governorate_id" id="governorate_id" wire:model="governorate1">
           <option hidden  selected value> -- اختر محافظة -- </option>
        @foreach ($governorates as $governorate)
            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
        @endforeach
    </select>


    <br>

    

    <select name="city_id" id="city_id" name=city >
        <option hidden disabled selected value> -- اختر مدينة -- </option>

        @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>


    <br>
    

</div>
