<?php
/*===============================================
=            Owl Carousel Shortcodes            =
===============================================*/

add_shortcode( 'owl-carousel-plus', 'ocp_customCarouselShortcode' );

// Add Shortcode
function ocp_customCarouselShortcode( $atts ) {
	ob_start();

	// Attributes
	$atts = shortcode_atts(
		array(
			'carousel' => '',
			'limit' => '-1',
		),
		$atts
	);

	extract($atts);

	if ($carousel) {
		$termID = get_term_by('name', $carousel, 'ocp-carousel')->term_id;
	}


	add_action( 'wp_footer', 
		function() use ( $carousel ) {
			ocp_carouselScript($carousel); });

	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'ocp-slides' ),
		'posts_per_page'         => $limit,
		'tax_query' => array(
				array(
					'taxonomy' => 'ocp-carousel',
					'field'    => 'slug',
					'terms'    => $carousel,
				),
		),
	);

	// The Query
	$ocpSlideQuery = new WP_Query( $args );

	// The Loop
	if ( $ocpSlideQuery->have_posts() ) {
		$i = 0; ?>
		<div class="owl-carousel <?php if ($carousel) { echo 'owl-carousel-'.$carousel; } ?>">
		<?php while ( $ocpSlideQuery->have_posts() ) {
			$ocpSlideQuery->the_post(); 
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );	?>
			<div class="item">
				<?php the_title(); ?>
			</div>
<?php	
			$i++;
		} ?>
		</div>
<?php
	} else {
		// no posts found
		echo "No slides found in this carousel.";
	}

	// Restore original Post Data
	wp_reset_postdata();

	//wp_reset_query();
	$output = ob_get_clean();
	return $output;
}

function ocp_carouselScript($id, $options) {
		$script = "";
		if ($id) { 
			$options = get_option( "taxonomy_$id" )['custom_options'];
			$script = 'jQuery(".owl-carousel-' . $id . '").owlCarousel({'. $options . '});';
		} else {
			$script = 'jQuery(".owl-carousel").owlCarousel();'; 
		} ?>
		<script type="text/javascript">
			<?php echo $script; ?>
		</script>
	<?php
}
