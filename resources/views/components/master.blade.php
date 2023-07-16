<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="icon" href="{{ asset('imgs/Icon.png') }}">


    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

    <!--style css-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>Blood Bank</title>
    @livewireStyles

</head>

<body>
    @inject('settings', 'App\Models\Setting')
    <!--upper-bar-->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="language">
                        <a href="index.html" class="ar active">عربى</a>
                        <a href="index-ltr.html" class="en inactive">EN</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social">
                        <div class="icons">
                            <a href="{{ $settings->returnSettings()->fb_link }}" class="facebook"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ $settings->returnSettings()->tw_link }}" class="instagram"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="{{ $settings->returnSettings()->insta_link }}" class="twitter"><i
                                    class="fab fa-twitter"></i></a>
                            {{-- <a href="{{$settings->returnSettings()->youtube_link}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a> --}}
                        </div>
                    </div>
                </div>

                <!-- not a member-->
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>{{ $settings->returnSettings()->phone }}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{ $settings->returnSettings()->email }}</p>
                        </div>
                    </div>

                    <!--I'm a member

                <div class="member">
                    <p class="welcome">مرحباً بك</p>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            احمد محمد
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="index-1.html">
                                <i class="fas fa-home"></i>
                                الرئيسية
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="far fa-user"></i>
                                معلوماتى
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="far fa-bell"></i>
                                اعدادات الاشعارات
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="far fa-heart"></i>
                                المفضلة
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="far fa-comments"></i>
                                ابلاغ
                            </a>
                            <a class="dropdown-item" href="contact-us.html">
                                <i class="fas fa-phone-alt"></i>
                                تواصل معنا
                            </a>
                            <a class="dropdown-item" href="index.html">
                                <i class="fas fa-sign-out-alt"></i>
                                تسجيل الخروج
                            </a>
                        </div>
                    </div>
                </div>

                -->

                </div>
            </div>
        </div>
    </div>


    <!--nav-->
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('imgs/logo.png') }}" class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    {{ $navbar }}

                    <!--not a member-->
                    <div class="accounts">




                        @auth('api-web')
                            <form method="POST" action="{{ url('web/logout') }}">
                                @csrf

                                <button type="submit"
                                    style="color: white; background-color: #001B35; padding: 15px 32px; font-size: 20px;">تسجيل
                                    الخروج</button>
                            </form>
                        @else
                            <a href="{{ url('web/register') }}" class="create">انشاء حساب جديد</a>
                            <a href="{{ url('web/login') }}" class="signin">الدخول</a>
                        @endauth
                    </div>



                    <!--I'm a member

                <a href="#" class="donate">
                    <img src="{{ asset('imgs/transfusion.svg') }}">
                    <p>طلب تبرع</p>
                </a>

                -->

                </div>
            </div>
        </nav>
    </div>

    {{ $slot }}

    <!--footer-->
    <div class="footer">
        <div class="inside-footer">
            <div class="container">
                <div class="row">
                    <div class="details col-md-4">
                        <img src="{{ asset('imgs/logo.png') }}">
                        <h4>بنك الدم</h4>
                        <p>
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                            العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى.
                        </p>
                    </div>
                    <div class="pages col-md-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action " id="list-home-list"
                                href="{{ url('web/home') }}" role="tab" aria-controls="home">الرئيسية</a>

                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                href="{{ url('web/articles') }}" role="tab"
                                aria-controls="messages">المقالات</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{ url('web/donation-requests') }}" role="tab"
                                aria-controls="settings">طلبات
                                التبرع</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{ url('web/about-us') }}" role="tab" aria-controls="settings">من نحن</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{ url('web/contact-us') }}" role="tab" aria-controls="settings">اتصل
                                بنا</a>
                        </div>
                    </div>
                    <div class="stores col-md-4">
                        <div class="availabe">
                            <p>متوفر على</p>
                            <a href="#">
                                <img src="{{ asset('imgs/google1.png') }}">
                            </a>
                            <a href="#">
                                <img src="{{ asset('imgs/ios1.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="other">
            <div class="container">
                <div class="row">
                    <div class="social col-md-4">
                        <div class="icons">
                            <a href="{{ $settings->returnSettings()->fb_link }}" class="facebook"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ $settings->returnSettings()->tw_link }}" class="instagram"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="{{ $settings->returnSettings()->insta_link }}" class="twitter"><i
                                    class="fab fa-twitter"></i></a>
                            {{-- <a href="{{$settings->returnSettings()->youtube_link}}" class="whatsapp"><i class="fab fa-whatsapp"></i></a> --}}
                        </div>
                    </div>
                    <div class="rights col-md-8">
                        <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @livewireScripts

</body>

</html>
