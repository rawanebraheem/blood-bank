<x-app-layout>
    <x-slot name="header">
        <b>{{ $article->title }}</b>
    </x-slot>
    <b>id:</b> {{ $article->id }}<br>
    <b>title:</b> {{ $article->title }}<br>
    <b>image:</b> {{ $article->image }}<br>
    <?php $imagepath = 'images/' . $article->image; ?>
    {{-- <img src= "{{ asset($imagepath) }}" width="20px" height="20px" > --}}
    <b>content: </b>{{ $article->content }}<br>
    <b>category:</b>{{ $article->category->name }}<br>

</x-app-layout>
