<x-app-layout>


    <x-slot name="header">
        Users 
    </x-slot>


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
           
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                @can('user-show')
                <td><a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a></td>
                @endcan
                @can('user-edit')
                <td><a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                @endcan
                @can('user-delete')

                <td> {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
                @endcan

            </tr>
        @endforeach
    </table>



    {!! $data->render() !!}

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
</x-app-layout>