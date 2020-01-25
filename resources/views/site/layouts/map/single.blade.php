<script>
    (function ($) {
        "use strict";
        // Custom options for map

        setTimeout(function () {
            $('body').removeClass('notransition');

            map = new google.maps.Map(document.getElementById('mapView'), $_GLOBAL_MAPS_API_['options']);
            var styledMapType = new google.maps.StyledMapType($_GLOBAL_MAPS_API_['styles'], {
                name: 'Styled'
            });

            map.mapTypes.set('Styled', styledMapType);
            map.setCenter(new google.maps.LatLng(40.6984237, -73.9890044));
            map.setZoom(14);
        }, 300);

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
</script>