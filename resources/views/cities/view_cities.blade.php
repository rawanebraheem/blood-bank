{{-- <form method="POST" action="{{ url('/cities-search-filter') }}">  --}}
<x-app-layout>
    <x-slot name="header">
        Cities
    </x-slot>
    <form method="GET">
        @csrf
        <label for="search">Search</label>
        <input type="search" name="search" id="search">

        <label for="governorate_id">Choose governorate :</label>

        <select name="governorate_id" id="governorate_id">
        <option hidden disabled selected value> -- select an option -- </option>

            @foreach ($governorates as $governorate)
                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
            @endforeach
        </select>
        <input type="submit">

    </form>
    <br>
    <br>



    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>governorate</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->governorate->name }}</td>
                    @can('city-edit')

                    <td><a href="{{ url(route('cities.edit', $city->id)) }}">Edit city</a></td>
                    @endcan

                    @can('city-delete')
                    <td>
                        <form action="{{ url(route('cities.destroy', $city->id)) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete city</button>
                        </form>
                    </td>
                    @endcan



                </tr>
            @endforeach

        </tbody>

    </table>
    <br>



    {{-- <a href="{{ url(route('cities.create')) }}">Add city</a>  --}}

    {!! $cities->links() !!}

    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
    @endif
</x-app-layout>
