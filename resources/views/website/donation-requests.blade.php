<x-master>



    <body class="donation-requests">





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

                <div> <br><a href="{{url('web/create-donation-request')}}"><button  class="btn btn-danger" style="font-size: 25px ; padding: 20px 70px;" > انشاء طلب تبرع</button></a></div>

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
                            @foreach ($donation_requests as $donation_request)
                                <div class="details">
                                    <div class="blood-type">
                                        <h2 dir="ltr">{{ $donation_request->bloodType->name }}</h2>
                                    </div>
                                    <ul>
                                        <li><span>{{ $donation_request->patient_name }}</span> </li>
                                        <li><span>مستشفى:</span> {{ $donation_request->hospital_name }}</li>
                                        <li><span>المدينة:</span> {{ $donation_request->city->name }}</li>
                                    </ul>
                                    <a href="{{ url('web\donation-request', $donation_request->id) }}">التفاصيل</a>

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
