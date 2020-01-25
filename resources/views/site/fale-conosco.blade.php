@php
$withoutLayoutJs = true;
$isLogged = false;
if (\Auth::check()) {
    $isLogged = true;
}
@endphp
@extends('site.layouts.institucional.template')
@section('styles_content')
@endsection
@section('modals_content')
@endsection
@section('body_content')
<div class="row" style="margin-top:45px">
<div class="col-md-8 col-md-offset-2">
<center><a href="{{ route('index') }}"><img src="{{asset('assets_site/img/logo.png')}}" style="width:160px;margin-bottom: 15px"></a></center>
<div class="row" style="margin-top:45px">
    <div class="card-im col-md-5" style="height:{!! $isLogged ? '440px' : '500px' !!}">
        <h3>ENVIE UMA MENSAGEM</b></h3>
        @if($isLogged)
        {!! Form::open(['route' => 'contactLogged','method' => 'POST']) !!}
        @else
        {!! Form::open(['route' => 'contact','method' => 'POST']) !!}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" name="name" class="form-control campos" placeholder="Insira o seu nome" required>
        </div>
        <div class="input-group" style="margin-top: 10px;">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" class="form-control campos" placeholder="Insira o seu e-mail" required>
        </div>
        <div class="input-group" style="margin-top: 10px;">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" name="phone" class="form-control campos" placeholder="Insira o seu telefone/celular">
        </div>
        @endif
        <div class="form-group">
            <textarea name="message" style="resize:none;margin-top:25px;" class="form-control" rows="5" placeholder="Digite a sua mensagem" maxlength="500" required="required"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-rec btn-success" href="">ENVIAR</button>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="card-im col-md-5 col-md-offset-1" style="height:{!! $isLogged ? '440px' : '500px' !!}">
        <div class="row linha_contato" style="margin-top: 45px;">
            <div class="col-md-offset-2 col-md-2 col-xs-2">
                <img src="assets_site/img/chat.png" style="height: 45px;">
            </div>
            <div class="col-md-8 col-xs-10 text-left">
                <label class="fonte_texto_contato">CHAT</label>
                <div style="margin-top: -5px;">
                    <label class="cor_texto">Atendimento online</label>
                </div>
            </div>
        </div>
        <div class="row linha_contato">
            <div class="col-md-offset-2 col-md-2 col-xs-2">
                <img src="assets_site/img/contato.png" style="height: 37px;">
            </div>
            <div class="col-md-8 col-xs-10 text-left">
                <label class="fonte_texto_contato">E-MAIL</label>
                <div style="margin-top: -5px;">
                    <label class="cor_texto">contato@imooby.com</label>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12 text-center">
                <a href="" target="_blank">
                    <img src="assets_site/img/facebook.png">
                </a>
                <a href="" target="_blank">
                    <img src="assets_site/img/twitter.png" style="margin-left: 20px;">
                </a>
                <a href="" target="_blank">
                    <img src="assets_site/img/printerest.png" style="margin-left: 20px;">
                </a>
                <a href="" target="_blank">
                    <img src="assets_site/img/instagram.png" style="margin-left: 20px;">
                </a>
                <a href="#" class="btn btn-primary btn-rec btn-block" style="margin-top:40px">CENTRAL DE AJUDA</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('scripts_content')
@endsection