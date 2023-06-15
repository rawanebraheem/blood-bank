<x-app-layout>
    <x-slot name="header">
        Articles
    </x-slot>
    <form method="GET">
        @csrf
        <label for="search">Search</label>
        <input type="search" name="search" id="search">

        <label for="category_id">Choose category :</label>

        <select name="category_id" id="category_id">
            <option hidden disabled selected value> -- select an option -- </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input
        style="background-color: #060607; 
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;"
        type="submit">

    </form>
    <br>
    <br>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>content</th>
                    <th>category</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }} </td>
                        <td>{{ $article->content }} </td>
                        <td>{{ $article->category->name }}</td>
                        <td><a href="{{ url(route('articles.edit', $article->id)) }}">Edit article</a></td>

                        <td>
                            <form action="{{ url(route('articles.destroy', $article->id)) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit">Delete article</button>
                            </form>
                        </td>
                        <td> <a href="{{ url(route('articles.show', $article->id)) }}">View article</a>
                        </td>


                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    <br>

    {!! $articles->links() !!}

    {{-- <a href="{{ url(route('articles.create')) }}">Add article</a>  --}}


    @if (Session::has('success'))
        <br>

        {{ Session::get('success') }}
    @endif
</x-app-layout>
