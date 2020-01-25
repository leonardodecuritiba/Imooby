@extends('site.layouts.map.template')
@section('styles_content')
@endsection
@section('body_content')

    <!-- Bar Navigation -->
    @include('site.layouts.menu.navbar')

    <!-- Left Side Navigation -->
    @include('site.layouts.menu.sidebar')
    <!-- Content -->
    <div id="wrapper">
        <div id="mapView">
            <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Carregando Mapa...</div>
        </div>
        <div id="content">
            <div class="filter">
                <h1 class="osLight" style="color: #00A7ED; font-weight: bold; font-size: 1.5em;">Meus Imóveis favoritos</h1>
                <div class="clearfix"></div>
            </div>
            <div class="resultsList">
                <div class="row">
                    @foreach($_SELF_TEMPLATE_['Properties'] as $property)
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 20px;">
                            <a @if($property->status)
                               href="{{route('ver-imovel',$property->id)}}"
                               @else
                               data-toggle="modal" href="#modal_sucesso"
                               @endif
                               class="card" style="margin-bottom: 5px;">@include('site.properties.single_property')</a>

                            <a href="{{route('property.unlike',$property->id)}}" class="btn btn-danger pull-right btn-xs"
                                   style="border-radius: 0px; margin-left: 10px;"><i class="fa fa-trash"></i>
                                Remover</a>
                        </div>
                    @endforeach
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
        </div>
        <div class="clearfix"></div>
    </div>
@endsection
@section('scripts_content')
    @include('site.layouts.map.leafletjs')
    @include('site.layouts.map.mapjs')

    <script>
        var $_PROPERTIES_JSON_ = <?php echo($_SELF_TEMPLATE_['PropertiesInfoBox']); ?>;
        $(document).ready(function () {
            $('body').removeClass('notransition');
            map = L.map('mapView').setView([$_GLOBAL_MAPS_API_['positions'].lat, $_GLOBAL_MAPS_API_['positions'].lng], 15);
            
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                id: 'mapbox.emerald',
                accessToken: 'pk.eyJ1IjoiaWdvcjg0IiwiYSI6ImNqNHlkeTkweTFwNXkyd3BsOTl0d2dkdXIifQ.A827kJGgvatGm0hYY7IBYQ'
            }).addTo(map);
            setMultiMarkers($_PROPERTIES_JSON_, map, false);
            setViewToLastMarker();
        });
    </script>
    <script>
        //MODAL DANGER FOR INVALID PROPERTIES
        $(document).ready(function () {
            $('div#modal_sucesso').on('show.bs.modal', function (e) {
                var $body = $(this).find('div.modal-body div.conteudo_modal');
                $($body).find('h3').html('Falta pouco!');
                $($body).find('.mensagem_modal').html('O seu anúncio estará ativo nas próximas horas.');
            });
        });
    </script>
@endsection