<x-app-layout>
    <x-slot name="header">
        Settings
    </x-slot>
    <form method="POST" action="{{ url('settings-update') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="notification_settings_text">notification settings text</label>
                <textarea id="notification_settings_text" name="notification_settings_text" class="form-control" rows="5" cols="33" >{{ $settings->notification_settings_text }}</textarea>
            </div>
            <div class="form-group">
                <label for="about_app">about app</label>
                <textarea id="about_app" name="about_app" class="form-control" rows="5" cols="33"  >{{ $settings->about_app }}</textarea>

            </div>
            <div class="form-group">
                <label for="phone">phone</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ $settings->phone }}">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ $settings->email }}">
            </div>
            <div class="form-group">
                <label for="fb_link">facebook link</label>

                <input class="form-control" type="text" name="fb_link" id="fb_link" value="{{ $settings->fb_link }}">
            </div>
            <div class="form-group">
                <label for="tw_link">twitter link</label>
                <input class="form-control" type="text" name="tw_link" id="tw_link" value="{{ $settings->tw_link }}">
            </div>
            <div class="form-group">
                <label for="insta_link">insta link</label>
                <input class="form-control" type="text" name="insta_link" id="insta_link" value="{{ $settings->insta_link }}">
            </div>
            <div class="form-group">
                <label for="youtube_link">youtube link</label>

                <input class="form-control" type="text" name="youtube_link" id="youtube_link" value="{{ $settings->youtube_link }}">
            </div>



        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@if (Session::has('success'))
<br>

   <b> {{ Session::get('success') }}</b>
@endif
</x-app-layout>
