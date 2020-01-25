(function ($) {
    "use strict";
    // Custom options for map
    var map;
    var options = {
        zoom: 10,
        mapTypeId: 'Styled',
        disableDefaultUI: true,
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        }
    };
    var styles = [{
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
    }];

    var newMarker = null;
    var markers = [];

    // json for properties markers on map
    var props = [{
        title: 'Modern Residence in New York',
        image: '1-1-thmb.png',
        type: 'For Sale',
        price: '$1,550,000',
        address: '39 Remsen St, Brooklyn, NY 11201, USA',
        bedrooms: '3',
        bathrooms: '2',
        area: '3430 m²',
        position: {
            lat: 40.696047,
            lng: -73.997159
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Hauntingly Beautiful Estate',
        image: '2-1-thmb.png',
        type: 'For Rent',
        price: '$1,750,000',
        address: '169 Warren St, Brooklyn, NY 11201, USA',
        bedrooms: '2',
        bathrooms: '2',
        area: '4430 m²',
        position: {
            lat: 40.688042,
            lng: -73.996472
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Sophisticated Residence',
        image: '3-1-thmb.png',
        type: 'For Sale',
        price: '$1,340,000',
        address: '38-62 Water St, Brooklyn, NY 11201, USA',
        bedrooms: '2',
        bathrooms: '3',
        area: '2640 m²',
        position: {
            lat: 40.702620,
            lng: -73.989682
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'House With a Lovely Glass-Roofed Pergola',
        image: '4-1-thmb.png',
        type: 'For Sale',
        price: '$1,930,000',
        address: 'Wunsch Bldg, Brooklyn, NY 11201, USA',
        bedrooms: '3',
        bathrooms: '2',
        area: '2800 m²',
        position: {
            lat: 40.694355,
            lng: -73.985229
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Luxury Mansion',
        image: '5-1-thmb.png',
        type: 'For Rent',
        price: '$2,350,000',
        address: '95 Butler St, Brooklyn, NY 11231, USA',
        bedrooms: '2',
        bathrooms: '2',
        area: '2750 m²',
        position: {
            lat: 40.686838,
            lng: -73.990078
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Modern Residence in New York',
        image: '1-1-thmb.png',
        type: 'For Sale',
        price: '$1,550,000',
        address: '39 Remsen St, Brooklyn, NY 11201, USA',
        bedrooms: '3',
        bathrooms: '2',
        area: '3430 m²',
        position: {
            lat: 40.703686,
            lng: -73.982910
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Hauntingly Beautiful Estate',
        image: '2-1-thmb.png',
        type: 'For Rent',
        price: '$1,750,000',
        address: '169 Warren St, Brooklyn, NY 11201, USA',
        bedrooms: '2',
        bathrooms: '2',
        area: '4430 m²',
        position: {
            lat: 40.702189,
            lng: -73.995098
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Sophisticated Residence',
        image: '3-1-thmb.png',
        type: 'For Sale',
        price: '$1,340,000',
        address: '38-62 Water St, Brooklyn, NY 11201, USA',
        bedrooms: '2',
        bathrooms: '3',
        area: '2640 m²',
        position: {
            lat: 40.687417,
            lng: -73.982653
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'House With a Lovely Glass-Roofed Pergola',
        image: '4-1-thmb.png',
        type: 'For Sale',
        price: '$1,930,000',
        address: 'Wunsch Bldg, Brooklyn, NY 11201, USA',
        bedrooms: '3',
        bathrooms: '2',
        area: '2800 m²',
        position: {
            lat: 40.694120,
            lng: -73.974413
        },
        markerIcon: "marker-blue.png"
    }, {
        title: 'Luxury Mansion',
        image: '5-1-thmb.png',
        type: 'For Rent',
        price: '$2,350,000',
        address: '95 Butler St, Brooklyn, NY 11231, USA',
        bedrooms: '2',
        bathrooms: '2',
        area: '2750 m²',
        position: {
            lat: 40.682665,
            lng: -74.000934
        },
        markerIcon: "marker-blue.png"
    }];

    // custom infowindow object
    var infobox = new InfoBox({
        disableAutoPan: false,
        maxWidth: 202,
        pixelOffset: new google.maps.Size(-101, -285),
        zIndex: null,
        boxStyle: {
            background: "url('assets_site/images/infobox-bg.png') no-repeat",
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

    // function that adds the markers on map
    var addMarkers = function (props, map) {
        $.each(props, function (i, prop) {
            var latlng = new google.maps.LatLng(prop.position.lat, prop.position.lng);
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: new google.maps.MarkerImage(
                    'assets_site/images/' + prop.markerIcon,
                    null,
                    null,
                    null,
                    new google.maps.Size(36, 36)
                ),
                draggable: false,
                animation: google.maps.Animation.DROP,
            });
            var infoboxContent = '<div class="infoW">' +
                '<div class="propImg">' +
                '<img src="images/prop/' + prop.image + '">' +
                '<div class="propBg">' +
                '<div class="propPrice">' + prop.price + '</div>' +
                '<div class="propType">' + prop.type + '</div>' +
                '</div>' +
                '</div>' +
                '<div class="paWrapper">' +
                '<div class="propTitle">' + prop.title + '</div>' +
                '<div class="propAddress">' + prop.address + '</div>' +
                '</div>' +
                '<div class="propRating">' +
                '<span class="fa fa-star"></span>' +
                '<span class="fa fa-star"></span>' +
                '<span class="fa fa-star"></span>' +
                '<span class="fa fa-star"></span>' +
                '<span class="fa fa-star-o"></span>' +
                '</div>' +
                '<ul class="propFeat">' +
                '<li><span class="fa fa-moon-o"></span> ' + prop.bedrooms + '</li>' +
                '<li><span class="icon-drop"></span> ' + prop.bathrooms + '</li>' +
                '<li><span class="icon-frame"></span> ' + prop.area + '</li>' +
                '</ul>' +
                '<div class="clearfix"></div>' +
                '<div class="infoButtons">' +
                '<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Close</a>' +
                '<a href="single.html" class="btn btn-sm btn-round btn-green viewInfo">View</a>' +
                '</div>' +
                '</div>';

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

    setTimeout(function () {
        $('body').removeClass('notransition');

        map = new google.maps.Map(document.getElementById('mapView'), options);
        var styledMapType = new google.maps.StyledMapType(styles, {
            name: 'Styled'
        });

        map.mapTypes.set('Styled', styledMapType);
        map.setCenter(new google.maps.LatLng(40.6984237, -73.9890044));
        map.setZoom(14);

        if ($('#address').length > 0) {
            newMarker = new google.maps.Marker({
                position: new google.maps.LatLng(40.6984237, -73.9890044),
                map: map,
                icon: new google.maps.MarkerImage(
                    'assets_site/images/marker-new.png',
                    null,
                    null,
                    // new google.maps.Point(0,0),
                    null,
                    new google.maps.Size(36, 36)
                ),
                draggable: true,
                animation: google.maps.Animation.DROP,
            });

            google.maps.event.addListener(newMarker, "mouseup", function (event) {
                var latitude = this.position.lat();
                var longitude = this.position.lng();
                $('#latitude').text(this.position.lat());
                $('#longitude').text(this.position.lng());
            });
        }

        addMarkers(props, map);
    }, 300);

    // functionality for autocomplete address field
    if ($('#address').length > 0) {
        var address = document.getElementById('address');
        var addressAuto = new google.maps.places.Autocomplete(address);

        google.maps.event.addListener(addressAuto, 'place_changed', function () {
            var place = addressAuto.getPlace();

            if (!place.geometry) {
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
            }
            newMarker.setPosition(place.geometry.location);
            newMarker.setVisible(true);
            $('#latitude').text(newMarker.getPosition().lat());
            $('#longitude').text(newMarker.getPosition().lng());

            return false;
        });
    }

    // functionality for map manipulation icon on mobile devices
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

            if (map) {
                google.maps.event.trigger(map, 'resize');
            }

            $('.commentsFormWrapper').width($('#content').width());
        }, 300);

    });
})(jQuery);