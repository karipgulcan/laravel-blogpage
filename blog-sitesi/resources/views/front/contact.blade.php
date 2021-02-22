@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://dealsinfotech.com/wp-content/uploads/2021/01/contact_us_279387361-scaled-1.jpeg')
@section('content') 
<div class="container">
  <div class="row">
    <div class="col-md-8">
      @if(session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <p>İletişime geçebilirsiniz</p>
      <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
      <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
      <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
      <form method="POST" action="{{route('contactpost')}}">
        @csrf
        <div class="control-group">
          <div class="form-group">
            <label>Ad Soyad</label>
            <input type="text" class="form-control" value="{{old('name')}}" placeholder="" name="name" required>
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group">
            <label>Mail adresi</label>
            <input type="email" class="form-control" value="{{old('email')}}" placeholder="" name="email" required>
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group">
            <label>Konu</label>
            <select class="form-control"  name="topic">
              <option value="Bilgi" @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
              <option value="Destek" @if(old('topic')=="Destek") selected @endif>Destek</option>
              <option value="Genel" @if(old('topic')=="Genel") selected @endif>Genel</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group">
            <label>Mesajınız</label>
            <textarea rows="5" class="form-control" placeholder="" name="message" required>{{old('message')}}</textarea> <!-- text areada içie yazıloıyor -->
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <br>
        <div id="success"></div>
        <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
      </form>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        <div class="card-body">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection