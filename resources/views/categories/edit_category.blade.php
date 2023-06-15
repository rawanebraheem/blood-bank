<x-app-layout>
    <x-slot name="header">
        Edit Categories
    </x-slot>
    <form method="POST" action="{{ url(route('categories.update', $category->id)) }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $category->name }}">
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
