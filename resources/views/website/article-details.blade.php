<x-master>
    <x-slot name="navbar">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('web/home') }}">الرئيسية <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/articles') }}">المقالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/donation-requests') }}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/about-us') }}">من نحن</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('web/contact-us') }}">اتصل بنا</a>
            </li>
        </ul>
    </x-slot>



    <div class="articles">
        @if (Session::has('error'))
            <br>
            <script>
                swal("login first", "{{ Session::get('error') }}", {
                    button: true,
                    timer: 2100
                })
            </script>
        @endif





        <body class="article-details">
            <!--upper-bar-->



            <!--nav-->


            <!--inside-article-->
            <div class="inside-article">
                <div class="container">
                    <div class="path">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                                <li class="breadcrumb-item active" aria-current="page">الوقاية من الأمراض</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="article-image">
                        <img src="{{ asset($article->image) }}">
                    </div>
                    <div class="article-title col-12">
                        <div class="h-text col-6">
                            <h4>{{ $article->title }}</h4>
                        </div>
                        <div class="icon col-6">
                            <a href="{{ url(route('article.fav', $article->id)) }}">
                                <button type="button"
                                    @if ($article->is_favourite) style=" background-color: rgb(233, 13, 13);" @endif>
                                    <i @if ($article->is_favourite) style="color:#ffffff ;" @endif
                                        class="far fa-heart"></i>
                                </button>
                            </a>


                        </div>
                    </div>

                    <!--text-->
                    <div class="text">
                        {{ $article->content }}
                    </div>

                    <!--articles-->
                    <div class="articles">
                        <div class="title">
                            <div class="head-text">
                                <h2>مقالات ذات صلة</h2>
                            </div>
                        </div>
                        <div class="view">
                            <div class="row">
                                <!-- Set up your HTML -->
                                <div class="owl-carousel articles-carousel">
                                    @foreach ($articles as $article)
                                        <div class="card">
                                            <div class="photo">
                                                <img src="{{ asset('imgs/p2.jpg') }}" class="card-img-top"
                                                    alt="...">
                                                <a href="{{ url('web/article-details', $article->id) }}"
                                                    class="click">المزيد</a>
                                            </div>
                                            <a class="favourite">
                                                <i class="far fa-heart"></i>
                                            </a>

                                            <div class="card-body">
                                                <h5 class="card-title"> {{ $article->title }} </h5>
                                                <p class="card-text">
                                                    <?php echo substr($article->content, 0, 100); ?>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </body>





</x-master>
