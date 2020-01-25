        var address = document.getElementById('buscar');
        var options_autocomplete = {
            types: ['geocode'],
            componentRestrictions: {country:'BR'}
        };

        function submitForm(pos) {
            var location = "<input type='text' name='lat' value='" + pos.lat() + "'>";
            location += "<input type='text' name='lng' value='" + pos.lng() + "'>";
            $('{{Form::open(['route' =>'buscar-imoveis', 'method' => 'GET'])}}')
                .append("<input type='text' name='busca' value='" + address.value + "'>")
                .append(location)
                .append("{{Form::close()}}")
                .appendTo('body').submit();
            return false;
        }
        $(document).ready(function () {
            // functionality for autocomplete address field
            google.maps.event.addDomListener(window, 'load', function() {
                (function(input, opts, nodes) {
                    var autocomplete = new google.maps.places.Autocomplete(input, opts);

                    google.maps.event.addDomListener(input, 'keydown', function(e) {
                        if (e.keyCode === 13 && !e.triggered) {
                            google.maps.event.trigger(this, 'keydown', {
                                keyCode: 40
                            })
                            google.maps.event.trigger(this, 'keydown', {
                                keyCode: 13,
                                triggered: true
                            })
                        }
                    });
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        if (!place.geometry) {
                            return false;
                        }
                        submitForm(place.geometry.location);
                        return false;
                    });
                    for (var n = 0; n < nodes.length; ++n) {
                        google.maps.event.addDomListener(nodes[n].n, nodes[n].e, function(e) {

                            google.maps.event.trigger(input, 'keydown', {
                                keyCode: 13
                            })
                        });
                    }
                }

                ( address, options_autocomplete, [{
                        n: document.getElementById('enviar_busca'),
                        e: 'click'
                    }]
                ));
            });
        });