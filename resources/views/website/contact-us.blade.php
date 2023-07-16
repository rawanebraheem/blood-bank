<x-master>
    <x-slot name="navbar">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/articles') }}">المقالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/donation-requests') }}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/about-us') }}">من نحن</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('web/contact-us') }}">اتصل بنا</a>
            </li>
        </ul>
    </x-slot>

    <body class="contact-us">
        <!--upper-bar-->


        <!--nav-->


        <!--contact-us-->
        @inject('settings', 'App\Models\Setting')

        <div class="contact-now">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ol>
                    </nav>
                </div>
                <div class="row methods">
                    <div class="col-md-6">
                        <div class="call">
                            <div class="title">
                                <h4>اتصل بنا</h4>
                            </div>
                            <div class="content">
                                <div class="logo">
                                    <img src="{{ asset('imgs/logo.png') }}">
                                </div>
                                <div class="details">
                                    <ul>
                                        <li><span>الجوال:</span> {{ $settings->returnSettings()->phone }}</li>
                                        <li><span>فاكس:</span> 234234234</li>
                                        <li><span>البريد الإلكترونى:</span> {{ $settings->returnSettings()->email }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="social">
                                    <h4>تواصل معنا</h4>
                                    <div class="icons" dir="ltr">
                                        <div class="out-icon">
                                            <a href=" {{ $settings->returnSettings()->fb_link }}"><img
                                                    src="{{ asset('imgs/001-facebook.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href=" {{ $settings->returnSettings()->tw_link }}"><img
                                                    src="{{ asset('imgs/002-twitter.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href=" {{ $settings->returnSettings()->insta_link }}"><img
                                                    src="{{ asset('imgs/003-youtube.svg') }}"></a>
                                        </div>
                                        <div class="out-icon">
                                            <a href=" {{ $settings->returnSettings()->youtube_link }}"><img
                                                    src="{{ asset('imgs/004-instagram.svg') }}"></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">



                        <div class="contact-form">
                            <div class="title">
                                <h4>تواصل معنا</h4>
                            </div>
                            <div class="fields">
                                <form method="POST" action="{{ url('web\create-contact') }}">
                                    @csrf

                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="الجوال" name="phone">

                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="عنوان الرسالة" name="title">

                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                    <textarea placeholder="نص الرسالة" class="form-control" id="exampleFormControlTextarea1" rows="3" name="msg"></textarea>
                                    @if ($errors->has('msg'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('msg') }}
                                        </div>
                                    @endif
                                    <button type="submit">ارسال</button>
                                </form>
                            </div>
                        </div>

                      
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <br>
                                    <script>
                                        swal("success", "{{ Session::get('success') }}", {
                                            button: true,
                                            timer: 2100
                                        })
                                    </script>
                                </div>
                            @endif






                            
                      
                    </div>
                </div>
            </div>



    </body>
</x-master>
