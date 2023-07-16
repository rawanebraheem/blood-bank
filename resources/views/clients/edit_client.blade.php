<x-app-layout>
    <x-slot name="header">
      Edit Clients
    </x-slot>
    <form method="POST" action="{{ url(route('clients.update', $client->id)) }}">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $client->name }}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ $client->email }}">
            </div>
            
            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ $client->phone }}">
            </div>
            <div class="form-group">
                <<label for="last_donation_date">Last donation date</label>
                    <input class="form-control" type="date" name="last_donation_date" id="last_donation_date"
                        value="{{ $client->last_donation_date }}">
            </div>
            <div class="form-group">
                <label for="d_o_b">d_o_b</label>>
                <input class="form-control" type="date" name="d_o_b" id="d_o_b" value="{{ $client->d_o_b }}">
            </div>

            <div class="form-group">
                <label for="blood_type_id">Blood type</label>

                <select name="blood_type_id" id="blood_type_id">
                    @foreach ($blood_types as $blood_type)
                        @if ($blood_type->id == $client->blood_type_id)
                            <option selected value="{{ $blood_type->id }}"> {{ $blood_type->name }}</option>
                        @else
                            <option value="{{ $blood_type->id }}"> {{ $blood_type->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city_id">City</label>
                <select name="city_id" id="city_id">
                    @foreach ($governorates as $governorate)
                        <optgroup label="{{ $governorate->name }}">
                            @foreach ($cities as $city)
                                @if ($governorate->id == $city->governorate_id)
                                    @if ($city->id == $client->city_id)
                                        <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                    @else<option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endif
                                @endif
                            @endforeach

                        </optgroup>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="is_active">Is active</label>
                <select name="is_active" id="">
                    <option value="0" @if(!$client->is_active) selected @endif>In Active</option>
                    <option value="1"  @if($client->is_active) selected @endif>Active</option>
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