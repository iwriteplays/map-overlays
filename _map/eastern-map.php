<?php global $m; ?>
    <script>
    // initialize Eastern US Map
        function initMapEast() {



            resetAllStates();
            map = new google.maps.Map(document.getElementById("map-canvas-<?php echo $m; ?>"), {
                zoom: 5,
                center: {
                     lat: (47.550691+24.076916)/2,
                    lng: (-59.179040 + -103.851549)/2
                },
                backgroundColor: "#fcfcfc",
                scrollwheel: true,
                fullscreenControl: true,
                fullscreenControlOptions: true,
                rotateControl: true,
                rotateControlOptions: true,
                tilt: 45,
                styles: globalStyles
            });
            var iconimage = {
                url: "<?php echo get_template_directory_uri(); ?>/img/vectors/map/map-marker.png",
                size: new google.maps.Size(40, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(20, 50)
            };

            var marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: 35.538851,
                    lng: -82.7054901
                },
                title: "Asheville",

                icon: iconimage
            });
            var imageBounds = {
                north: 49.060691,
                south: 24.076916,
                east: -59.579040,
                west: -103.851549
            };


            ringsOverlay = new google.maps.GroundOverlay(
                '<?php echo get_template_directory_uri(); ?>/img/vectors/map/map-radius.png',
                imageBounds);

            ringsOverlay.setMap(map);
            circlesActive = true;



            google.maps.event.addListener(map, 'zoom_changed', function() {
                if((citiesActive == true)){
                setMarkers(map);
                }
                if(airportsActive == true){
                    setAirportMarkers(map);
                }
                if(portsActive == true){
                    setPortMarkers(map);
                }

            });

        }



<?php if ( have_rows( 'major_cities','interactive_map' ) ) : $i = 0; ?>
    var cities = [
    <?php while ( have_rows( 'major_cities','interactive_map' ) ) : the_row(); $i++; ?>
        ['<?php echo esc_textarea(get_sub_field( 'city_name' )) ?>',<?php the_sub_field( 'latitude' ); ?>,<?php the_sub_field( 'longitude' ); ?>,<?php echo $i ?>, '<div class="info text-bold"><span class=""><?php echo esc_textarea(get_sub_field( 'city_name' )); ?></span></div>'],
    <?php endwhile; ?>
];
<?php endif; ?>

<?php if ( have_rows( 'airports','interactive_map' ) ) :  ?>
    var airports = [
    <?php while ( have_rows( 'airports','interactive_map' ) ) : the_row(); $i++; ?>
        ['<?php echo esc_textarea(get_sub_field( 'name' )) ?>',<?php the_sub_field( 'latitude' ); ?>,<?php the_sub_field( 'longitude' ); ?>,<?php echo $i ?>, '<div class="info text-bold"><span class=""><?php echo esc_textarea(get_sub_field( 'name' )); ?></span></div>'],
    <?php endwhile; ?>
];
<?php endif; ?>
<?php if ( have_rows( 'ports','interactive_map' ) ) :  ?>
    var ports = [
    <?php while ( have_rows( 'ports','interactive_map' ) ) : the_row(); $i++; ?>
        ['<?php echo esc_textarea(get_sub_field( 'name' )) ?>',<?php the_sub_field( 'latitude' ); ?>,<?php the_sub_field( 'longitude' ); ?>,<?php echo $i ?>, '<div class="info text-bold"><span class=""><?php echo esc_textarea(get_sub_field( 'name' )); ?></span></div>'],
    <?php endwhile; ?>
];
<?php endif; ?>

var citymarkers = [];
var airportmarkers = [];
var portmarkers = [];
function setMarkers(map) {
                    $("#map-copy-cities").addClass("active");

        var image = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-city.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };
        var image2 = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-city-hover.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };

        var infowindow = new google.maps.InfoWindow();


        for (var i = 0; i < cities.length; i++) {
            var city = cities[i];
            var citymarker = new google.maps.Marker({
                position: {
                    lat: city[1],
                    lng: city[2]
                },
                map: map,
                icon: image,
                title: city[0],
                zIndex: city[3]
            });
            citymarkers.push(citymarker);
            var infowindow;
            google.maps.event.addListener(citymarker, 'mouseover', function() {
                this.setIcon(image2);
            });
            google.maps.event.addListener(citymarker, 'mouseout', function() {
                this.setIcon(image);
                infowindow.close(map, citymarker);
            });


            google.maps.event.addListener(citymarker, 'mouseover', (function(citymarker, i) {
                return function() {
                    infowindow.setContent(cities[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, citymarker);


                }
            })(citymarker, i));

        }
    }

function setAirportMarkers(map) {
                    $("#map-copy-airports").addClass("active");

        var airportOff = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-airport.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };
        var airportOn = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-airport-hover.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };

        var infowindow = new google.maps.InfoWindow();


        for (var i = 0; i < airports.length; i++) {
            var airport = airports[i];
            var airportmarker = new google.maps.Marker({
                position: {
                    lat: airport[1],
                    lng: airport[2]
                },
                map: map,
                icon: airportOff,
                title: airport[0],
                zIndex: airport[3]
            });
            airportmarkers.push(airportmarker);
            var infowindow;
            google.maps.event.addListener(airportmarker, 'mouseover', function() {
                this.setIcon(airportOn);
            });
            google.maps.event.addListener(airportmarker, 'mouseout', function() {
                this.setIcon(airportOff);
                infowindow.close(map, airportmarker);
            });


            google.maps.event.addListener(airportmarker, 'mouseover', (function(airportmarker, i) {
                return function() {
                    infowindow.setContent(airports[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, airportmarker);


                }
            })(airportmarker, i));

        }
    }


function setPortMarkers(map) {
                    $("#map-copy-ports").addClass("active");

        var portOff = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-port.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };
        var portOn = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-port-hover.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };

        var infowindow = new google.maps.InfoWindow();


        for (var i = 0; i < ports.length; i++) {
            var port = ports[i];
            var portmarker = new google.maps.Marker({
                position: {
                    lat: port[1],
                    lng: port[2]
                },
                map: map,
                icon: portOff,
                title: port[0],
                zIndex: port[3]
            });
            portmarkers.push(portmarker);
            var infowindow;
            google.maps.event.addListener(portmarker, 'mouseover', function() {
                this.setIcon(portOn);
            });
            google.maps.event.addListener(portmarker, 'mouseout', function() {
                this.setIcon(portOff);
                infowindow.close(map, portmarker);
            });


            google.maps.event.addListener(portmarker, 'mouseover', (function(portmarker, i) {
                return function() {
                    infowindow.setContent(ports[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, portmarker);


                }
            })(portmarker, i));

        }
    }
</script>
