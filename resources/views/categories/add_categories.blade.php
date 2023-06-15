<x-app-layout>
    <x-slot name="header">
        Add Categories
    </x-slot>
    <form method="POST" action="{{ url(route('categories.store')) }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" itype="text" name="name" id="name" placeholder="Category Name">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
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
