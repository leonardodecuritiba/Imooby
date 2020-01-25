<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-rocket"></i> <span>{{config('app.name')}}</span>
            </a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{Auth::user()->admin->getThumbPhoto()}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span> Seja bem vindo,</span>
                <h2>{{Auth::user()->admin->name}}</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <div class="clearfix"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>. . . . . . . . . . . . . . . . . . . . . . . . . . . </h3>
                <ul class="nav side-menu">
                    {{--@role('admin')--}}
                    <li><a><i class="fa fa-gavel"></i> Administradores <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admins.index')}}">Listar</a></li>
                            <li><a href="{{route('admins.create')}}">Cadastrar</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-building"></i> Tipos de Imóveis <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('properties_types.index')}}">Listar</a></li>
                            <li><a href="{{route('properties_types.create')}}">Cadastrar</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('clients.index')}}"><i class="fa fa-users"></i> Clientes</a></li>
                    <li><a href="{{route('properties.index')}}"><i class="fa fa-institution"></i> Imóveis</a></li>
                    <li><a href="{{route('configurations.index')}}"><i class="fa fa-cogs"></i> Configurações </a></li>
                    <li><a><i class="fa fa-calendar"></i> Visitas<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('visits.index')}}">Listar</a></li>
                            <li><a href="{{route('visits_status.index')}}">Status</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-calendar-o"></i> Negociações <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('negociations.index')}}">Listar</a></li>
                            <li><a href="{{route('status_negociations.index')}}">Status</a></li>
                            <li><a href="{{route('conditions.index')}}">Condições</a></li>
                        </ul>
                    </li>
                    {{--@endrole--}}
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{Auth::user()->admin->getThumbPhoto()}}" alt="">{{Auth::user()->admin->name}} <span
                                class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li><a href="{{route('admins.show',Auth::user()->admin->id)}}"> Perfil</a></li>
                        <li><a href="{{ url('logout') }}"> <span class="badge bg-red pull-right"><i
                                            class="fa fa-sign-out pull-right"></i></span>Sair</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>