@extends('site.layouts.institucional.template')
@section('styles_content')
@endsection
@section('body_content')

    <!--========== HEADER ==========-->
    @include('site.layouts.menu.home.navbar')
    <!--========== END HEADER ==========-->

    <!--========== PAGE LAYOUT ==========-->
    <div style="background-color: #00a7ec;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: #fff; margin-top: 50px">
                    <div class="panel panel-default" style="border-radius: 0px; padding: 20px;">
                        <div class="panel-body">
                            <h1 style="color: #00a7ec; font-weight: normal;">Recuperar <b>Senha</b></h1>
                            {{Form::open(['route'=>'password.request'])}}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}"
                                         style="margin-top: 10px;">
                                        <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                                    class="fa fa-envelope"></i></span>
                                        <input type="email" name="email" value="{{ $email or old('email') }}"
                                               class="form-control campos" placeholder="Email">
                                        {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@endif--}}
                                    </div>
                                </div>
                                <div class="col-md-4{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="input-group" style="margin-top: 10px;">
                                        <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                                    class="fa fa-lock"></i></span>
                                        <input type="password" name="password" class="form-control campos"
                                               placeholder="Digite a nova senha">
                                        {{--@if ($errors->has('password'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@endif--}}
                                    </div>
                                </div>
                                <div class="col-md-4{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <div class="input-group" style="margin-top: 10px;">
                                        <span class="input-group-addon" style="color: #00a7ec; background-color: #fff;"><i
                                                    class="fa fa-lock"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control campos"
                                               placeholder="Repita a nova senha">
                                    </div>
                                    {{--@if ($errors->has('password_confirmation'))--}}
                                    {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-lg"
                                            style="border-radius: 0px; margin-top: 10px; background-color: #00a7ec; border-color: #00a7ec">
                                        <i class="fa fa-refresh"></i> Recuperar
                                    </button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--========== END PAGE LAYOUT ==========-->

    <!--========== FOOTER ==========-->
    @include('site.layouts.institucional.footer')
    <!--========== END FOOTER ==========-->

@endsection
@section('scripts_content')

@endsection