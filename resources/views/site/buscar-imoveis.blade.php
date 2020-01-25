@extends('site.layouts.map.template')
@section('styles_content')
    <style>
        .loading {
            height:100%;
            background: #fff url("{{asset('assets_admin/imgs/ajax-loader.gif')}}") no-repeat center center !important;
        }
        .esconde {
            display: none;
        }
    </style>
@endsection
@section('body_content')
@include('site.layouts.map.leafletjs')
    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')

    <!-- Content -->
    <div id="wrapper">
        <div id="mapView" style="z-index: 15;">
            <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Carregando Mapa...</div>
        </div>
        <div id="content">
            <section class="results">
                <div class="filter">
                    <h1 class="osLight">Filtrar resultado <b style="font-style: italic;"></b></h1>
                    <a href="#" class="handleFilter"><span class="icon-equalizer"></span></a>
                    <div class="clearfix"></div>
                    <form class="filterForm">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                                <div class="formField">
                                    <label>Valor Aluguel</label>
                                    <div class="slider priceSlider">
                                        <div class="sliderTooltip">
                                            <div class="stArrow"></div>
                                            <div class="stLabel"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
                                <div class="formField">
                                    <label>Área útil</label>
                                    <div class="slider areaSlider">
                                        <div class="sliderTooltip">
                                            <div class="stArrow"></div>
                                            <div class="stLabel"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 formItem">
                                <div class="formField">
                                    <label>Quartos</label>
                                    <select class="form-control" name="bedrooms" style="padding-top: 8px; padding-bottom: 8px;">
                                        <option value="">Selecione</option>
                                    </select>
                                    {{--<div class="volume" id="bedrooms">--}}
                                        {{--<a href="#" class="btn btn-gray btn-round-left" data-min="0"><span--}}
                                                    {{--class="fa fa-angle-left"></span></a>--}}
                                        {{--<input type="text" class="form-control" readonly="readonly" value="0">--}}
                                        {{--<a href="#" class="btn btn-gray btn-round-right" data-max="0"><span--}}
                                                    {{--class="fa fa-angle-right"></span></a>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 formItem">
                                <div class="formField">
                                    <label>Banheiros</label>
                                    <select class="form-control" name="bathrooms" style="padding-top: 8px; padding-bottom: 8px;">
                                        <option value="">Selecione</option>
                                    </select>
                                    {{--<div class="volume" id="bathrooms">--}}
                                        {{--<a href="#" class="btn btn-gray btn-round-left" data-min="0"><span--}}
                                                    {{--class="fa fa-angle-left"></span></a>--}}
                                        {{--<input type="text" class="form-control" readonly="readonly" value="0">--}}
                                        {{--<a href="#" class="btn btn-gray btn-round-right" data-max="0"><span--}}
                                                    {{--class="fa fa-angle-right"></span></a>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 formItem">
                                <div class="formField">
                                    <label>Vagas</label>
                                    <select class="form-control" name="garages" style="padding-top: 8px; padding-bottom: 8px;">
                                        <option value="">Selecione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 formItem">
                                <div class="formField">
                                    <label>Tipo</label>
                                    <select class="form-control" name="property_type" style="padding-top: 8px; padding-bottom: 8px;">
                                        <option value="">Selecione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="reception"><span class="fa fa-check"></span> Portaria 24 horas</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="air_conditioning"><span class="fa fa-check"></span> Ar Condicionado</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="outdoor_pool"><span class="fa fa-check"></span> Piscina</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="garden"><span class="fa fa-check"></span> Jardim</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="fireplace"><span class="fa fa-check"></span> Lareira</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="animals"><span class="fa fa-check"></span> Aceita Pets</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="playground"><span class="fa fa-check"></span> Playground</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="hydro"><span class="fa fa-check"></span> Banheira Hidro</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="grill"><span class="fa fa-check"></span> Churrasqueira</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="laundry"><span class="fa fa-check"></span> Lavanderia</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="furnished"><span class="fa fa-check"></span> Mobiliado</label></div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="checkbox custom-checkbox"><label>
                                <input type="checkbox" class="onfilter" name="suite"><span class="fa fa-check"></span> Suite</label></div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="resultsList">
                    <div class="loading" style="height: 100px"></div>
                    <!-- Div quando o resultado for null-->
                    <div class="row no-results esconde" style="background-color: #fff; margin-bottom: 10px;">
                        <div class="col-md-12 text-center">
                            <h2 style="font-weight: bold; color: #00A7EC">Ops!</h2>
                            <h5 style="color: #00A7EC; padding-bottom: 10px;">
                                Infelizmente não encontramos nenhum imóvel com as características que você buscou.<br>
                                Tente diminuir o número de filtros para ter um busca mais abrangente.
                            </h5>
                        </div>
                    </div>
                    <!-- Div quando o resultado for null-->
                    <div class="row results esconde">
                        {{--@foreach($_SELF_TEMPLATE_['Properties'] as $property)--}}
                            {{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">--}}
                                {{--<a href="{{route('ver-imovel',$property['id'])}}" class="card">--}}
                                    {{--<div class="figure">--}}
                                        {{--<img src="{{$property['thumb_main_photo']}}" alt="image">--}}
                                        {{--<div class="figCaption">--}}
                                            {{--<div>{{$property['price_total_money']}}</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="figView"><span class="icon-eye"></span></div>--}}
                                    {{--</div>--}}
                                    {{--<h2>{{$property['description']}}</h2>--}}
                                    {{--<div class="cardAddress"><span--}}
                                                {{--class="icon-pointer"></span> {{$property['full_address']}}</div>--}}
                                    {{--<ul class="cardFeat">--}}
                                        {{--<li><span class="fa fa-moon-o"></span> {{$property['bedrooms']}}</li>--}}
                                        {{--<li><span class="icon-drop"></span> {{$property['bathrooms']}}</li>--}}
                                        {{--<li><span class="icon-frame"></span> {{$property['internal_area_formated']}}</li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="clearfix"></div>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    </div>

                    {{--<ul class="pagination">--}}
                        {{--<li class="disabled"><a href="#"><span class="fa fa-angle-left"></span></a></li>--}}
                        {{--<li class="active"><a href="#">1</a></li>--}}
                        {{--<li><a href="#">2</a></li>--}}
                        {{--<li><a href="#">3</a></li>--}}
                        {{--<li><a href="#">4</a></li>--}}
                        {{--<li><a href="#">5</a></li>--}}
                        {{--<li><a href="#"><span class="fa fa-angle-right"></span></a></li>--}}
                    {{--</ul>--}}
                </div>
            </section>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection
@section('scripts_content')
    <script type="text/javascript">

        var $_RESULTS_JSON_ORIGINAL_ = [];
        var $_FILTERS_ = {};
        var $_FILTERS_LAYOUT_ = {};
        var $_PROPS = {};
        var _N_IMOVEIS_ = 0;
        var viewportBox;
    </script>
    @include('site.layouts.map.mapjs')
        <script type="text/javascript">
        var address = document.getElementById('buscar');
        $(document).ready(function () {
            @if(Request::has('lat') && Request::has('lng'))
            map = L.map('mapView').setView([parseFloat('{{Request::get('lat')}}'), parseFloat('{{Request::get('lng')}}')], 15);
            @else
            map = L.map('mapView').setView([$_GLOBAL_MAPS_API_['positions'].lat, $_GLOBAL_MAPS_API_['positions'].lng], 15);
            @endif
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.emerald',
    accessToken: 'pk.eyJ1IjoiaWdvcjg0IiwiYSI6ImNqNHlkeTkweTFwNXkyd3BsOTl0d2dkdXIifQ.A827kJGgvatGm0hYY7IBYQ'}).addTo(map);
            loadProperties(map);
            map.on('move', function() {
                if(typeof(callLoad)!='undefined'){
                    clearTimeout(callLoad);
                }
                callLoad = window.setTimeout(function(){
                loadProperties(map);
            },500);
            });
            prepareMarkerCluster(map);
            // functionality for autocomplete address field
            $(".onfilter").change(function() {
                if($(this).is(':checked')) {
                    $_PROPS[$(this).attr('name')] = 1;
                    refreshFilterLayoutProperties();
                } else {
                    delete $_PROPS[$(this).attr('name')];
                    refreshFilterLayoutProperties();
                }
            });
            var autocomplete = new google.maps.places.Autocomplete(address, {
                types: ['geocode'],
                componentRestrictions: {country:'BR'}
            });
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
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

    <script type="text/javascript">
        function property_layout(property){
            var URL_ = "{{route('ver-imovel','XX')}}";
            URL_ = URL_.replace('XX',property.id)
            return '<div id="property[' + property.id + ']" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">'+
                    '<a href="' + URL_ + '" class="card">'+
                        '<div class="figure" style="background-image:url('+property.thumb_main_photo+');background-repeat: no-repeat;  background-size: cover;background-position: 0 0;">'+
                        '<div class="figCaption">'+
                        '<div>' + property.price_total_money + '</div>'+
                        '</div>'+
                        '<div class="figView"><span class="icon-eye"></span></div>'+
                        '</div>'+
                        '<h2>' + property.description + '</h2>'+
                        '<div class="cardAddress"><span class="icon-pointer"></span> ' + property.full_address + '</div>'+
                        '<ul class="cardFeat">'+
                        '<li><span class="fa fa-moon-o"></span> ' + property.bedrooms + '</li>'+
                        '<li><span class="icon-drop"></span> ' + property.bathrooms + '</li>'+
                        '<li><span class="icon-frame"></span> ' + property.internal_area_formated + '</li>'+
                        '<li><span class="icon-heart"></span> ' + property.favorites + '</li>'+
                        '</ul>'+
                        '<div class="clearfix"></div>'+
                    '</a>'+
                '</div>';
        }
    </script>

    <script type="text/javascript">

        @if(Request::has('lat'))
            var _CENTER_POSITION_ = {};
            _CENTER_POSITION_.lat = parseFloat('{{Request::get('lat')}}');
            _CENTER_POSITION_.lng = parseFloat('{{Request::get('lng')}}');
        @else
            var _CENTER_POSITION_ = $_GLOBAL_MAPS_API_['positions'];
        @endif

        function onLoading(state){
            var $parent = $('div.resultsList');
            switch(state){
                case 'load':
                    $($parent).find(".loading").show();
                    $($parent).find(".results").hide();
                    $($parent).find(".no-results").hide();
                    break;
                case 'no-results':
                    $($parent).find(".no-results").show();
                    $($parent).find(".loading").hide();
                    $($parent).find(".results").hide();
                    break;
                case 'results':
                    $($parent).find(".results").show();
                    $($parent).find(".loading").hide();
                    $($parent).find(".no-results").hide();
                    break;
            }
        }

        //Layout updates
        function updateLayoutBedroom(bedroom){
            var max = parseFloat(bedroom.max);
            var min = parseFloat(bedroom.min);
            if($.isNumeric(min)){
                $('select[name=bedrooms]').html($('<option>', {value:'', text:'Selecione'}));
                for(var x=min;x<=max;x++){
                    if($_FILTERS_LAYOUT_.bedrooms == x){
                        $('select[name=bedrooms]').append($('<option>', {value:x, text:x + '+', selected:true}));
                    } else {
                        $('select[name=bedrooms]').append($('<option>', {value:x, text:x + '+'}));
                    }
                }

            }
        }

        function updateLayoutBathroom(bathroom){
            var min = parseFloat(bathroom.min);
            var max = parseFloat(bathroom.max);
            if($.isNumeric(min)){
                $('select[name=bathrooms]').html($('<option>', {value:'', text:'Selecione'}));
                for(var x=min;x<=max;x++){
                    if($_FILTERS_LAYOUT_.bathrooms == x){
                        $('select[name=bathrooms]').append($('<option>', {value:x, text:x + '+', selected:true}));
                    } else {
                        $('select[name=bathrooms]').append($('<option>', {value:x, text:x + '+'}));
                    }
                }
            }
        }

        function updateLayoutGarage(garage){
            var min = parseFloat(garage.min);
            var max = parseFloat(garage.max);
            if($.isNumeric(min)){
                $('select[name=garages]').html($('<option>', {value:'', text:'Selecione'}));
                var to_show;
                for(var x=min;x<=max;x++){
                    to_show = x + '+';
                    if(x==0) {
                        to_show = 'Nenhuma';
                    }
                    if($_FILTERS_LAYOUT_.bathrooms == x){
                        $('select[name=garages]').append($('<option>', {value:x, text:to_show, selected:true}));
                    } else {
                        $('select[name=garages]').append($('<option>', {value:x, text:to_show}));
                    }
                }
            }
        }

        function updateLayoutType(type){
            $('select[name=property_type]').html($('<option>', {value:'', text:'Selecione'}));
            $(type[0]).each(function(i,v){
                if($_FILTERS_LAYOUT_.type == v.id){
                    $('select[name=property_type]').append($('<option>', {value:v.id, text:v.description, selected:true}));
                } else {
                    $('select[name=property_type]').append($('<option>', {value:v.id, text:v.description}));
                }
            })
            return true;
//            $('.areaSlider').slider( "option", "min", min );
        }

        function updateLayoutPrice(rental){
            var max = parseFloat(rental.max);
            var min = parseFloat(rental.min);
//            var dif = parseFloat((max - min)/4);
//            var range = [(min+dif).toFixed(2), (max-dif).toFixed(2)];
            var range = [min.toFixed(2), max.toFixed(2)];
            $_FILTERS_LAYOUT_.rental = null;
            $('.priceSlider').slider( "option", "min", min );
            $('.priceSlider').slider( "option", "max", max );
            $('.priceSlider').slider( "option", "values", range );
            $('.priceSlider .sliderTooltip .stLabel').html(
                'R$ ' + range[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") +
                ' <span class="fa fa-arrows-h"></span> ' +
                'R$ ' + range[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            );
        }

        function updateLayoutArea(internal_area){
            var max = parseFloat(internal_area.max);
            var min = parseFloat(internal_area.min);
//            var dif = parseFloat((max - min)/4);
//            var range = [(min+dif).toFixed(2), (max-dif).toFixed(2)];
            var range = [min.toFixed(2), max.toFixed(2)];
            $_FILTERS_LAYOUT_.internal_area = null;
            $('.areaSlider').slider( "option", "min", min );
            $('.areaSlider').slider( "option", "max", max );
            $('.areaSlider').slider( "option", "values", range );
            $('.areaSlider .sliderTooltip .stLabel').html(
                range[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' m²' +
                ' <span class="fa fa-arrows-h"></span> ' +
                range[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' m²'
            );
        }

        function filterProperty(prop){
            //rental
            if($_FILTERS_LAYOUT_.rental != null){
                if((prop.price_total < $_FILTERS_LAYOUT_.rental[0]) || (prop.price_total > $_FILTERS_LAYOUT_.rental[1])){
                    return false;
                }
            }

            //internal_area
            if($_FILTERS_LAYOUT_.internal_area != null){
                if((prop.internal_area < $_FILTERS_LAYOUT_.internal_area[0]) || (prop.internal_area > $_FILTERS_LAYOUT_.internal_area[1])){
                    return false;
                }
            }

            //bedrooms
            if(prop.bedrooms < $_FILTERS_LAYOUT_.bedrooms){
                return false;
            }

            // garages
            if(prop.garages < $_FILTERS_LAYOUT_.garages){
                return false;
            }

            //bathrooms
            if(prop.bathrooms < $_FILTERS_LAYOUT_.bathrooms){
                return false;
            }

            var allprops = true;
            $.each($_PROPS, function(key, val){

                if(prop.props[key]!=1) {
                    allprops = false;
                }
            });
            if(!allprops) {
                return false;
            }

            if((typeof $_FILTERS_LAYOUT_.type != 'undefined') && ($_FILTERS_LAYOUT_.type != '') && (prop.idproperties_type != $_FILTERS_LAYOUT_.type)){
                return false;
            }
            return true;
        }

        function filterLayoutProperties(refresh = false){
            _N_IMOVEIS_ = 0;
            if(refresh) {
                deleteMarkers();
                prepareMarkerCluster(map);
            }
            $($_PROPERTIES_JSON_).each(function(i,prop){
                if(filterProperty(prop)){
                    $('div.resultsList div.results').append(property_layout(prop));
                    addMarkerMultiMarkers(prop, map);
                    _N_IMOVEIS_++;
                }
            });
            //prepareMarkerCluster(map);
            switch(_N_IMOVEIS_){
                case 0:
                    onLoading('no-results');
                    $('h1.osLight b').html('Nenhum imóvel encontrado');
                    break;
                case 1:
                    onLoading('results');
                    $('h1.osLight b').html('1 imóvel encontrado');
                    break;
                default:
                    onLoading('results');
                    $('h1.osLight b').html(_N_IMOVEIS_ + ' imóveis encontrados');
                    break;
            }
        }

        function updateLayoutProperties(result){
            console.log(result);
            $_PROPERTIES_JSON_ = result.Properties;
            $_FILTERS_ = result.PropertiesFilters;

            //Clean layout
            cleanLayoutProperties('div.resultsList div.results');

            if($_FILTERS_ == null){
                $_FILTERS_ = {};
                $_FILTERS_.bathroom = {};
                $_FILTERS_.bedroom = {};
                $_FILTERS_.garage = {};
                $_FILTERS_.rental = {};
                $_FILTERS_.internal_area = {};
                $_FILTERS_.bathroom.max = '';
                $_FILTERS_.bathroom.min = '';
                $_FILTERS_.bedroom.max = '';
                $_FILTERS_.bedroom.min = '';
                $_FILTERS_.garage.max = '';
                $_FILTERS_.garage.min = '';
                $_FILTERS_.rental.max = 0;
                $_FILTERS_.rental.min = 0;
                $_FILTERS_.internal_area.max = 0;
                $_FILTERS_.internal_area.min = 0;
                $_FILTERS_.type = [];
            }

            updateLayoutBedroom($_FILTERS_.bedroom);
            updateLayoutBathroom($_FILTERS_.bathroom);
            updateLayoutGarage($_FILTERS_.garage);
            updateLayoutPrice($_FILTERS_.rental);
            updateLayoutArea($_FILTERS_.internal_area);
            updateLayoutType($_FILTERS_.type);

            filterLayoutProperties();
        }

        function refreshFilterLayoutProperties(){
            onLoading('load');
            cleanLayoutProperties('div.resultsList div.results');
            filterLayoutProperties(true);
        }

        $(document).ready(function (){
            $('select[name=bathrooms]').change(function(){
                $_FILTERS_LAYOUT_.bathrooms = $(this).val();
                refreshFilterLayoutProperties();
            });
            $('select[name=bedrooms]').change(function(){
                $_FILTERS_LAYOUT_.bedrooms = $(this).val();
                refreshFilterLayoutProperties();
            });
            $('select[name=garages]').change(function(){
                $_FILTERS_LAYOUT_.garages = $(this).val();
                refreshFilterLayoutProperties();
            });
            $('select[name=property_type]').change(function(){
                $_FILTERS_LAYOUT_.type = $(this).val();
                refreshFilterLayoutProperties();
            });
        });
        //CORE
        function loadProperties(map) {
            var bounds = map.getBounds();
            var ne = bounds.getNorthEast();
            var sw = bounds.getSouthWest();
            $.ajax({
                url: "{{route('properties.ajax')}}",
                type: 'get',
                data: {
                    "ne": ([ne.lat, ne.lng]),
                    "sw": ([sw.lat, sw.lng])
                },
                dataType: "json",
                beforeSend: function () {
                   onLoading('load');
               },
               error: function (xhr, textStatus) {
                onLoading('no-results');
                console.log('xhr-error: ' + xhr);
                console.log('textStatus-error: ' + textStatus);
            },
            success: function (json) {
                $_RESULTS_JSON_ORIGINAL_ = json;
                updateLayoutProperties(json);
            }
        });
        }
        $(document).ready(function () {

            $('body').removeClass('notransition');

            //setting multi properties
//            setMultiMarkers($_PROPERTIES_JSON_, map);
            $('.priceSlider').slider({
                range: true,
                min: 0,
                max: 0,
                values: [0, 0],
                step: 0.01,
                slide: function (event, ui) {
                    $('.priceSlider .sliderTooltip .stLabel').html(
                        'R$ ' + ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") +
                        ' <span class="fa fa-arrows-h"></span> ' +
                        'R$ ' + ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
                    );
                    var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
                    var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
                    var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
                    $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);
                    $_FILTERS_LAYOUT_.rental = ui.values;
                    refreshFilterLayoutProperties();
                }
            });
            $('.priceSlider .sliderTooltip .stLabel').html(
                'R$ ' + $('.priceSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") +
                ' <span class="fa fa-arrows-h"></span> ' +
                'R$ ' + $('.priceSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
            );
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);


            $('.areaSlider').slider({
                range: true,
                min: 0,
                max: 0,
                values: [0, 0],
                step: 0.01,
                slide: function (event, ui) {
                    $('.areaSlider .sliderTooltip .stLabel').html(
                        ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' m²' +
                        ' <span class="fa fa-arrows-h"></span> ' +
                        ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' m²'
                    );
                    var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
                    var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
                    var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
                    $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);
                    $_FILTERS_LAYOUT_.internal_area = ui.values;
                    refreshFilterLayoutProperties();
                }
            });
            $('.areaSlider .sliderTooltip .stLabel').html(
                $('.areaSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' m²' +
                ' <span class="fa fa-arrows-h"></span> ' +
                $('.areaSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' m²'
            );
            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

            $('#property_type').select(function () {
                var currentVal = $(this).val();
                $_FILTERS_LAYOUT_.type = currentVal;
                refreshFilterLayoutProperties();
            });
            //bathrooms
//            $('#bathrooms .btn-round-right').click(function () {
//                var currentVal = parseInt($(this).siblings('input').val());
//                var max = parseInt($(this).data('max'));
//                if (currentVal < max) {
//                    currentVal += 1;
//                    $(this).siblings('input').val(currentVal);
//                    $_FILTERS_LAYOUT_.bathrooms = currentVal;
//                    refreshFilterLayoutProperties();
//                }
//            });
//            $('#bathrooms .btn-round-left').click(function () {
//                var currentVal = parseInt($(this).siblings('input').val());
//                var min = parseInt($(this).data('min'));
//                if (currentVal > min) {
//                    currentVal -= 1;
//                    $(this).siblings('input').val(currentVal);
//                    $_FILTERS_LAYOUT_.bathrooms = currentVal;
//                    refreshFilterLayoutProperties();
//                }
//            });
//
//            //bedrooms
//            $('#bedrooms .btn-round-right').click(function () {
//                var currentVal = parseInt($(this).siblings('input').val());
//                var max = parseInt($(this).data('max'));
//                if (currentVal < max) {
//                    currentVal += 1;
//                    $(this).siblings('input').val(currentVal);
//                    $_FILTERS_LAYOUT_.bedrooms = currentVal;
//                    refreshFilterLayoutProperties();
//                }
//            });
//            $('#bedrooms .btn-round-left').click(function () {
//                var currentVal = parseInt($(this).siblings('input').val());
//                var min = parseInt($(this).data('min'));
//                if (currentVal > min) {
//                    currentVal -= 1;
//                    $(this).siblings('input').val(currentVal);
//                    $_FILTERS_LAYOUT_.bedrooms = currentVal;
//                    refreshFilterLayoutProperties();
//                }
//            });

        });
    </script>
@endsection