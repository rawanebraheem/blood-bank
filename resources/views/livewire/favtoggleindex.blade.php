<div>

    @if (Session::has('error'))
        <br>
        <script>
            swal("login first", "{{ Session::get('error') }}", {
                button: true,
                timer: 2100
            })
        </script>
    @endif





    <div class="view">
        <div class="container">

            <div class="row">

                <div class="owl-carousel articles-carousel">

                    @foreach ($articles as $article)
                        <div class="card">
                            <div class="photo">
                                <img src="{{ asset('imgs/p2.jpg') }}" class="card-img-top" alt="...">
                                <a href="{{ url('web/article-details', $article->id) }}" class="click">المزيد</a>
                            </div>
                            <a wire:click="articleToggleFav({{ $article->id }})" class="favourite">
                                <i @if ($article->is_favourite) style="color:#ffffff ;
                                background-color: rgb(233, 13, 13);" @endif
                                    class="far fa-heart"></i>
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
