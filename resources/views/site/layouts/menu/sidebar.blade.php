<div id="leftSide" style="position: fixed;">
    @role('client')
    <style type="text/css">
        .menu_ativo {
            background-color: #0582b6;
        }
    </style>
    <nav class="leftNav scrollable">
        <div class="search">
            <span class="searchIcon icon-magnifier"></span>
            <input type="text" placeholder="Buscar por casas, apartamentos ...">
            <div class="clearfix"></div>
        </div>

        <ul>
            <li @if(Route::currentRouteName()=='buscar-imoveis') class="menu_ativo" @endif>
                <a href="{{route('buscar-imoveis')}}"><span class="navIcon icon-compass"></span>
                    <span class="navLabel" style="display: none;">Pesquisar Imóvel</span></a></li>
            <li @if(Route::currentRouteName()=='property.create') class="menu_ativo" @endif>
                <a href="{{route('property.create')}}"><span class="navIcon icon-plus"></span>
                    <span class="navLabel" style="display: none;">Cadastrar Imóvel</span></a></li>
            <li @if(Route::currentRouteName()=='profile.properties') class="menu_ativo" @endif>
                <a href="{{route('profile.properties')}}"><span class="navIcon icon-home"></span>
                    <span class="navLabel" style="display: none;">Meus Imóveis</span></a></li>
            <li @if(Route::currentRouteName()=='profile.favorites') class="menu_ativo" @endif>
                <a href="{{route('profile.favorites')}}"><span class="navIcon icon-heart"></span>
                    <span class="navLabel" style="display: none;">Imóveis favoritos</span></a></li>
            <li @if(Route::currentRouteName()=='profile.schedules') class="menu_ativo" @endif>
                <a href="{{route('profile.schedules')}}"><span class="navIcon icon-list"></span>
                    <span class="navLabel" style="display: none;">Agendamentos</span></a></li>
            <li @if(Route::currentRouteName()=='profile.negociations') class="menu_ativo" @endif>
                <a href="{{route('profile.negociations')}}"><span class="navIcon fa fa-money"></span>
                    <span class="navLabel" style="display: none;">Negociações</span></a></li>
            <li @if(Route::currentRouteName()=='profile.my') class="menu_ativo" @endif>
                <a href="{{route('profile.my')}}"><span class="navIcon icon-user"></span>
                    <span class="navLabel" style="display: none;">Perfil</span></a>
            </li>
            <!--
            <li class="hasSub">
                <a href="#"><span class="navIcon icon-drop"></span><span class="navLabel" style="display: none;">Colors</span><span class="fa fa-angle-left arrowRight"></span><span class="badge bg-yellow">5</span></a>
                <ul class="colors">
                    <li><a href="#">Red <span class="fa fa-circle-o c-red icon-right"></span></a></li>
                    <li><a href="#">Green <span class="fa fa-circle-o c-green icon-right"></span></a></li>
                    <li><a href="#">Blue <span class="fa fa-circle-o c-blue icon-right"></span></a></li>
                    <li><a href="#">Yellow <span class="fa fa-circle-o c-yellow icon-right"></span></a></li>
                    <li><a href="#">Magenta <span class="fa fa-circle-o c-magenta icon-right"></span></a></li>
                </ul>
            </li>
            -->
        </ul>
    </nav>
    @endrole
</div>
<div class="closeLeftSide"></div>