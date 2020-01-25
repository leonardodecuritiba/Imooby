<div id="header">
    <div class="logo">
        <a href="{{route('index')}}">
            <img src="{{asset('assets_site/images/icone.png')}}" class="logo_pequeno hidden-xs"
                 style="width: 30px; margin-left: 18px; margin-top: 15px;">
            <img src="{{asset('assets_site/img/logo_branco_200x55.png')}}" class="logo_grande hidden-xs"
                 style="width: 140px; margin-left: 26px; margin-top: 15px;">
            <img src="{{asset('assets_site/images/icone.png')}}" class="hidden-sm hidden-md hidden-lg"
                 style="width: 30px; margin-left: 18px; margin-top: 4px;">
        </a>
    </div>
    <a href="#" class="navHandler"><span class="fa fa-bars"></span></a>
    <div class="search">
        <span class="searchIcon icon-magnifier"></span>
        <input type="text" style="width: 500px;" id="buscar" name="buscar" placeholder="Procure por cidade, bairro, região..."
               value="{{(Request::has('busca'))?Request::get('busca'):''}}" >
    </div>
    @if(\Auth::guest())
    <a href="{{ route('clients.beginForm') }}" class="btn btn-success hidden-xs hidden-sm" style="float: right;padding: 12px;margin: 9px;margin-right: 25px;">Crie sua conta!</a>
    @endif
    {{--User Menu--}}
    @role('client')
    <div class="headerUserWraper">
        {{--<a href="#" class="userHandler dropdown-toggle" data-toggle="dropdown"><span class="icon-user"></span><span--}}
        {{--class="counter">5</span></a>--}}
        <a href="#" class="headerUser dropdown-toggle" data-toggle="dropdown">
            <img class="avatar headerAvatar pull-left" src="{{Auth::user()->getThumbPhoto()}}" alt="John Smith">
            <div class="userTop pull-left">
                <span class="headerUserName">{{Auth::user()->getFullName()}}</span> <span
                        class="fa fa-angle-down"></span>
            </div>
            <div class="clearfix"></div>
        </a>
        <div class="dropdown-menu pull-right userMenu" role="menu">
            <div class="mobAvatar">
                <img class="avatar mobAvatarImg" src="{{Auth::user()->getThumbPhoto()}}" alt="John Smith">
                <div class="mobAvatarName">{{Auth::user()->getFullName()}}</div>
            </div>
            <ul>
                {{--<li><a href="#"><span class="icon-settings"></span>Configurações</a></li>--}}
                <li><a href="{{route('profile.my')}}"><span class="icon-user"></span>Perfil</a></li>
                {{--<li><a href="#"><span class="icon-bell"></span>Notificações <span--}}
                {{--class="badge pull-right bg-red">5</span></a></li>--}}
                <li class="divider"></li>
                <li><a href="{{route("logout")}}"><span class="icon-power"></span>Sair</a></li>
            </ul>
        </div>
    </div>
    @endrole

    {{--Notifications--}}
    {{--@role('client')--}}
    {{--<div class="headerNotifyWraper">--}}
    {{--<a href="#" class="headerNotify dropdown-toggle" data-toggle="dropdown">--}}
    {{--<span class="notifyIcon icon-bell"></span>--}}
    {{--<span class="counter">5</span>--}}
    {{--</a>--}}
    {{--<div class="dropdown-menu pull-right notifyMenu" role="menu">--}}
    {{--<div class="notifyHeader">--}}
    {{--<span>Notifications</span>--}}
    {{--<a href="#" class="notifySettings icon-settings"></a>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</div>--}}
    {{--<ul class="notifyList">--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<img class="avatar pull-left" src="assets_site/images/avatar-1.png" alt="John Smith">--}}
    {{--<div class="pulse border-grey"></div>--}}
    {{--<div class="notify pull-left">--}}
    {{--<div class="notifyName">Sed ut perspiciatis unde</div>--}}
    {{--<div class="notifyTime">5 minutes ago</div>--}}
    {{--</div>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<div class="notifyRound notifyRound-red fa fa-envelope-o"></div>--}}
    {{--<div class="pulse border-red"></div>--}}
    {{--<div class="notify pull-left">--}}
    {{--<div class="notifyName">Lorem Ipsum is simply dummy text</div>--}}
    {{--<div class="notifyTime">20 minutes ago</div>--}}
    {{--</div>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<div class="notifyRound notifyRound-yellow fa fa-heart-o"></div>--}}
    {{--<div class="pulse border-yellow"></div>--}}
    {{--<div class="notify pull-left">--}}
    {{--<div class="notifyName">It is a long established fact</div>--}}
    {{--<div class="notifyTime">2 hours ago</div>--}}
    {{--</div>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<div class="notifyRound notifyRound-magenta fa fa-paper-plane-o"></div>--}}
    {{--<div class="pulse border-magenta"></div>--}}
    {{--<div class="notify pull-left">--}}
    {{--<div class="notifyName">There are many variations</div>--}}
    {{--<div class="notifyTime">1 day ago</div>--}}
    {{--</div>--}}
    {{--<div class="clearfix"></div>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--<a href="#" class="notifyAll">See All</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endrole--}}

    <a href="#" class="mapHandler"><span class="icon-map"></span></a>
    <div class="clearfix"></div>
</div>