@php
  $withoutLayoutJs = true;
@endphp
@extends('site.layouts.institucional.template')
@section('styles_content')
@endsection
@section('modals_content')
@endsection
@section('body_content')
<div>
    
    <div class="card-lr .login">
    <form action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <center><a href="{{ route('index') }}"><img src="{{asset('assets_site/img/logo.png')}}" style="width:160px;margin-bottom: 15px"></a>
    <a href="{{ route('facebook.redirect') }}" class="btn btn-primary btn-facebook btn-block btn-lg">
        <i class="fa fa-facebook" style="margin-right: 5px; margin-left: -8px;"></i>ENTRAR COM O FACEBOOK</a>
    Ou entre com seu email:</center>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Senha">
        </div>
        <div style="text-align:right">
            <a href="#" class="alink" data-toggle="modal" data-target="#modal_esqueci">Esqueci minha senha</a>
        </div>
        <div class="form-group">
            <input type="submit" value="Entrar" class="btn-rounded btn-primary btn btn-login btn-block">
        </div>
        <center>Ainda não tem uma conta?<br><a href="{{ route('clients.beginForm') }}" class="alink">Crie uma agora mesmo!</a></center>
    </div>
</div>
@endsection
@section('scripts_content')
@endsection