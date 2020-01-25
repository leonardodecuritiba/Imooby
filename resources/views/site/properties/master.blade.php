@extends('site.layouts.map.template')
@section('styles_content')
<style type="text/css">
    .modal-header {
        border-bottom: none;
    }

    .modal-footer {
        background-color: #00a7ec;
    }

    .modal-content {
        border-radius: 0px;
    }

    .modal-body {
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;
    }
    .rightContainer {
        line-height: 2em;
        background: white;
        padding: 55px;
    }
    .rightContainer h1 {
        font-size: 1.5em !important;
    }
</style>
<style>
    .file-preview-image-edit {
        margin: 5px !important;
    }

    .img-pos {
        display: inline-block;
        position: relative;
    }

    .image-remove {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 100;
    }
</style>
@endsection
@section('body_content')

<!-- Bar Navigation -->
@include('site.layouts.menu.navbar')

<!-- Left Side Navigation -->
@include('site.layouts.menu.sidebar')

<!-- Content -->
<div id="wrapper">
    <div id="mapView" class="mob-min">
        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Carregando Mapa...</div>
    </div>
    <div id="content" class="mob-max">
        <div class="rightContainer">
            <h1>Anunciar imóvel</h1>
            {!! Form::open(['route' => (Route::currentRouteName() == "property.edit")?['property.update', $_SELF_TEMPLATE_['Property']->id] :'property.store',
                'files' => true, 'multiple' => 'multiple', 'method' => 'POST',
                'role' => 'form', 'data-parsley-validate', 'id' => 'form-anunciar-imovel']) !!}
                @include('site.properties.form')
                {{Form::close()}}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    @endsection
    @section('scripts_content')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-104490441-1', 'auto');
      ga('send', 'pageview');

    </script>
    @include('site.layouts.map.leafletjs')
    @include('site.layouts.map.mapjs')
    <script>
        function updateLayoutAddress(pos, place) {
            var address_components = place.address_components;
            var formatted_address = place.formatted_address;
            var components = {};
            for (var i = 0; i < address_components.length; i++) {
                for (var j = 0; j < address_components[i].types.length; j++) {
                    switch(address_components[i].types[j]){
                        case "street_number":
                        components.number = address_components[i].long_name;
                        break;
                        case "route":
                        components.street = address_components[i].long_name;
                        break;
                        case "sublocality_level_1":
                        components.district = address_components[i].long_name;
                        break;
                        case "administrative_area_level_4":
                        components.district = address_components[i].long_name;
                        break;
                        case "locality":
                        components.city = address_components[i].long_name;
                        break;
                        case "administrative_area_level_1":
                        components.state = address_components[i].long_name;
                        break;
                        case "postal_code":
                        components.zip = address_components[i].long_name;
                        break;
                    }
                }
            }

            $.each(components, function (i, v) {
                $('input[name=' + i + ']').val(v);
            });

            $('input[name=lat]').val(pos.lat);
            $('input[name=lng]').val(pos.lng);
//            $("#txtLatitude").html(pos.lat);
//            $("#txtLongitude").html(pos.lng);

var endereco = formatted_address;
$('#txtEndereco').val(endereco);
}
$(document).ready(function () {
    $('body').removeClass('notransition');

    map = L.map('mapView').setView([$_GLOBAL_MAPS_API_['positions'].lat, $_GLOBAL_MAPS_API_['positions'].lng], 15);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        maxZoom: 18,
        id: 'mapbox.emerald',
        accessToken: 'pk.eyJ1IjoiaWdvcjg0IiwiYSI6ImNqNHlkeTkweTFwNXkyd3BsOTl0d2dkdXIifQ.A827kJGgvatGm0hYY7IBYQ'}).addTo(map);

            var pos = $_GLOBAL_MAPS_API_['positions']; //CURITIBA -25.429631,-49.3070971
            var currentMarker = setMarker(pos, map);
            currentMarker.on('dragend', function(event){
                var marker = event.target;
                var pos = marker.getLatLng();
                $('input[name=lat]').val(pos.lat);
                $('input[name=lng]').val(pos.lng);
            });

            // functionality for autocomplete address field
            var address = document.getElementById('txtEndereco');
            var addressAuto = new google.maps.places.Autocomplete(address, {
                componentRestrictions: {country:'BR'}
            });
            google.maps.event.addListener(addressAuto, 'place_changed', function () {

                var place = addressAuto.getPlace();

                if (!place.geometry) {
                    return;
                }
                var pos = place.geometry.location;
                var latlng = new L.LatLng(pos.lat(), pos.lng());
                map.panTo(latlng);
                currentMarker.setLatLng(latlng);
                updateLayoutAddress(pos, place);
                return false;
            });

