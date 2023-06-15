<head>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body>



    <form method="POST" action="{{ url('settings-update') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="notification_settings_text">notification settings text</label>
                <textarea id="notification_settings_text" name="notification_settings_text" class="form-control" rows="5" cols="33" value="{{ $settings->notification_settings_text }}"></textarea>
            </div>
            <div class="form-group">
                <label for="about_app">about app</label>
                <textarea id="about_app" name="about_app" class="form-control" rows="5" cols="33" value="{{ $settings->about_app }}" ></textarea>

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

</body>
