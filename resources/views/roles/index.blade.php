<x-app-layout>


    <x-slot name="header">
        Roles
    </x-slot>


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Name</th>

        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                @can('role-show')
                <td><a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a></td>
                @endcan

                <td> @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    @endcan
                </td>
                <td> @can('role-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan </td>

            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
</x-app-layout>
