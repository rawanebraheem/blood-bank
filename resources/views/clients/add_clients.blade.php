<x-app-layout>
    <x-slot name="header">
        Add Clients
    </x-slot>

    <form method="POST" action="{{ url(route('clients.store')) }}">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label for="last_donation_date">Last donation date</label>
                    <input class="form-control" type="date" name="last_donation_date" id="last_donation_date">
            </div>
            <div class="form-group">
                <label for="d_o_b">d_o_b</label>
                <input class="form-control" type="date" name="d_o_b" id="d_o_b">
            </div>

            <div class="form-group">
                <label for="blood_type_id">Blood type</label>

                <select name="blood_type_id" id="blood_type_id">
                    <option hidden disabled selected value> -- select an option -- </option>
                    @foreach ($blood_types as $blood_type)
                        <option value="{{ $blood_type->id }}"> {{ $blood_type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city_id">City</label>
                <select name="city_id" id="city_id">
                    <option hidden disabled selected value> -- select an option -- </option>
                    @foreach ($governorates as $governorate)
                        <optgroup label="{{ $governorate->name }}">
                            @foreach ($cities as $city)
                                @if ($governorate->id == $city->governorate_id)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endif
                            @endforeach

                        </optgroup>
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

        <b>{{ Session::get('success') }}</b>
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
