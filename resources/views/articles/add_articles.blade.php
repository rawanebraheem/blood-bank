<x-app-layout>
    <x-slot name="header">
        Add Articles
    </x-slot>
    
    <form id="quickForm" method="POST" action="{{ url(route('articles.store')) }}">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="text" name="image" id="image" placeholder="Image">
            </div>
            <div class="form-group">

                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" cols="33" placeholder="Content"></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Choose category :</label>
                <select name="category_id" id="category_id">
                    <option hidden disabled selected value> -- select an option -- </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
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
