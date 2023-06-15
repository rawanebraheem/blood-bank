<x-app-layout>
    <x-slot name="header">
        Edit Articles
    </x-slot>

    <form id="quickForm" method="POST" action="{{ url(route('articles.update', $article->id)) }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ $article->title }}">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="text" name="image" id="image" value="{{ $article->image }}">
            </div>
            <div class="form-group">

                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" cols="33"
                   > {{ $article->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Choose category :</label>
                <select name="category_id" id="category_id">

                    @foreach ($categories as $category)
                        @if ($category->id == $article->category_id)
                            <option selected value="{{ $category->id }}"> {{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
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
</x-app-layout>
