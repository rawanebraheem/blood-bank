<x-master>
    <x-slot name="navbar">
        <ul class="navbar-nav">
            <li class="nav-item  ">
                <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span class="sr-only">(current)</span></a>
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


    <body class="create">

        <!--form-->
        <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form method="POST" action="{{ url('web/register-store') }}">
                        @csrf

                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="الإسم">

                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="البريد الإلكترونى">

                        <input placeholder="تاريخ الميلاد" class="form-control" type="date"
                            onfocus="(this.type='date')" id="date" name="d_o_b">



                        <select name="blood_type_id" id="blood_type_id">
                            <option hidden disabled selected value> -- اختر فصيلة دم -- </option>
                            @foreach ($blood_types as $blood_type)
                                <option value="{{ $blood_type->id }}"> {{ $blood_type->name }}</option>
                            @endforeach
                        </select>

                        <br>

                        <livewire:governorate />



                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="رقم الهاتف">

                        <input placeholder="آخر تاريخ تبرع" class="form-control" type="datetime"
                            onfocus="(this.type='date')" id="date" name="last_donation_date">

                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="كلمة المرور">

                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="تأكيد كلمة المرور" name="password_confirmation">

                        <div class="create-btn">
                            <input type="submit" value="إنشاء">
                        </div>
                    </form>

                    @if (Session::has('success'))
                        <br>

                        <b>{{ Session::get('success') }}</b>
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


        @livewireScripts

    </body>
</x-master>
