<?php global $m; ?>

    <section class="interactive-map module module-<?php echo $m; ?>">
        <div id="map-canvas-<?php echo $m; ?>" class="map-canvas"></div>

        <div id="map-navigation">
            <div class="inner">
                <div class="item map-buttons">

                    <ul class="nav nav-tabs" id="" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="eastern-us" data-toggle="tab" href="#eastern-tab" role="tab" aria-controls="home" aria-selected="true">Eastern US</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="asheville-msa" data-toggle="tab" href="#ash-tab" role="tab" aria-controls="profile" aria-selected="false">Asheville MSA</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="eastern-tab" role="tabpanel" aria-labelledby="home-tab">
                            <div class="toggles">
                                <!--<a href="" class="toggle-map-data" data-toggle="circles">Distance</a>-->
                                <a href="" class="toggle-map-data" data-toggle="cities"><i class="icon-map-pin"></i>Major Cities</a>
                                <a href="" class="toggle-map-data" data-toggle="airports"><i class="icon-map-plane"></i>Airports</a>
                                <a href="" class="toggle-map-data" data-toggle="ports"><i class="icon-map-anchor"></i>Ports</a>
                            </div>


                        </div>
                        <div class="tab-pane fade show active" id="ash-tab" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="toggles">
                                <a href="" class="toggle-map-data" data-toggle="rails-road"> <i class="icon-map-map"></i>Transportation</a>
                                <a href="" class="toggle-map-data" data-toggle="education"> <i class="icon-map-education"></i>Educational Institutions</a>
                                <a href="" class="toggle-map-data" data-toggle="employers"> <i class="icon-map-id"></i>Major Employers</a>
                                <a href="" class="toggle-map-data" data-toggle="poi"> <i class="icon-map-star"></i>Points of Interest</a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="item map-description">
                    <?php get_template_part('inc/_map/map-copy'); ?>
                </div>
            </div>
        </div>


    </section>
    <script src="<?php echo get_template_directory_uri(); ?>/inc/_map/map-global.js"></script>

 <?php get_template_part('inc/_map/msa-map'); ?>
    <?php get_template_part('inc/_map/eastern-map'); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=XXXXXX" type="text/javascript"></script>
    <script>
    $( document ).ready(function() {
         MSAIntial();
    });

        $("section.interactive-map .toggles").on("click", ".toggle-map-data", function(e) {
            e.preventDefault();
            toggleOverlay($(this).data("toggle"));
            $("section.interactive-map .toggles .toggle-map-data.active").removeClass("active");
            $(this).addClass("active");
        });



    </script>
