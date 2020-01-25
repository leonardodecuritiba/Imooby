<script>
    (function ($) {
        "use strict";
        // Custom options for map

//        setTimeout(function () {
//            $('body').removeClass('notransition');
//
//            map = new google.maps.Map(document.getElementById('mapView'), $_GLOBAL_MAPS_API_['options']);
//            var styledMapType = new google.maps.StyledMapType($_GLOBAL_MAPS_API_['styles'], {
//                name: 'Styled'
//            });
//
//            //CURITIBA -25.429631,-49.3070971
//            var pos = $_GLOBAL_MAPS_API_['positions'];
//            //marcador principal do mapa
//            newMarker = addMainMarker(pos, map)
//
//            //centralizando o mapa
//            map.mapTypes.set('Styled', styledMapType);
//            map.setCenter(pos);
//            map.setZoom(14);
//
//            google.maps.event.addListener(newMarker, "mouseup", function (event) {
//                var latitude = this.position.lat();
//                var longitude = this.position.lng();
//                $('#latitude').text(this.position.lat());
//                $('#longitude').text(this.position.lng());
//            });
//        }, 300);

//        puxando os dados da localização do mapa
        google.maps.event.addListener(newMarker, "mouseup", function (event) {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#latitude').text(this.position.lat());
            $('#longitude').text(this.position.lng());
        });
    })(jQuery);

</script>