<?php
/**
 * Plugin Name:mosiichuk_hw5
 * Plugin URI: http://mosiichuk.mifist.in.ua
 * Description: gmap
 * Version: 1.0
 * Author: Mosiichuk_Dmytro
 */
add_shortcode( 'gmap', 'g_map' );
function g_map( $args ) {
	$args = shortcode_atts( array(
		'lat'    => '44.6000',
		'lng'    => '-110.5000',
		'zoom'   => '2',
		'height' => '80vh'
	), $args, 'gmap' );


	$id = substr( sha1( "Google Map" . time() ), rand( 2, 10 ), rand( 5, 8 ) );
	ob_start();
	?>
	<div class='gmap' style='height:<?php echo $args['height'] ?>; margin-bottom: 1.6842em' id='gmap-<?php echo $id ?>'></div>

	<script type='text/javascript'>
	var map;
	function initMap() {
	  map = new google.maps.Map(document.getElementById('gmap-<?php echo $id ?>'), {
	    center: {lat: <?php echo $args['lat'] ?>, lng: <?php echo $args['lng'] ?>},
	    zoom: <?php echo $args['zoom'] ?>
	  });
	}
	</script>

	<?php
	$output = ob_get_clean();
	return $output;
}


add_action( 'admin_enqueue_scripts', 'g_enqueue_assets' );
function mgms_enqueue_assets() {
	wp_enqueue_script( 
	  'google-maps', 
	  '//maps.googleapis.com/maps/api/js?key=AIzaSyBCX1ptR__gcHDVyBV1qVYG6htmMsi-hsE&callback=initMap',
	  array(), 
	  '1.0', 
	  true 
	);
}
