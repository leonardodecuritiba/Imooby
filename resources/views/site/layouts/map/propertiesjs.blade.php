<script>
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
</script>