    <!-- Main Content -->

    @extends('front.layouts.master')
    @section('title')
    Kişisel Blog - Anasayfa
    @endsection
    @section('content') 
    <!-- Post Content -->
        <div class="col-lg-8 col-md-9 mx-auto">
            {!!$article->content!!}
        </div>
    @include('front.widgets.categoryWidget')
    @endsection