<x-app-layout>


    <x-slot name="header">
        Governorates
    </x-slot>

    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th> name</th>

            </tr>
        </thead>

        <tbody>

            @foreach ($governorates as $governorate)
                <tr>
                    <td>{{ $governorate->id }}</td>
                    <td>{{ $governorate->name }}</td>

                    @can('governorate-edit')
                    <td><a href="{{ url(route('governorates.edit', $governorate->id)) }}">Edit governorate</a>
                    </td>
                    @endcan
                    @can('governorate-delete')
                    <td>
                        
                        <form action="{{ url(route('governorates.destroy', $governorate->id)) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete Gov</button>
                        </form>
                    </td>
                    @endcan


                </tr>
            @endforeach

        </tbody>

    </table>



    {{-- <a href="{{ url(route('governorates.create')) }}">Add governorate</a> --}}


    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
    @endif
    @if (Session::has('error'))
        <br>

        {{ Session::get('error') }}
    @endif
</x-app-layout>
