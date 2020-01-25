@php
  $withoutLayoutJs = true;
@endphp
@extends('site.layouts.institucional.template')
@section('styles_content')
@endsection
@section('modals_content')
@endsection
@section('body_content')
    <div class="card-lr">
    <form action="{{ route('clients.begin') }}" method="POST">
    {{ csrf_field() }}
    <center><img src="{{asset('assets_site/img/logo.png')}}" style="width:160px;margin-bottom: 15px">
        <a href="{{ route('facebook.redirect') }}" class="btn btn-primary btn-facebook btn-block btn-lg">
        <i class="fa fa-facebook" style="margin-right: 5px; margin-left: -8px;"></i>ENTRAR COM O FACEBOOK</a>
    Ou crie uma conta:</center>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Seu nome">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
            <input id="phone" type="text" class="sp_celphones form-control" value="{{ old('phone') }}" name="phone" placeholder="Seu celular">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Seu email">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input id="email_c" type="text" class="form-control" name="email_confirmation" placeholder="Confirme seu email">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Sua senha">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input id="password_c" type="password" class="form-control" name="password_confirmation" placeholder="Confirme sua senha">
        </div>
        <div class="form-group" style="margin-top:15px;line-height:normal;">
            <input type="submit" value="Crie sua conta" class="btn-rounded btn-primary btn btn-login btn-block">
        </div>
        <div class="muted-box">Ao clicar no botão acima, você concorda com nossos <a class="alink" href="{{ route('termos-de-uso') }}" target="_BLANK">Termos de Uso</a> e nossas <a class="alink" target="_BLANK" href="{{ route('politicas-de-privacidade') }}">políticas de privacidade</a>.</div>
        <center style="line-height:normal">Já tem uma conta?<br><a class="alink" href="{{ route('login.form') }}">Entre em sua conta!</a></center>
    </div>
@endsection