//            google.maps.event.addListener(marker, "mouseup", function (event) {
//                var place = this.getPlace();
//                console.log(this.position);
//                var latitude = this.position.lat();
//                var longitude = this.position.lng();
//                $('#txtLatitude').text(this.position.lat());
//                $('#txtLongitude').text(this.position.lng());
//            });
});


</script>
@if(!Auth::check() || !Auth::user()->hasRole('client'))
@include('site.layouts.alerts.danger')
<script type="text/javascript">
    $(document).ready(function () {
        $('#modal_danger').find('div.conteudo_modal ul').html('<li class="li_branco">Você precisa estar logado para anunciar um imóvel!</li>')
        $('#modal_danger').modal('show');
    })
</script>
@endif

{!! Html::script('assets_admin/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js') !!}
<script>
    function calc_valores($this) {
        var fee = {{$_SELF_TEMPLATE_['PropertyFee']}};
        var $field_price_rental = $($this).parents('div#valores').find('input[name=price_rental]');
        var $field_price_condominium = $($this).parents('div#valores').find('input[name=price_condominium]');
        var $field_price_iptu = $($this).parents('div#valores').find('input[name=price_iptu]');
        var $field_fee = $($this).parents('div#valores').find('input[name=fee]');
        var $field_total = $($this).parents('div#valores').find('input[name=total]');

        var total =
        $($field_price_rental).maskMoney('unmasked')[0] +
        $($field_price_condominium).maskMoney('unmasked')[0] +
        $($field_price_iptu).maskMoney('unmasked')[0];

        $($field_fee).maskMoney('mask', total * fee);
        $($field_total).maskMoney('mask', total * (1 + fee));
    }
</script>
<script type="text/javascript">
    function initMaskMoney(selector) {
        $(selector).maskMoney({allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});
    }
    $(document).ready(function () {
        initMaskMoney($(".show-valor"));
        $("form#form-anunciar-imovel").submit(function () {
            var $parent = $(this).find('div#valores');
            var fields = ['price_rental', 'price_condominium', 'price_iptu'];
            var value = 0;
            $.each(fields, function (i, v) {
                var $campo = $($parent).find('input[name=' + v + ']');
                value = $($campo).maskMoney('unmasked')[0];
                $($campo).val(value);
            });
        });
    });
</script>
<script>
    //Remove property photo
    $(document).ready(function () {
        $('a.image-remove').click(function () {
            var $image = $(this);
            var _url = $($image).data('url');
            $.ajax({
                url: _url,
                type: 'get',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "json",
                beforeSend: function () {
                    $('div.loader').addClass('esconda');
                },
                complete: function (xhr, textStatus) {
                    $('div.loader').removeClass('esconda');
                },
//                error: function (xhr, textStatus) {
//                    $($_LOADING_).hide();
//                    console.log('xhr-error:');
//                    console.log(xhr);
//                    console.log('textStatus-error: ' + textStatus);
//                },
                success: function (json) {
                    if (json.mensagem) {
                        $($image).parents('div.img-pos').remove();
                        $('#modal_sucesso').modal('show');
                        $('#modal_sucesso').find('.conteudo_modal span.mensagem_modal').html(json.response);
                    } else {
                        $('#modal_danger').modal('show');
                        $('#modal_danger').find('.conteudo_modal span.mensagem_modal').html(json.response);

                    }
                    console.log(json);
                }
            });
        })
    })
</script>
@endsection