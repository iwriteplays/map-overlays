<?php global $m; ?>
<script>


<?php if ( have_rows( 'education','interactive_map' ) ) : $i = 0;  ?>
    var schools = [
    <?php while ( have_rows( 'education','interactive_map' ) ) : the_row(); $i++; ?>
        ['<?php echo esc_textarea(get_sub_field( 'name' )); ?>',<?php the_sub_field( 'latitude' ); ?>,<?php the_sub_field( 'longitude' ); ?>,<?php echo $i ?>, '<div class="info text-bold"><span class=""><?php echo esc_textarea(get_sub_field( 'name' )); ?></span></div>'],
    <?php endwhile; ?>
];
<?php endif; ?>

<?php if ( have_rows( 'employers','interactive_map' ) ) :  ?>
    var employers = [
    <?php while ( have_rows( 'employers','interactive_map' ) ) : the_row(); $i++; ?>
        ['<?php echo esc_textarea(get_sub_field( 'name' )); ?>',<?php the_sub_field( 'latitude' ); ?>,<?php the_sub_field( 'longitude' ); ?>,<?php echo $i ?>, '<div class="info text-bold"><span class=""><?php echo esc_textarea(get_sub_field( 'name' )); ?></span></div>'],
    <?php endwhile; ?>
];
<?php endif; ?>

<?php if ( have_rows( 'poi','interactive_map' ) ) :  ?>
    var pois = [
    <?php while ( have_rows( 'poi','interactive_map' ) ) : the_row(); $i++; ?>
        ['<?php echo esc_textarea(get_sub_field( 'name' )); ?>',<?php the_sub_field( 'latitude' ); ?>,<?php the_sub_field( 'longitude' ); ?>,<?php echo $i ?>, '<div class="info text-bold"><span class=""><?php echo esc_textarea(get_sub_field( 'name' )); ?></span></div>'],
    <?php endwhile; ?>
];
<?php endif; ?>

var edmarkers = [];
var employermarkers = [];
var poimarkers = [];

function setEdMarkers(map) {
    $("#map-copy-education").addClass("active");
        var edOff = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-education.png',
             scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };
        var edOn = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-education-hover.png',
             scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };

        var infowindow = new google.maps.InfoWindow();


        for (var i = 0; i < schools.length; i++) {
            var school = schools[i];
            var edmarker = new google.maps.Marker({
                position: {
                    lat: school[1],
                    lng: school[2]
                },
                map: map,
                icon: edOff,
                title: school[0],
                zIndex: school[3]
            });
            edmarkers.push(edmarker);
            var infowindow;
            google.maps.event.addListener(edmarker, 'mouseover', function() {
                this.setIcon(edOn);
            });
            google.maps.event.addListener(edmarker, 'mouseout', function() {
                this.setIcon(edOff);
                infowindow.close(map, edmarker);
            });


            google.maps.event.addListener(edmarker, 'mouseover', (function(edmarker, i) {
                return function() {
                    infowindow.setContent(schools[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, edmarker);


                }
            })(edmarker, i));

        }
    }


function setEmpMarkers(map) {
    $("#map-copy-employers").addClass("active");

        var empOff = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-employer.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };
        var empOn = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-employer-hover.png',
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };

        var infowindow = new google.maps.InfoWindow();


        for (var i = 0; i < employers.length; i++) {
            var employer = employers[i];
            var employermarker = new google.maps.Marker({
                position: {
                    lat: employer[1],
                    lng: employer[2]
                },
                map: map,
                icon: empOff,
                title: employer[0],
                zIndex: employer[3]
            });
            employermarkers.push(employermarker);
            var infowindow;
            google.maps.event.addListener(employermarker, 'mouseover', function() {
                this.setIcon(empOn);
            });
            google.maps.event.addListener(employermarker, 'mouseout', function() {
                this.setIcon(empOff);
                infowindow.close(map, employermarker);
            });


            google.maps.event.addListener(employermarker, 'mouseover', (function(employermarker, i) {
                return function() {
                    infowindow.setContent(employers[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, employermarker);


                }
            })(employermarker, i));

        }
    }


function setPOIMarkers(map) {
    $("#map-copy-poi").addClass("active");

        var poiOff = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-interest.png',
            //size: new google.maps.Size(80, 80),
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };
        var poiOn = {
            url: '<?php echo get_template_directory_uri(); ?>/img/vectors/map/pin-interest-hover.png',
             //size: new google.maps.Size(80, 80),
            scaledSize: new google.maps.Size(40, 50),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 50)
        };

        var infowindow = new google.maps.InfoWindow();


        for (var i = 0; i < pois.length; i++) {
            var poi = pois[i];
            var poimarker = new google.maps.Marker({
                position: {
                    lat: poi[1],
                    lng: poi[2]
                },
                map: map,
                icon: poiOff,
                title: poi[0],
                zIndex: poi[3]
            });
            poimarkers.push(poimarker);
            var infowindow;
            google.maps.event.addListener(poimarker, 'mouseover', function() {
                this.setIcon(poiOn);
            });
            google.maps.event.addListener(poimarker, 'mouseout', function() {
                this.setIcon(poiOff);
                infowindow.close(map, poimarker);
            });


            google.maps.event.addListener(poimarker, 'mouseover', (function(poimarker, i) {
                return function() {
                    infowindow.setContent(pois[i][4]);
                    infowindow.setOptions({
                        maxWidth: 300
                    });

                    infowindow.open(map, poimarker);


                }
            })(poimarker, i));

        }
    }



    // initialize Asheville MSA map

    function initMapMSA() {
        resetAllStates();
        map = new google.maps.Map(document.getElementById("map-canvas-<?php echo $m; ?>"), {
            zoom: 10,
            center: {
                lat: 35.538851,
                lng: -82.7054901
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
                lat: 35.5951,
                lng: -82.5515
            },
            title: "Fort Sumter National Monument",

            icon: iconimage
        });
        var imageBounds = {
            north: 36.718630,
            south: 34.549939,
            east: -79.199065,
            west: -84.490086
        };

        countiesOverlay = new google.maps.GroundOverlay(
            '<?php echo get_template_directory_uri(); ?>/img/vectors/map/counties.svg',
            imageBounds);
      transportationOverlay = new google.maps.GroundOverlay(
            '<?php echo get_template_directory_uri(); ?>/img/vectors/map/roads-rail-cropped.svg',
            imageBounds);


        countiesOverlay.setMap(map);

           google.maps.event.addListener(map, 'zoom_changed', function() {
                if((educationActive == true)){
                setEdMarkers(map);
                }
                if(employersActive == true){
                    setEmpMarkers(map);
                }
                if(poiActive == true){
                    setPOIMarkers(map);
                }

            });


    }



</script>
