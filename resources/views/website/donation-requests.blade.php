<x-master>
    <x-slot name="navbar">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span
                        class="sr-only">(current)</span></a>
            </li>
           
            <li class="nav-item ">
                <a class="nav-link"  href="{{ url('web/articles') }}">المقالات</a>
            </li>
            <li class="nav-item active ">
                <a class="nav-link" href="{{ url('web/donation-requests') }}">طلبات التبرع</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/about-us') }}">من نحن</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/contact-us') }}">اتصل بنا</a>
            </li>
        </ul>
    </x-slot>


    <body class="donation-requests">
        <!--upper-bar-->




        <!--inside-article-->
        <div class="all-requests">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                        </ol>
                    </nav>
                </div>

                <!--requests-->
                <div class="requests">
                    <div class="head-text">
                        <h2>طلبات التبرع</h2>
                    </div>
                    <div class="content">
                        <form class="row filter">
                            <div class="col-md-5 blood">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select class="form-control" id="exampleFormControlSelect1" name="blood_type">
                                            <option hidden selected disabled>اختر فصيلة الدم</option>
                                            @foreach ($blood_types as $blood_type)
                                                <option value="{{ $blood_type->id }}"> {{ $blood_type->name }}</option>
                                            @endforeach

                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 city">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select class="form-control" id="exampleFormControlSelect1" name="city">
                                            <option hidden selected disabled>اختر المدينة</option>
                                            @foreach ($governorates as $governorate)
                                                <optgroup label="{{ $governorate->name }}">
                                                    @foreach ($cities as $city)
                                                        @if ($governorate->id == $city->governorate_id)
                                                            <option value="{{ $city->id }}">{{ $city->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach

                                                </optgroup>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 search">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <div class="patients">
                            @foreach($donation_requests as $donation_request)
                            <div class="details">
                                <div class="blood-type">
                                    <h2 dir="ltr">{{$donation_request->bloodType->name}}</h2>
                                </div>
                                <ul>
                                    <li><span>{{$donation_request->patient_name}}</span>  </li>
                                    <li><span>مستشفى:</span> {{$donation_request->hospital_name}}</li>
                                    <li><span>المدينة:</span> {{$donation_request->city->name}}</li>
                                </ul>
                                <a href="{{url('web\donation-request',$donation_request->id)}}">التفاصيل</a>
                               
                            </div>
                            
                            @endforeach
                                
                               
                        </div>
                        {!! $donation_requests->links() !!}
                       
                    </div>
                </div>
            </div>
        </div>




    </body>
</x-master>

