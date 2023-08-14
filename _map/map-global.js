var map,
    overlay,
    roadsActive,
    citiesActive,
    airportsActive,
    employersActive,
    poiActive,
    educationActive,
    portsActive,
    circlesActive;

function resetAllStates() {


    roadsActive = false;
    circlesActive = false;
    citiesActive = false;
    airportsActive = false;
    portsActive = false;
    educationActive = false;
    employersActive = false;
    poiActive = false;

    $("section.interactive-map .toggles .toggle-map-data.active").removeClass("active");
    $(".map-description .item").removeClass("active");

    setCityMarkers(null);
    setAirportMarkersLive(null);
    setPortMarkersLive(null);
    setEdMarkersLive(null);
    setEmpMarkersLive(null);
    setPOIMarkersLive(null);



}

var globalStyles = [{
        featureType: "all",
        elementType: "labels.text.fill",
        stylers: [{
                saturation: 36
                            },
            {
                color: "#333333"
                            },
            {
                lightness: 40
                            }
                        ]
                    },
    {
        featureType: "all",
        elementType: "labels.text.stroke",
        stylers: [{
                visibility: "on"
                            },
            {
                color: "#ffffff"
                            },
            {
                lightness: 16
                            }
                        ]
                    },
    {
        featureType: "all",
        elementType: "labels.icon",
        stylers: [{
            visibility: "off"
                        }]
                    },
    {
        featureType: "administrative",
        elementType: "geometry.fill",
        stylers: [{
                color: "#fefefe"
                            },
            {
                lightness: 20
                            }
                        ]
                    },
    {
        featureType: "administrative",
        elementType: "geometry.stroke",
        stylers: [{
                color: "#fefefe"
                            },
            {
                lightness: 17
                            },
            {
                weight: 1.2
                            }
                        ]
                    },
    {
        featureType: "landscape",
        elementType: "geometry",
        stylers: [{
                color: "#f5f5f5"
                            },
            {
                lightness: 20
                            }
                        ]
                    },
    {
        featureType: "poi",
        elementType: "geometry",
        stylers: [{
                color: "#f5f5f5"
                            },
            {
                lightness: 21
                            }
                        ]
                    },
    {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [{
                color: "#dedede"
                            },
            {
                lightness: 21
                            }
                        ]
                    },
    {
        featureType: "road.highway",
        elementType: "geometry.fill",
        stylers: [{
                color: "#88c44f"
                            },
            {
                lightness: 17
                            }
                        ]
                    },
    {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [{
                color: "#b0c5ad"
                            },
            {
                lightness: 29
                            },
            {
                weight: 0.2
                            },
            {
                visibility: "off"
                            }
                        ]
                    },
    {
        featureType: "road.arterial",
        elementType: "geometry",
        stylers: [{
                color: "#ffffff"
                            },
            {
                lightness: 0
                            }
                        ]
                    },
    {
        featureType: "road.local",
        elementType: "geometry",
        stylers: [{
                color: "#ffffff"
                            },
            {
                lightness: 0
                            }
                        ]
                    },
    {
        featureType: "transit",
        elementType: "geometry",
        stylers: [{
                color: "#f2f2f2"
                            },
            {
                lightness: 19
                            }
                        ]
                    },
    {
        featureType: "water",
        elementType: "geometry",
        stylers: [{
                color: "#e9e9e9"
                            },
            {
                lightness: 17
                            }
                        ]
                    }
                ];


function MSAIntial() {
    initMapMSA();
    transportationOverlay.setMap(map);
    $(".toggle-map-data[data-toggle=rails-road]").addClass("active");
    $("#map-copy-transportation").addClass("active");
    roadsActive = true;

}

function EastInitial() {
    initMapEast();
    $(".toggle-map-data[data-toggle=cities]").addClass("active");
    $("#map-copy-cities").addClass("active");
    setMarkers(map);
    citiesActive = true;

}

  // Control the city markers in the array.
        function setCityMarkers(map) {
            for (var i = 0; i < citymarkers.length; i++) {
                citymarkers[i].setMap(map);
            }
        }
        // Control the airport markers in the array.
        function setAirportMarkersLive(map) {
            for (var i = 0; i < airportmarkers.length; i++) {
                airportmarkers[i].setMap(map);
            }
        }

        // Control the airport markers in the array.
        function setPortMarkersLive(map) {
            for (var i = 0; i < portmarkers.length; i++) {
                portmarkers[i].setMap(map);
            }
        }
        // Control the education markers in the array.
        function setEdMarkersLive(map) {
            for (var i = 0; i < edmarkers.length; i++) {
                edmarkers[i].setMap(map);
            }
        }
        // Control the employers markers in the array.
        function setEmpMarkersLive(map) {
            for (var i = 0; i < employermarkers.length; i++) {
                employermarkers[i].setMap(map);
            }
        }
        // Control the poi markers in the array.
        function setPOIMarkersLive(map) {
            for (var i = 0; i < poimarkers.length; i++) {
                poimarkers[i].setMap(map);
            }
        }


        function toggleOverlay(e) {
            if (e == 'rails-road') {
                if (roadsActive == false) {
                    resetAllStates();
                    $("#map-copy-transportation").addClass("active");
                    transportationOverlay.setMap(map);
                    roadsActive = true;

                }

            } else if (e == 'cities') {
                if (citiesActive == false) {
                    resetAllStates();
                    setMarkers(map);
                    citiesActive = true;

                }

            } else if (e == 'airports') {
                if (airportsActive == false) {
                    resetAllStates();
                    setAirportMarkers(map);
                    airportsActive = true;

                }
            } else if (e == 'ports') {
                if (portsActive == false) {
                    resetAllStates();
                    setPortMarkers(map);
                    portsActive = true;

                }
            }
            // MSA options
            else if (e == 'education') {
                if (educationActive == false) {
                    if (roadsActive == true) {
                        transportationOverlay.setMap(null);
                    }
                    resetAllStates();
                    setEdMarkers(map);
                    educationActive = true;

                }
            } else if (e == 'employers') {
                if (employersActive == false) {
                    if (roadsActive == true) {
                        transportationOverlay.setMap(null);
                    }
                    resetAllStates();
                    setEmpMarkers(map);
                    employersActive = true;

                }
            } else if (e == 'poi') {
                if (poiActive == false) {

                    if (roadsActive == true) {
                        transportationOverlay.setMap(null);
                    }
                    resetAllStates();
                    setPOIMarkers(map);
                    poiActive = true;

                }
            }

        }


        $("#asheville-msa").on("show.bs.tab", function(e) {
            MSAIntial();

        });

        $("#eastern-us").on("show.bs.tab", function(e) {
            EastInitial();

        });
