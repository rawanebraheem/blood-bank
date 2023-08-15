<x-master>
  

    <!--intro-->
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>{{ __('index.h3_intro')}}</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                على الشكل الخارجي للنص.
                            </p>
                            <a href="{{ url('web/about-us') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                على الشكل الخارجي للنص.
                            </p>
                            <a href="{{ url('web/about-us') }}">المزيد</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>بنك الدم نمضى قدما لصحة أفضل</h3>
                            <p>
                                هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                على الشكل الخارجي.
                            </p>
                            <a href="{{ url('web/about-us') }}">المزيد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>بنك الدم</span> هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن
                    التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة
                    لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ.
                </p>
            </div>
        </div>
    </div>

    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>المقالات</h2>
            </div>
        </div>



        <div class="view">
            <div class="container">

                <div class="row">


                    <div class="articles-carousel owl-carousel">


                        @foreach ($articles as $articl)
                            {{-- <livewire:favtoggleindex /> --}}
                           
                            @livewire('favtoggleindex', [$articl])
                        @endforeach


                    </div>
                </div>
            </div>
        </div>




    </div>
    <!--requests-->
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>طلبات التبرع </h2>
            </div>
        </div>
        <div class="content">
            <div class="container">

                <div class="patients">
                    @foreach ($don_requests as $don_request)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{ $don_request->bloodType->name }}</h2>
                            </div>
                            <ul>
                                <li><span>اسم الحالة:</span> {{ $don_request->patient_name }}</li>
                                <li><span>مستشفى:</span>{{ $don_request->hospital_name }} </li>
                                <li><span>المدينة:</span>{{ $don_request->city->name }}</li>
                            </ul>
                            <a href="{{ url('web/donation-request', $don_request->id) }}">التفاصيل</a>
                        </div>
                    @endforeach

                </div>
                <div class="more">
                    <a href="{{ url('web/donation-requests') }}">المزيد</a>
                </div>
            </div>
        </div>
    </div>

    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>اتصل بنا</h3>
                </div>
                <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src="{{ asset('imgs/whats.png') }}">
                        <p dir="ltr">+002 1215454551</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>تطبيق بنك الدم</h3>
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                        العربى،
                    </p>
                    <div class="download">
                        <h4>متوفر على</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{ asset('imgs/google.png') }}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{ asset('imgs/ios.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{ asset('imgs/App.png') }}">
                </div>
            </div>
        </div>
    </div>




</x-master>
