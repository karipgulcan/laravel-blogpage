    <!-- Main Content -->

    @extends('front.layouts.master')
    @section('title')
    Kişisel Blog - Anasayfa
    @endsection
    @section('content')

    <div class="col-lg-8 col-md-9 mx-auto">
        @foreach($articles as $article)
        <div class="post-preview">
            <a href="post.html">
                <h2 class="post-title">
                    {{$article->title}}
                </h2>
                <h3 class="post-subtitle">
                    {{Str::limit($article->content),12}}
                </h3>
            </a>
            <p class="post-meta">
                <a href="#">{{$article->category_id}}</a>
                {{($article->created_at)}}
            </p>
        </div>
        @endforeach
        <hr>
        <!-- Pager -->
        <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
    </div>
    @include('front.widgets.categoryWidget')
    @endsection