<script>
    var map, marker, mainMarker, markers = [];
    var infoWindow = null;
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
        clearMarkers();
        markers = [];
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
            '<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Fechar</a>' +
            '<a href="' + url.replace('ID', prop.id) + '" class="btn btn-sm btn-round btn-green viewInfo">Ver</a>' +
            '</div>' +
            '</div>';
    }

    function setInfoBox() {
        return new InfoBox({
            disableAutoPan: false,
            maxWidth: 202,
            pixelOffset: new google.maps.Size(-101, -285),
            zIndex: null,
            boxStyle: {
                background: "url('{{asset('assets_site/images/infobox-bg.png')}}') no-repeat",
                opacity: 1,
                width: "202px",
                height: "245px"
            },
            closeBoxMargin: "28px 26px 0px 0px",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            pane: "floatPane",
            enableEventPropagation: false
        });
    }
    // custom infowindow object

    function updateMarkerMapcenter(pos, map) {
        marker.setPosition(pos);
        marker.setVisible(true);
        map.setCenter(pos);
    }

    function updateMainMarkerMapcenter(pos, map) {
        mainMarker.setPosition(pos);
        map.setCenter(pos);
    }

    // function that adds the main marker on map
    function setMarker(pos, map) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(pos),
            map: map,
            icon: new google.maps.MarkerImage(
                '{{asset('assets_site/images/marker-new.png')}}',
                null,
                null,
                // new google.maps.Point(0,0),
                null,
                new google.maps.Size(36, 36)
            ),
            draggable: true,
            animation: google.maps.Animation.DROP,
        });
    };

    function setMainMarker($_MAIN_PROPERTY_JSON_, map) {
        var latlng = {
            lat: parseFloat($_MAIN_PROPERTY_JSON_.position.lat),
            lng: parseFloat($_MAIN_PROPERTY_JSON_.position.lng)
        };
        mainMarker = new google.maps.Marker({
            position: new google.maps.LatLng(latlng),
            map: map,
            icon: new google.maps.MarkerImage(
                '{{asset('assets_site/images/marker-new.png')}}',
                null,
                null,
                // new google.maps.Point(0,0),
                null,
                new google.maps.Size(38, 38)
            ),
            draggable: false,
            animation: google.maps.Animation.DROP,
        });

        var infobox = setInfoBox();
        var infoboxContent = setLayoutInfoWindows($_MAIN_PROPERTY_JSON_);

        google.maps.event.addListener(mainMarker, 'click', (function (mainMarker) {
            return function () {
                infobox.setContent(infoboxContent);
                infobox.open(map, mainMarker);
            }
        })(mainMarker));

        $(document).on('click', '.closeInfo', function () {
            infobox.open(null, null);
        });

        updateMainMarkerMapcenter(latlng, map);
    };

    // function that adds the markers on map
    function setMultiMarkers($_PROPERTIES_JSON_, map) {
        var infobox = setInfoBox();
        $.each($_PROPERTIES_JSON_, function (i, prop) {
            var latlng = {
                lat: parseFloat(prop.position.lat),
                lng: parseFloat(prop.position.lng)
            };
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: new google.maps.MarkerImage(
                    '{{asset('assets_site/images')}}/' + prop.markerIcon,
                    null,
                    null,
                    null,
                    new google.maps.Size(30, 30)
                ),
                draggable: false,
                animation: google.maps.Animation.DROP,
            });
            var infoboxContent = setLayoutInfoWindows(prop);
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infobox.setContent(infoboxContent);
                    infobox.open(map, marker);
                }
            })(marker, i));

            $(document).on('click', '.closeInfo', function () {
                infobox.open(null, null);
            });

            markers.push(marker);
        });
    };

    // function that adds the clusters on map
    function prepareMarkerCluster(map) {
        var mcOptions = {
            'minimumClusterSize':3,
            'gridSize':55,
            'styles': [
            {
                'url':'{{ asset('js/markerclusterer/m1.png') }}',
                'height':35,
                'width': 35,
                'textColor':'white'
            },
            {
                'url':'{{ asset('js/markerclusterer/m2.png') }}',
                'height':35,
                'width': 35,
                'textColor':'white'
            },
            {
                'url':'{{ asset('js/markerclusterer/m3.png') }}',
                'height':35,
                'width': 35,
                'textColor':'white'
            }
            ]
        };
        var markerCluster = new MarkerClusterer(map, markers, mcOptions);
    }

    // function that adds the markers on map
    addedProps = [];
    function addMarkerMultiMarkers(prop, map) {
        if (addedProps[prop.id]==1) {
            return;
        }
        addedProps[prop.id] = 1;
        var infobox = setInfoBox();
        var latlng = {
            lat: parseFloat(prop.position.lat),
            lng: parseFloat(prop.position.lng)
        };
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: new google.maps.MarkerImage(
                '{{asset('assets_site/images')}}/' + prop.markerIcon,
                null,
                null,
                null,
                new google.maps.Size(30, 30)
            ),
            draggable: false,
            animation: google.maps.Animation.DROP,
        });
        var infoboxContent = setLayoutInfoWindows(prop);
        google.maps.event.addListener(marker, 'click', (function (marker) {
            return function () {
                infobox.setContent(infoboxContent);
                infobox.open(map, marker);
            }
        })(marker));

        $(document).on('click', '.closeInfo', function () {
            infobox.open(null, null);
        });

        markers.push(marker);
    };


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