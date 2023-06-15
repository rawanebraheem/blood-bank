<x-app-layout>
    <x-slot name="header">
        Add Cities
    </x-slot>
    <form method="POST" action="{{ url(route('cities.store')) }}">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="City Name">
            </div>

            <div class="form-group">
                <label for="governorate_id">Choose governorate :</label>
                <select name="governorate_id" id="governorate_id">
                    @foreach ($governorates as $governorate)
                        <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
