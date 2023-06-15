<x-app-layout>
    <x-slot name="header">
        Edit Cities
    </x-slot>
    <form method="POST" action="{{ url(route('cities.update', $city->id)) }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $city->name }}">
            </div>

            <div class="form-group">
                <label for="governorate_id">Choose governorate :</label>
                <select name="governorate_id" id="governorate_id">
                    @foreach ($governorates as $governorate)
                        @if ($governorate->id == $city->governorate_id)
                            <option selected value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                        @else
                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                        @endif
                    @endforeach

                </select>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
    @endif
</x-app-layout>
