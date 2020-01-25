<header class="header navbar-fixed-top">
    <!-- Navbar -->
    <nav class="navbar{{ Route::is('index') ? '' : ' navbar-awhite' }}" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container js_nav-item">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>

                <!-- Logo -->
                <div class="logo">
                    <a class="logo-wrap" href="{{route('index')}}">
                        <img class="logo-img logo-img-main" src="{{asset('assets_site/img/logo_136x37.png')}}" alt="Imooby Logo">
                        <img class="logo-img logo-img-active" src="{{asset('assets_site/img/logo_136x37.png')}}" alt="Imooby Logo">
                    </a>
                </div>
                <!-- End Logo -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav navbar-nav-right">
                        <li class=""><a class="nav-item-child" href="{{route('sobre-nos')}}">SOBRE NÓS</a></li>
                        <li>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-item-child" style="padding:10px 15px;">COMO FUNCIONA <b class="caret"></b></a>
                                <ul class="dropdown-menu" style="border-radius: 0px;">
                                    <li><a href="{{route('como-funciona-proprietario')}}" style="padding: 10px 20px;">Para você proprietário</a></li>
                                    <li><a href="{{route('como-funciona-inquilino')}}" style="padding: 10px 20px;">Para você inquilino</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class=""><a class="nav-item-child" target="_BLANK" href="{{ route('contactus') }}">FALE CONOSCO</a></li>

                        @if(Auth::check())
                        <!--logado-->
                        <li>
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" style="padding: 10px 15px;" class="dropdown-toggle nav-item-child">
                                    <img src="{{Auth::user()->getThumbPhoto()}}" class="img-circle" style="width: 30px; margin-right: 10px;"> Olá,
                                    <b>{{Auth::user()->getShortName()}}</b> <b class="caret"></b></a>
                                    <ul class="dropdown-menu" style="border-radius: 0px;">
                                        @if(Entrust::hasRole('admin'))
                                        <li><a href="{{route("administrativo")}}" style="padding: 10px 20px;"><i class="fa fa-cogs"></i> Administração</a></li>
                                        @else
                                        <li><a href="{{route("profile.my")}}" style="padding: 10px 20px;"><i class="fa fa-user"></i> Meu Perfil</a></li>
                                        @endif
                                        <li><a href="{{route("logout")}}" style="padding: 10px 20px;"><i class="fa fa-sign-out"></i> Sair</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!--logado-->
                            @else
                            <li class=""><a class="nav-item-child" href="{{ route('login.form') }}"><i class="fa fa-user" style="margin-right:4px"></i> LOGIN</a></li>
                            @endif
                            <li class="hidden-xs hidden-sm" style="padding-top: 15px; margin-left: 10px;"><a class="btn btn-primary anunciar" href="{{route('property.create')}}">ANUNCIAR IMÓVEIS</a></li>
                                <li class="hidden-md hidden-lg" style="margin-top: 10px; padding-bottom: 10px;"><a class="btn btn-primary anunciar" href="{{route('property.create')}}">ANUNCIAR IMÓVEIS</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Navbar Collapse -->


                    </div>
                </nav>
                <!-- Navbar -->
            </header>