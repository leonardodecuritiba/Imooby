<script>
    var map, marker, mainMarker, markers = [], addedProps = [];
    var infoWindow = null;
    var markerCluster = L.markerClusterGroup({animate: true,animateAddingMarkers:true});
    var $_GLOBAL_MAPS_API_ = [];
    var $_PROPERTIES_JSON_ = '';
    $_GLOBAL_MAPS_API_['positions'] = {
        lat: parseFloat({{$_PAGE_TEMPLATE_['main_position']['lat']}}),
        lng: parseFloat({{$_PAGE_TEMPLATE_['main_position']['lng']}})
    };
    $_GLOBAL_MAPS_API_['options'] = {
        zoom: 10,
        mapTypeId: 'Styled',
        disableDefaultUI: true,
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        }
    };
    $_GLOBAL_MAPS_API_['styles'] = [
        {
            stylers: [{
                hue: "#cccccc"
            }, {
                saturation: -100
            }]
        }, {
            featureType: "road",
            elementType: "geometry",
            stylers: [{
                lightness: 100
            }, {
                visibility: "simplified"
            }]
        }, {
            featureType: "road",
            elementType: "labels",
            stylers: [{
                visibility: "on"
            }]
        }, {
            featureType: "poi",
            stylers: [{
                visibility: "off"
            }]
        }
    ];


    function cleanLayoutProperties($el){
        // deleteMarkers();
        $($el).empty();
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
        setMapOnAll(null);
    }

    // Shows any markers currently in the array.
    function showMarkers() {
        setMapOnAll(map);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        markerCluster.clearLayers();
        markers = [];
        addedProps = [];
    }

    function setLayoutInfoWindows(prop) {
        var url = "{{route('ver-imovel','ID')}}";
        return '<div class="infoW">' +
            '<div class="propImg">' +
            '<img src="' + prop.thumb_main_photo + '">' +
            '<div class="propBg">' +
            '<div class="propPrice">' + prop.price_total_money + '</div>' +
            '<div class="propType">' + prop.type + '</div>' +
            '</div>' +
            '</div>' +
            '<div class="paWrapper">' +
            '<div class="propTitle">' + prop.title + '</div>' +
            '<div class="propAddress">' + prop.address + '</div>' +
            '</div>' +
            '<ul class="propFeat">' +
            '<li><span class="fa fa-moon-o"></span> ' + prop.bedrooms + '</li>' +
            '<li><span class="icon-drop"></span> ' + prop.bathrooms + '</li>' +
            '<li><span class="icon-frame"></span> ' + prop.internal_area_formated + '</li>' +
            '</ul>' +
            '<div class="clearfix"></div>' +
            '<div class="infoButtons">' +
            '<a href="javascript:mapClosePopup()" class="btn btn-sm btn-round btn-gray btn-o closeInfo">Fechar</a>' +
            '<a href="' + url.replace('ID', prop.id) + '" class="btn btn-sm btn-round btn-green viewInfo">Ver</a>' +
            '</div>' +
            '</div>';
    }

    // function that adds the clusters on map
    function prepareMarkerCluster(map) {
        // markerCluster.clearLayers();
        map.addLayer(markerCluster);
    }

    function mapClosePopup() {
        map.closePopup();
    }

    // function that adds the markers on map
    
    function addMarkerMultiMarkers(prop, map) {
        if (addedProps[prop.id]==1) {
            return;
        }
        addedProps[prop.id] = 1;
        var lat = parseFloat(prop.position.lat);
        var lng = parseFloat(prop.position.lng);
        var marker = L.marker([lat, lng]).addTo(map);

        var infoboxContent = setLayoutInfoWindows(prop);
        marker.bindPopup(infoboxContent);
        
        markerCluster.addLayer(marker);
        markers.push(marker);
    };

    function setMainMarker($_MAIN_PROPERTY_JSON_, map) {

        var lat = parseFloat($_MAIN_PROPERTY_JSON_.position.lat);
        var lng = parseFloat($_MAIN_PROPERTY_JSON_.position.lng);

        addedProps[$_MAIN_PROPERTY_JSON_.id] = 1;

        var marker = L.marker([lat, lng]).addTo(map);

        var infoboxContent = setLayoutInfoWindows($_MAIN_PROPERTY_JSON_);
        marker.bindPopup(infoboxContent);
        
        markerCluster.addLayer(marker);
        markers.push(marker);
    };
    // function that adds the main marker on map
    function setMarker(pos, map) {
        var marker = L.marker([pos.lat, pos.lng], {draggable: true}).addTo(map);
        markers.push(marker);
        return marker;
    };
    
    // function that adds the markers on map
    function setMultiMarkers($_PROPERTIES_JSON_, map, icon = true) {
        if(icon) {
        var greyIcon = new L.Icon({
          iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-grey.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
      });
    }

        $.each($_PROPERTIES_JSON_, function (i, prop) {
            var lat = parseFloat(prop.position.lat);
            var lng = parseFloat(prop.position.lng);

            addedProps[prop.id] = 1;

            if(icon) {var marker = L.marker([lat, lng], {icon: greyIcon}).addTo(map);} else {
                var marker = L.marker([lat, lng]).addTo(map);
            }

            var infoboxContent = setLayoutInfoWindows(prop);
            marker.bindPopup(infoboxContent);

            markerCluster.addLayer(marker);
            markers.push(marker);
        });
    };
    
    function setViewToLastMarker() {
        var lastMarker = markers[markers.length - 1];
        map.panTo(lastMarker.getLatLng());
    }

    //        function initMap() {
    //            map = new google.maps.Map(document.getElementById('map'), {
    //                center: {lat: -34.397, lng: 150.644},
    //                zoom: 6
    //            });
    //            infoWindow = new google.maps.InfoWindow;
    //
    //            // Try HTML5 geolocation.
    //            if (navigator.geolocation) {
    //                navigator.geolocation.getCurrentPosition(function (position) {
    //                    var pos = {
    //                        lat: position.coords.latitude,
    //                        lng: position.coords.longitude
    //                    };
    //
    //                    infoWindow.setPosition(pos);
    //                    infoWindow.setContent('Sua localização.');
    //                    infoWindow.open(map);
    //                    map.setCenter(pos);
    //                }, function () {
    //                    handleLocationError(true, infoWindow, map.getCenter());
    //                });
    //            } else {
    //                // Browser doesn't support Geolocation
    //                handleLocationError(false, infoWindow, map.getCenter());
    //            }
    //        }
    //    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    //        infoWindow.setPosition(pos);
    //        infoWindow.setContent(browserHasGeolocation ?
    //            'Erro: O serviço de geolocalização falhou.' :
    //            'Erro: Seu navegador não suporta  geolocalização.');
    //        infoWindow.open(map);
    //    }

    // functionality for map manipulation icon on mobile devices
    (function ($) {
        $('.mapHandler').click(function () {
            if ($('#mapView').hasClass('mob-min') ||
                $('#mapView').hasClass('mob-max') ||
                $('#content').hasClass('mob-min') ||
                $('#content').hasClass('mob-max')) {
                $('#mapView').toggleClass('mob-max');
                $('#content').toggleClass('mob-min');
            } else {
                $('#mapView').toggleClass('min');
                $('#content').toggleClass('max');
            }

            setTimeout(function () {
                var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
                var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
                var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
                $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

                var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
                var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
                var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
                $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

                $('.commentsFormWrapper').width($('#content').width());
            }, 300);

        });
    })(jQuery);
</script>