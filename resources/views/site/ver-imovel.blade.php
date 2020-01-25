@extends('site.layouts.map.template')
@section('styles_content')
{{--     {{Html::style('assets_site/vendor/datetimepicker-master/build/jquery.datetimepicker.min.css')}} --}}
    <style type="text/css">
        .singleTop ul.features li {
            width: 25%;
        }

        @media screen and (max-width: 768px) {
            .singleTop ul.features li {
                width: 50%;
            }
        }

/*         .datepicker {
            z-index: 1151 !important;
        } */

		.offcanvas {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0,0,0,.9);
			z-index: 999999;
			display: none;
		}
		.car-img:hover {
			cursor: pointer;
		}
    </style>
@endsection
@section('modals_content')
    @include('site.layouts.modal.schedule')
@endsection
@section('body_content')
    <?php $count = $_SELF_TEMPLATE_['SimilarProperties']->count(); ?>
    <?php $SimilarProperties_lg = clone $_SELF_TEMPLATE_['SimilarProperties']; ?>
    <?php $SimilarProperties_md = clone $_SELF_TEMPLATE_['SimilarProperties']; ?>
    <?php $SimilarProperties_xs = clone $_SELF_TEMPLATE_['SimilarProperties']; ?>
    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')
    {{--{{($_SELF_TEMPLATE_['Property'])}}--}}
    <!-- Content -->

    <div class="offcanvas">
    	<div class="row">
    		<div class="col-sm-3 col-sm-offset-9 col-md-3 col-md-offset-9 text-right">
    			<a href="#" style="font-size: 15pt; padding: 10px" onclick="fecharOff()">
    				<i class="fa fa-close"></i> fechar
    			</a>
    		</div>
    	</div>
    	<div style="overflow-y: auto; margin: auto" class="text-center">
    		<img class="foto-off" style="max-height: 100vh; margin: auto; max-width: 100vw">
    	</div>
    </div>

    <div id="wrapper">
        <div id="mapView" class="mob-min" style="z-index: 99">
            <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Carregando Mapa...</div>
        </div>
        <div id="content" class="mob-max">
            <div class="singleTop">
                <div id="carouselFull" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($_SELF_TEMPLATE_['Property']->properties_photo as $key => $photoproperties)
                            <li data-target="#carouselFull" data-slide-to="{{$key}}"
                                @if($key==0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" style="height: 320px">
                        @foreach($_SELF_TEMPLATE_['Property']->properties_photo as $key => $photoproperties)
                            <div class="item {{($key==0)?'active':''}} text-center">
                                <img src="{{$photoproperties->getPhoto()}}" alt="First slide" style="height: 320px; margin: auto" onclick="showOff('{{ $photoproperties->getPhoto() }}')" class="car-img">
                                <div class="container">
                                    <div class="carousel-caption">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carouselFull" role="button" data-slide="prev"><span
                                class="fa fa-chevron-left"></span></a>
                    <a class="right carousel-control" href="#carouselFull" role="button" data-slide="next"><span
                                class="fa fa-chevron-right"></span></a>
                </div>
                <div class="summary">
                    <div class="row text">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="summaryItem">
                                <h1 class="pageTitle"
                                    style="font-weight: bold; font-size: 26px; margin-bottom: 10px; color: #00A7EC;">{{$_SELF_TEMPLATE_['Property']->priceTotalReal()}}</h1>
                                <h1 class="pageTitle">{{$_SELF_TEMPLATE_['Property']->name}}</h1>
                                <div class="address"><span
                                            class="icon-pointer"></span> {{$_SELF_TEMPLATE_['Property']->address->getFullAddress()}}
                                </div>
                                <div class="clearfix"></div>
                                <ul class="features">
                                    <li><span class="fa fa-moon-o" style="color: #00A7EC;"></span>
                                        <div style="margin-top: 5px;"><b>{{$_SELF_TEMPLATE_['Property']->bedroom_n}}</b>
                                            <br>Quartos
                                        </div>
                                    </li>
                                    <li><span class="icon-drop" style="color: #00A7EC;"></span>
                                        <div style="margin-top: 5px;">
                                            <b>{{$_SELF_TEMPLATE_['Property']->bathroom_n}}</b> <br>Banheiros
                                        </div>
                                    </li>
                                    <li><span class="fa fa-car" style="color: #00A7EC;"></span>
                                        <div style="margin-top: 5px;">
                                            <b>{{ $_SELF_TEMPLATE_['Property']->garage_n }}</b> <br>Vagas
                                        </div>
                                    </li>
                                    <li><span class="icon-frame" style="color: #00A7EC;"></span>
                                        <div style="margin-top: 5px;">
                                            <b>{{$_SELF_TEMPLATE_['Property']->getInternalArea()}}</b> <br>Área Útil
                                        </div>
                                    </li>
                                    {{-- <li><span class="icon-frame" style="color: #00A7EC;"></span>
                                        <div style="margin-top: 5px;">
                                            <b>{{$_SELF_TEMPLATE_['Property']->getExternalArea()}}</b> <br>Área Externa
                                        </div>
                                    </li> --}}
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="agentAvatar summaryItem">
                                <div class="clearfix"></div>
                                <img class="avatar agentAvatarImg"
                                     src="{{$_SELF_TEMPLATE_['Property']->owner->getThumbPhoto()}}" alt="avatar">
                                <div class="agentName">{{$_SELF_TEMPLATE_['Property']->owner->name}}</div>
                                <a @if((!Auth::check()) || (Auth::user()->id == $_SELF_TEMPLATE_['Property']->owner->user->id))
                                        href="{{ route('login.form') }}"
                                        @else
                                        data-toggle="modal" href="#modal_agendar"
                                        @endif
                                        class="btn btn-lg btn-round btn-success contactBtn"
                                        style="border-radius: 0px; font-weight: bold;"> <i class="fa fa-calendar"></i> Agendar Visita</a>
                                @if(Auth::guest())
                                    <a
                                        href="{{ route('login.form') }}"
                                        class="btn btn-lg btn-round btn-danger contactBtn"
                                        style="border-radius: 0px; font-weight: bold;"
                                    >
                                        <i class="fa fa-heart"></i> Favoritar
                                    </a>
                                @elseif(Auth::user()->client)
                                    @if(!in_array($_SELF_TEMPLATE_['Property']->id, Auth::user()->client->favoritesArray()))
                                        <a
                                            href="{{ route('property.like',  $_SELF_TEMPLATE_['Property']->id) }}"
                                            class="btn btn-lg btn-round btn-danger contactBtn"
                                            style="border-radius: 0px; font-weight: bold;"
                                        >
                                            <i class="fa fa-heart"></i> Favoritar
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('property.unlike',  $_SELF_TEMPLATE_['Property']->id) }}"
                                            class="btn btn-lg btn-round btn-warning contactBtn"
                                            style="border-radius: 0px; font-weight: bold;"
                                        >
                                            <i class="fa fa-heart"></i> Desmarcar
                                        </a>
                                    @endif
                                @endif
        <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="painel">
                <div class="description">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <h3>Valor Aluguel</h3>
                            <p style="color: #00A7EC; font-weight: bold;">{{$_SELF_TEMPLATE_['Property']->priceRentalReal()}}</p>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <h3>Valor Condomínio</h3>
                            <p style="color: #00A7EC; font-weight: bold;">{{$_SELF_TEMPLATE_['Property']->priceCondominiumReal()}}</p>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <h3>Valor IPTU</h3>
                            <p style="color: #00A7EC; font-weight: bold;">{{$_SELF_TEMPLATE_['Property']->priceIptuReal()}}</p>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <h3>Taxa de Serviço</h3>
                            <p style="color: #00A7EC; font-weight: bold;">{{$_SELF_TEMPLATE_['Property']->priceFeeReal()}}</p>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <h3>Descrição</h3>
                    <p>{{$_SELF_TEMPLATE_['Property']->description}}</p>
                </div>
                <div class="description">
                    <h3>Favorito de </h3>
                    <p>{{$_SELF_TEMPLATE_['Property']->countFavorites()}} usuários</p>
                </div>
                <div class="amenities">
                    <h3>Caracteristicas</h3>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->reception)?'inactive':''}}">
                            <span class="fa fa-shield"></span> Portaria
                            24 horas
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->air_conditioning)?'inactive':''}}">
                            <span class="fa fa-sun-o"></span>
                            Ar Condicionado
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->outdoor_pool)?'inactive':''}}">
                            <span class="fa fa-tint"></span>
                            Piscina
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->garden)?'inactive':''}}">
                            <span class="fa fa-leaf"></span> Jardim
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->fireplace)?'inactive':''}}"><span
                                    class="fa fa-first-order"></span> Lareira
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->animals)?'inactive':''}}">
                            <span class="fa fa-paw"></span> Aceita Pets
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->playground)?'inactive':''}}">
                            <span class="fa fa-gamepad"></span>
                            Playground
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->hydro)?'inactive':''}}">
                            <span class="fa fa-bath"></span> Banheira
                            Hidro
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->grill)?'inactive':''}}">
                            <span class="fa fa-cutlery"></span>
                            Churrasqueira
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->laundry)?'inactive':''}}">
                            <span class="fa fa-shower"></span>
                            Lavanderia
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->furnished)?'inactive':''}}">
                            <span class="fa fa-home"></span> Mobiliado
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 amItem {{(!$_SELF_TEMPLATE_['Property']->suite)?'inactive':''}}">
                            <span class="fa fa-bed"></span> Suite
                        </div>
                    </div>
                </div>
                @if($count > 0)
                    <div class="similar">
                        <h3>Imóveis Similares ({{$count}})</h3>

                        <!-- carousel for medium & large devices -->
                        <div id="carouselSimilar-1" class="carousel slide visible-lg carousel-col">
                            <ol class="carousel-indicators">
                                @for($i=0; $i<ceil($count/3);$i++)
                                    <li data-target="#carouselSimilar-1" data-slide-to="{{$key}}"
                                        @if($i==0) class="active" @endif></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="row">
                                        @foreach($_SELF_TEMPLATE_['SimilarProperties']->take(3)->get() as $property)
                                            <div class="col-xs-4">
                                                <a href="{{route('ver-imovel',$property->id)}}" class="card">
                                                    <div class="figure">
                                                        <img src="{{$property->getThumbMainPhoto()}}" alt="image" height="100%" width="auto">
                                                        <div class="figCaption">
                                                            <div>{{$property->priceTotalReal()}}</div>
                                                        </div>
                                                        <div class="figView"><span class="icon-eye"></span></div>
                                                    </div>
                                                    <h2>{{$property->name}}</h2>
                                                    <div class="cardAddress"><span
                                                                class="icon-pointer"></span> {{$property->address->getFullAddress()}}
                                                    </div>
                                                    <ul class="cardFeat">
                                                        <li><span class="fa fa-moon-o"></span> {{$property->bedroom_n}}</li>
                                                        <li><span class="icon-drop"></span> {{$property->bathroom_n}}</li>
                                                        <li>
                                                            <span class="icon-frame"></span> {{$property->getInternalArea()}}
                                                        </li>
                                                        <li>
                                                            <span class="icon-heart"></span> {{$property->countFavorites()}}
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($count > 3)
                                    <div class="item">
                                        <div class="row">
                                            @foreach($SimilarProperties_lg->skip(3)->take(3)->get() as $property)
                                                <div class="col-xs-4">
                                                    <a href="{{route('ver-imovel',$property->id)}}" class="card">
                                                        <div class="figure">
                                                            <img src="{{$property->getThumbMainPhoto()}}" alt="image">
                                                            <div class="figCaption">
                                                                <div>{{$property->priceTotalReal()}}</div>
                                                            </div>
                                                            <div class="figView"><span class="icon-eye"></span></div>
                                                        </div>
                                                        <h2>{{$property->name}}</h2>
                                                        <div class="cardAddress"><span
                                                                    class="icon-pointer"></span> {{$property->address->getFullAddress()}}
                                                        </div>
                                                        <ul class="cardFeat">
                                                            <li><span class="fa fa-moon-o"></span> {{$property->bedroom_n}}
                                                            </li>
                                                            <li><span class="icon-drop"></span> {{$property->bathroom_n}}
                                                            </li>
                                                            <li>
                                                                <span class="icon-frame"></span> {{$property->getInternalArea()}}
                                                            </li>
                                                        </ul>
                                                        <div class="clearfix"></div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($count > 3)
                                <a class="left carousel-control" href="#carouselSimilar-1" role="button"
                                   data-slide="prev"><span
                                            class="fa fa-chevron-left"></span></a>
                                <a class="right carousel-control" href="#carouselSimilar-1" role="button"
                                   data-slide="next"><span
                                            class="fa fa-chevron-right"></span></a>
                            @endif
                        </div>

                        <!-- carousel for small devices -->
                        <div id="carouselSimilar-2" class="carousel slide visible-md carousel-col">
                            <ol class="carousel-indicators">
                                @for($i=0; $i<ceil($count/2);$i++)
                                    <li data-target="#carouselSimilar-2" data-slide-to="{{$i}}"
                                        @if($i==0) class="active" @endif></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="row">
                                        @foreach($SimilarProperties_md->take(2)->get() as $property)
                                            <div class="col-xs-6">
                                                <a href="{{route('ver-imovel',$property->id)}}" class="card">
                                                    @include('site.properties.single_property')
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($count > 2)
                                    <div class="item">
                                        <div class="row">
                                            @foreach($_SELF_TEMPLATE_['SimilarProperties']->skip(2)->take(2)->get() as $property)
                                                <div class="col-xs-6">
                                                    <a href="{{route('ver-imovel',$property->id)}}" class="card">
                                                        @include('site.properties.single_property')
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($count > 4)
                                    <div class="item">
                                        <div class="row">
                                            @foreach($_SELF_TEMPLATE_['SimilarProperties']->skip(4)->take(2)->get() as $property)
                                                <div class="col-xs-6">
                                                    <a href="{{route('ver-imovel',$property->id)}}" class="card">
                                                        @include('site.properties.single_property')
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div><!-- carousel-inner -->
                            @if($count > 2)
                                <a class="left carousel-control" href="#carouselSimilar-2" role="button"
                                   data-slide="prev"><span
                                            class="fa fa-chevron-left"></span></a>
                                <a class="right carousel-control" href="#carouselSimilar-2" role="button"
                                   data-slide="next"><span
                                            class="fa fa-chevron-right"></span></a>
                            @endif
                        </div>

                        <!-- carousel for extra-small devices -->
                        <div id="carouselSimilar-3" class="carousel slide visible-xs visible-sm carousel-col">
                            <ol class="carousel-indicators">
                                @for($i=0; $i<$count;$i++)
                                    <li data-target="#carouselSimilar-3" data-slide-to="{{$i}}"
                                        @if($i==0) class="active" @endif></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                @foreach($SimilarProperties_xs->get() as $key => $property)
                                    <div class="item @if($key==0) active @endif">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a href="{{route('ver-imovel',$property->id)}}" class="card">
                                                    @include('site.properties.single_property')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($count > 1)
                                <a class="left carousel-control" href="#carouselSimilar-3" role="button"
                                   data-slide="prev"><span
                                            class="fa fa-chevron-left"></span></a>
                                <a class="right carousel-control" href="#carouselSimilar-3" role="button" data-slide="next"><span
                                            class="fa fa-chevron-right"></span></a>
                            @endif
                        </div>
                    </div>
            @endif
                </div>
            <!--<div class="comments">
                <h3><span>4</span> Comments</h3>
                <div class="comment">
                    <div class="commentAvatar">
                        <img class="avatar" src="assets_site/images/avatar-3.png" alt="avatar">
                        <div class="commentArrow"><span class="fa fa-caret-left"></span></div>
                    </div>
                    <div class="commentContent">
                        <div class="commentName">Rust Cohle</div>
                        <div class="commentBody">
                            It is a long established fact that a reader will be distracted by the readable content
                        </div>
                        <div class="commentActions">
                            <div class="commentTime"><span class="icon-clock"></span> 1 day ago</div>
                            <ul>
                                <li><a href="#"><span class="icon-action-undo"></span></a></li>
                                <li><a href="#"><span class="icon-like"></span> 13</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="comment reply">
                    <div class="commentAvatar">
                        <img class="avatar" src="assets_site/images/avatar-1.png" alt="avatar">
                        <div class="commentArrow"><span class="fa fa-caret-left"></span></div>
                    </div>
                    <div class="commentContent">
                        <div class="commentName">John Smith</div>
                        <div class="commentBody">
                            Comment posted by me. I have the power to remove it.
                        </div>
                        <div class="commentActions">
                            <div class="commentTime"><span class="icon-clock"></span> 2 hours ago</div>
                            <ul>
                                <li><a href="#"><span class="fa fa-trash-o"></span></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="comment">
                    <div class="commentAvatar">
                        <img class="avatar" src="assets_site/images/avatar-5.png" alt="avatar">
                        <div class="commentArrow"><span class="fa fa-caret-left"></span></div>
                    </div>
                    <div class="commentContent">
                        <div class="commentName">Alex Rogers</div>
                        <div class="commentBody">
                            Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit
                        </div>
                        <div class="commentActions">
                            <div class="commentTime"><span class="icon-clock"></span> 20 minutes ago</div>
                            <ul>
                                <li><a href="#"><span class="icon-action-undo"></span></a></li>
                                <li><a href="#"><span class="icon-like"></span> 13</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="comment">
                    <div class="commentAvatar">
                        <img class="avatar" src="assets_site/images/avatar-2.png" alt="avatar">
                        <div class="commentArrow"><span class="fa fa-caret-left"></span></div>
                    </div>
                    <div class="commentContent">
                        <div class="commentName">Jane Smith</div>
                        <div class="commentBody">
                            Lorem ipsum dolor sit amet, consecteter adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
                        </div>
                        <div class="commentActions">
                            <div class="commentTime"><span class="icon-clock"></span> 5 minutes ago</div>
                            <ul>
                                <li><a href="#"><span class="icon-action-undo"></span></a></li>
                                <li><a href="#"><span class="icon-like"></span> 13</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>-->
        </div>
        <div class="commentsFormWrapper">
            <div class="cfAvatar">
                <img class="avatar" src="{{asset('assets_site/images/avatar-1.png')}}" alt="avatar">
            </div>
            <form class="commentsForm">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Write a comment...">
                    <span class="input-group-btn"><a class="btn btn-green">Post</a></span>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
