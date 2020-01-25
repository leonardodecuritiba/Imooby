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
        <div class="clearfix"></div>
    </div>
@endsection
@section('scripts_content')
    @include('site.layouts.map.globalsjs')
    <script>
        var map, geocoder, marker;
        $(document).ready(function () {
            $('body').removeClass('notransition');

            map = new google.maps.Map(document.getElementById('mapView'), $_GLOBAL_MAPS_API_['options']);
            geocoder = new google.maps.Geocoder();
            var styledMapType = new google.maps.StyledMapType($_GLOBAL_MAPS_API_['styles'], {
                name: 'Styled'
            });

            var pos = $_GLOBAL_MAPS_API_['positions']; //CURITIBA -25.429631,-49.3070971
            marker = addMainMarker(pos, map);


            if (navigator.geolocation) {
                var x = navigator.geolocation.getCurrentPosition(function (position) {
                    pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    setMarkerMapcenter(pos, map);
                }, function () {
                    setMarkerMapcenter(pos, map);
                });
            } else {
                setMarkerMapcenter(pos, map);
            }

            //centralizando o mapa
            map.mapTypes.set('Styled', styledMapType);
            map.setZoom(14);
            console.log(marker);

            google.maps.event.addListener(marker, 'mouseup', function () {
                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#txtEndereco').val(results[0].formatted_address);
                            $('#txtLatitude').html(marker.position.lat());
                            $('#txtLongitude').html(marker.position.lng());
                        }
                    }
                });
//                var latitude = this.position.lat();
//                var longitude = this.position.lng();
//                $('#latitude').text(this.position.lat());
//                $('#longitude').text(this.position.lng());
            });
        });
    </script>
    {{--<script async defer--}}
    {{--src="https://maps.googleapis.com/maps/api/js?key={{$_PAGE_TEMPLATE_['GOOGLE_MAP_API_KEY']}}&callback=initMap">--}}
    {{--</script>--}}
@endsection