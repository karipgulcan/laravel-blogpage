@extends('front.layouts.master')
@section('title')
@section('bg',$article->image)
@section('content') 
    <div class="col-lg-8 col-md-9 mx-auto">
        {!!$article->content!!}
        <br><br><br><br><br><br>
        <span class="text-danger">Okunma Sayısı: <b>{{$article->hit}}</b></span>
    </div>
@include('front.widgets.categoryWidget')
@endsection