<x-app-layout>

    <x-slot name="header">
        Add Governorates
    </x-slot>
    <form method="POST" action="{{ url(route('governorates.store')) }}">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" >
            </div>
            

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


    @if (Session::has('success'))
<br>

       <b> {{ Session::get('success') }} </b>
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
