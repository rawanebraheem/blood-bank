<div>

    <div class="articles">
        @if (Session::has('error'))
        <div class="alert alert-success">
            <br>
            <script>
                swal("login first", "{{ Session::get('error') }}", {
                    button: true,
                    timer: 2100
                })
            </script>
        </div>
        @endif


        @foreach ($articles as $article)

            <body class="article-details">

                <!--inside-article-->
                <div class="inside-article">
                    <div class="container">

                        <div class="photo">
                            <img src="{{ asset('imgs/p2.jpg') }}" class="card-img-top" alt="...">
                            
                        </div>
                        <div class="article-title col-12">
                            <div class="h-text col-6">
                                <h4>{{ $article->title }}</h4>
                            </div>
                            <div class="icon col-6">
                                <a wire:click="articleToggleFav({{ $article->id }})">
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
                            <?php echo substr($article->content, 0, 300); ?>...<a href="{{ url('web/article-details', $article->id) }}" class="click">المزيد</a>
                        </div>


                    </div>
                </div>




            </body>
        @endforeach


    </div>
