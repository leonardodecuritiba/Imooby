<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administração - @yield('title', config('app.name'))</title>
@include('admin.layout.head')

@yield('style_content')
<!-- Custom styling plus plugins -->
    {!! Html::style('assets_admin/build/css/custom.min.css') !!}
    {{--{!! Html::script('assets_admin/bower_components/nprogress/nprogress.js') !!}--}}
    <style>
        .loading {
            background: #fff url("{{asset('assets_admin/imgs/ajax-loader.gif')}}") no-repeat center center !important;
        }
        .esconde {
            display: none;
        }
    </style>
</head>
<body class="nav-md">
<script>
    //			NProgress.start();
</script>
<div class="container body">
    @yield('modal_content')
    <div class="main_container">
        <!---- Visualização de erros ----->
    @include('admin.layout.menu')

    <!-- page content -->
        <div class="right_col" role="main">
            <div class="loading loading-page"></div>
        @yield('modal_content')
        @if (count($errors) > 0)
            @include('admin.layout.alerts.erros')
        @endif
        @if (session()->has('mensagem'))
            @include('admin.layout.alerts.success')
        @endif
        @yield('page_content')
        <!-- /page content -->
        </div>
    </div>
</div>
@include('admin.layout.foot')
@yield('scripts_content')
</body>
</html>
