<?php $copyarray = array(
        'cities' => 'Eastern US',
        'airports' => 'Eastern US',
        'ports' => 'Eastern US',
        'transportation' => 'Asheville MSA',
        'education' => 'Asheville MSA',
        'employers' => 'Asheville MSA',
        'poi' => 'Asheville MSA'
    ); ?>


<?php foreach( $copyarray as $c => $type) { ?>
<div id="map-copy-<?php echo $c; ?>" class="item">
    <h4 class="subtitle"><?php echo $type; ?></h4>
    <h2><?php the_field($c . "_headline","interactive_map"); ?></h2>
    <div class="content">
        <?php the_field($c . "_copy","interactive_map"); ?>
    </div>
</div>
<?php } ?>
