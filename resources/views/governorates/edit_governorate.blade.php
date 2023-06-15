<x-app-layout>

    <x-slot name="header">
        Edit Governorates
    </x-slot>

    <form method="POST" action="{{ url(route('governorates.update', $governorate->id)) }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $governorate->name }}">
            </div>


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    @if (Session::has('success'))
        <br>

        <b>{{ Session::get('success') }}</b>
    @endif
</x-app-layout>
