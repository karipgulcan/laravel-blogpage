    <!-- Main Content -->

    @extends('front.layouts.master')
    @section('title',$category->name.' Kategorisi') <!-- namenin yanındaki nokta sayesinde 'Kategorisinde stringi ile birleşti'-->
    @section('content')
    <div class="col-lg-8 col-md-9 mx-auto">
        @include('front.widgets.articleList')
    </div>
    @include('front.widgets.categoryWidget')
    <!--Kernel Düzenlenecek -->
    @endsection
