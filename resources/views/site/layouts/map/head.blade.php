<meta charset="utf-8">
<title>{{ isset($page_title) ? $page_title.' | Imooby' : 'Imooby | Aluguel de imóveis, apartamentos e casas' }}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="description" content="{{ isset($page_description) ? $page_description : 'Encontre casas, apartamentos, terrenos e imóveis para aluguel utilizando uma das maiores plataformas online e segura, Imooby.' }}"/>

<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- GLOBAL MANDATORY STYLES -->
<link href="{{asset('assets_site/css/font-awesome.css')}}" rel="stylesheet">
{{--<link href="{{asset('assets_site/vendor/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet"/>--}}
<link href="{{asset('assets_site/css/simple-line-icons.css')}}" rel="stylesheet"/>
<link href="{{asset('assets_site/css/jquery-ui.css')}}" rel="stylesheet">
<link href="{{asset('assets_site/css/datepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets_site/css/bootstrap-datepicker-multiple.min.css')}}" rel="stylesheet">
<link href="{{asset('assets_site/css/jquery.timepicker.css')}}" rel="stylesheet">
<link href="{{asset('assets_site/css/fileinput.min.css')}}" rel="stylesheet">
{{--<link href="{{asset('assets_site/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>--}}
<link href="{{asset('assets_site/css/bootstrap.css')}}" rel="stylesheet"/>
<link href="{{asset('assets_site/css/app.css')}}" rel="stylesheet">
<link href="{{asset('assets_site/css/jquery-confirm.min.css')}}" rel="stylesheet">
<link href="{{asset('css/imooby.css')}}" rel="stylesheet" type="text/css"/>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
    #wrapper {
        overflow: auto;
    }
    .li_branco {
        font-size: 16px;
        margin-top: 20px;
        font-weight: bold;
        color: #151515;
    }
    .esconda {
        display: none !important;
    }
    #leftSide {z-index: 1040 !important;}
    .loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        position: absolute;
        top: 48%;
        left: 48%;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>