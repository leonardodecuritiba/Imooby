<title>{{ isset($page_title) ? $page_title.' | Imooby' : 'Imooby | Aluguel de imóveis, apartamentos e casas' }}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="description" content="{{ isset($page_description) ? $page_description : 'Encontre casas, apartamentos, terrenos e imóveis para aluguel utilizando uma das maiores plataformas online e segura, Imooby.' }}"/>

<!-- Favicon -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
<link href="{{asset('assets_site/vendor/simple-line-icons/css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
{{-- <link href="{{asset('assets_site/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/> --}}

<!-- PAGE LEVEL PLUGIN STYLES -->
<link href="{{asset('assets_site/css/animate.min.css')}}" rel="stylesheet">
<link href="{{asset('assets_site/vendor/swiper/css/swiper.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets_site/vendor/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets_site/font/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/dropzone/dropzone.min.css') }}" rel="stylesheet">

<!-- THEME STYLES -->
<link href="{{asset('assets_site/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets_site/css/layout_index.min.css')}}" rel="stylesheet" type="text/css"/>

<!-- page css -->
<link href="{{asset('css/imooby.min.css')}}" rel="stylesheet" type="text/css"/>