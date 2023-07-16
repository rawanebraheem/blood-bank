<x-app-layout>
    <x-slot name="header">
        Contacts
    </x-slot>

    <form method="GET">
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
                <th>phone</th>
                <th>title</th>
                <th>massege</th>
                <th>client name</th>
                <th>client phone</th>

            </tr>
        </thead>

        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td> {{ $contact->title }}</td>
                    <td>{{ $contact->msg }}</td>
                    <td>{{ $contact->client->name }} </td>
                    <td>{{ $contact->client->phone }}</td>

                    @can('contact-delete')
                    <td>
                        <form method="POST" action="{{ url('contacts-destroy', $contact->id) }}">
                            @csrf

                            <input type="submit" value="Delete contact">
                        </form>


                    </td>
                    @endcan

                </tr>
            @endforeach

        </tbody>

    </table>
    {!! $contacts->links() !!}

    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
    @endif
</x-app-layout>
