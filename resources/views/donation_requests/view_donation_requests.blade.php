<x-app-layout>
    <x-slot name="header">
        Donation Requests
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
                <th>patient name</th>
                <th>patient phone</th>
                <th>hospital name</th>
                <th>bags num</th>

            </tr>
        </thead>

        <tbody>


            @foreach ($donation_requests as $donation_request)
                <tr>
                    <td>{{ $donation_request->id }}</td>
                    <td>{{ $donation_request->patient_name }}</td>
                    <td>{{ $donation_request->patient_phone }}</td>
                    <td>{{ $donation_request->hospital_name }}</td>
                    <td>{{ $donation_request->bags_num }}</td>

                    @can('donation-request-delete')
                    <td>
                        <form method="POST" action="{{ url('donation-requests-destroy', $donation_request->id) }}">
                            @csrf

                            <input type="submit" value="Delete donation request">
                        </form>


                    </td>
                    @endcan
                    @can('donation-request-show')
                    <td>
                        <a href="{{ url('donation-requests-show', $donation_request->id) }}">View donation request</a>
                    </td>
                    @endcan




                </tr>
            @endforeach

        </tbody>

    </table>



    {!! $donation_requests->links() !!}

    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
    @endif
</x-app-layout>
