<x-master>
    <x-slot name="navbar">
        <ul class="navbar-nav">
            <li class="nav-item active ">
                <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span
                        class="sr-only">(current)</span></a>
            </li>
           
            <li class="nav-item ">
                <a class="nav-link"  href="{{ url('web/articles') }}">المقالات</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/donation-requests') }}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/about-us') }}">من نحن</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/contact-us') }}">اتصل بنا</a>
            </li>
        </ul>
    </x-slot>

    <body class="signin-account">


        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>
                <div class="signin-form">
                    <form method="POST" action="{{ url('web/login-store') }}">
                        @csrf

                        <div class="logo">
                            <img src="{{ asset('imgs/logo.png') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="الجوال" name="phone">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="كلمة المرور" name="password">
                        </div>
                        <div class="row options">
                            <div class="col-md-6 remember">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="remember_me" value="true">
                                    <label class="form-check-label" for="exampleCheck1"
                                        >تذكرنى</label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot">
                                <img src="{{ asset('imgs/complain.png') }}">
                                <a href="#">هل نسيت كلمة المرور</a>
                            </div>
                        </div>
                        <div class="row buttons">
                            <div class="col-md-6 right">
                                <button style=" padding: 15px 0;
                                margin: 10px 0;
                                font-size: 20px;
                                border-radius: 0;
                                color: #FFF;
                                border: none;
                                width: 90%;
                                background-color: #3ab54a;
                                text-align: center;
                                text-decoration: none;"
                                 type="submit"  >دخول</button>
                                
                            </div>
                            <div class="col-md-6 left">
                                <a  href="{{ url('web/register') }}">انشاء حساب جديد</a>
                            </div>
                        </div>
                    </form>
                    @if (Session::has('error'))
                        <br>

                        <b>{{ Session::get('error') }}</b>
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
                </div>
            </div>
        </div>




    </body>
</x-master>