@section('scripts_content')
    {{-- {{Html::script('assets_site/vendor/datetimepicker-master/build/jquery.datetimepicker.full.min.js')}} --}}
    <script type="text/javascript">
        // 	jQuery.datetimepicker.setLocale('pt-BR');
        var availableDates = [{!! $_SELF_TEMPLATE_['Property']->getJsDaysForSchedule() !!}];
        function fecharOff() {
        	$('.offcanvas').hide('fast');
        }
        function showOff(foto) {
        	$('.foto-off').prop('src', foto);
        	$('.offcanvas').show('fast');
        }
        $(document).ready(function () {
            $('.available-dates').datepicker({
                container:'#modal_agendar',
                language: 'pt-BR',
                startDate: 'today',
                beforeShowDay: function(date){ 
                    dmy = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
                if ($.inArray(dmy, availableDates) == -1) {
                    return false;
                }
                return; }
        }).on('changeDate', function(e) {
            var date = e.date; 
            changeAvailableTime(date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate());
        });
        });
        function changeAvailableTime(date) {
            $('.available-times').html('<option>Carregando...</option>');
            $('.available-times').load('{!! route('scheduler.gettimes', $_SELF_TEMPLATE_['Property']->id) !!}?date='+date);
        }
    </script>
    @include('site.layouts.map.leafletjs')
    @include('site.layouts.map.mapjs')
    <script type="text/javascript">
        var address = document.getElementById('buscar');
        $(document).ready(function () {
            // functionality for autocomplete address field

            var autocomplete = new google.maps.places.Autocomplete(address, {
                types: ['geocode'],
                componentRestrictions: {country:'BR'}
            });
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                console.log('blah')
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
                var pos = place.geometry.location;
                var location = "<input type='text' name='lat' value='" + pos.lat() + "'>";
                location += "<input type='text' name='lng' value='" + pos.lng() + "'>";
                $('{{Form::open(['route' =>'buscar-imoveis', 'method' => 'GET'])}}')
                    .append("<input type='text' name='busca' value='" + address.value + "'>")
                    .append(location)
                    .append("{{Form::close()}}")
                    .appendTo('body').submit();
                return false;
            });
        });
    </script>
    <script>
        var $_MAIN_PROPERTY_JSON_ = <?php echo(json_encode($_SELF_TEMPLATE_['Property']->getInfoBoxData())); ?>;
        var $_PROPERTIES_JSON_ = <?php echo($_SELF_TEMPLATE_['SimilarPropertiesInfoBox']); ?>;
        $(document).ready(function () {
            $('body').removeClass('notransition');

            map = L.map('mapView').setView([parseFloat($_MAIN_PROPERTY_JSON_.position.lat), parseFloat($_MAIN_PROPERTY_JSON_.position.lng)], 15);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.emerald',
    accessToken: 'pk.eyJ1IjoiaWdvcjg0IiwiYSI6ImNqNHlkeTkweTFwNXkyd3BsOTl0d2dkdXIifQ.A827kJGgvatGm0hYY7IBYQ'}).addTo(map);

            setMainMarker($_MAIN_PROPERTY_JSON_, map);
            setMultiMarkers($_PROPERTIES_JSON_, map);
            prepareMarkerCluster(map);

            // Add the circle for this city to the map.
            //centralizando o mapa
//
//            google.maps.event.addListener(marker, 'mouseup', function () {
//                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
//                    if (status == google.maps.GeocoderStatus.OK) {
//                        if (results[0]) {
//                            pos = {
//                                lat: marker.getPosition().lat(),
//                                lng: marker.getPosition().lng()
//                            };
//                            setMarkerMapcenter(pos, map);
//                            setLayoutAddress(pos, results[0]);
//                        }
//                    }
//                });
//            });
        });
    </script>
@endsection