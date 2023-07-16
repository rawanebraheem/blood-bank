<x-app-layout>
    <x-slot name="header">
       Clients
    </x-slot>
<form method="GET" >
    @csrf

    <label for="search">Search</label>
    <input type="search" name="search" id="search">
</form>
<br>
<br>

<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>phone</th>
            <th>email</th>
            <th>date of birth</th>
            <th>last donation date</th>
            <th>blood type</th>
            <th>city</th>
            <th>is_active</th>


        </tr>
    </thead>

    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->d_o_b }}</td>
                <td>{{ $client->last_donation_date }}</td>
                <td>{{ $client->bloodType->name }}</td>
                <td>{{ $client->city->name }}</td>
                <td>{{ $client->is_active }}</td>
                @can('client-edit')

                <td> <a href="{{ url(route('clients.edit', $client->id)) }}">Edit client</a></td>
                @endcan

                @can('client-delete')
                <td>
                    <form action="{{ url(route('clients.destroy', $client->id)) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit">Delete client</button>
                    </form>
                </td>
                @endcan



            </tr>
        @endforeach

    </tbody>

</table>


{{-- <a href="{{ url(route('clients.create')) }}">Add client</a> --}}

{!! $clients->links() !!}

@if (Session::has('success'))
    <br>

    {{ Session::get('success') }}
@endif
</x-app-layout>