<x-app-layout>
    <x-slot name="header">
        Categories
    </x-slot>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>


            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }} </td>
                    @can('category-edit')

                    <td><a href="{{ url(route('categories.edit', $category->id)) }}">Edit category</a> </td>
                    @endcan

                    @can('category-delete')

                    <td>
                        <form action="{{ url(route('categories.destroy', $category->id)) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete category</button>
                        </form>
                    </td>
                    @endcan




                </tr>
            @endforeach

        </tbody>

    </table>


    {{-- <a href="{{ url(route('categories.create')) }}">Add category</a> --}}
    @if (Session::has('success'))
        <br>

        {!! $categories->links() !!}


        {{ Session::get('success') }}
    @endif
    @if (Session::has('error'))
        <br>

        {{ Session::get('error') }}
    @endif
</x-app-layout>
