<?php
/*===============================================
=            Owl Carousel Shortcodes            =
===============================================*/

add_shortcode( 'night-carousel-plus', 'ncp_customCarouselShortcode' );

// Add Shortcode
function ncp_customCarouselShortcode( $atts ) {
	ob_start();

	// Attributes
	$atts = shortcode_atts(
		array(
			'carousel' => null,
			'limit' => '-1',
		),
		$atts
	);
	extract($atts);

	//* Set Term if the carousel flag is set
	if ($carousel != null) {
		$termID = get_term_by('name', $carousel, 'ncp-carousel');
		if (!isset($termID->term_id)) {
			return "The carousel does not exist.";
		}
	} 

	//* Hook the javascript for the slider
	add_action( 'wp_footer', function() use ( $carousel ) {
			ncp_carouselScript($carousel); 
	});

	// WP_Query arguments
	$args = array (
		'post_type'              => array( 'ncp-slides' ),
		'posts_per_page'         => $limit,
		'tax_query' => array(
				array(
					'taxonomy' => 'ncp-carousel',
					'field'    => 'slug',
					'terms'    => $carousel,
				),
		),
	);

	// The Query
	$ncpSlideQuery = new WP_Query( $args );

	// The Loop
	if ( $ncpSlideQuery->have_posts() ) {
		$i = 0; ?>
		<div class="owl-carousel <?php if ($carousel) { echo 'owl-carousel-'.$carousel; } ?>">
		<?php while ( $ncpSlideQuery->have_posts() ) {
			$ncpSlideQuery->the_post();
			
			//* Run the custom filter function
			echo ncp_filter(get_option( "taxonomy_$termID->term_id" )['ncp_custom_options']['slider_template'], $ncpSlideQuery->post);
			$i++;
		} 
		wp_reset_postdata();
?>
		</div>
<?php
	} else {
		// no posts found
		echo "The carousel does not exist or no slides were found.";
	}

	// Restore original Post Data
	wp_reset_query();
	$output = ob_get_clean();
	return $output;
}

//* Generates javascript
function ncp_carouselScript($id) {
		$script = "";
		if ($id) { 
			$options = get_option( "taxonomy_$id" )['ncp_custom_options']['slider_settings'];
			$script = 'jQuery(".owl-carousel-' . $id . '").owlCarousel({'. $options . '});';
		} else {
			$script = 'jQuery(".owl-carousel").owlCarousel();'; 
		} ?>
		<script type="text/javascript">
			<?php echo $script; ?>
		</script>
	<?php
}

//* Filters through html and replaces variables with content
function ncp_filter($string, $post) { 
	$string = str_replace("{{title}}", $post->post_title,$string); 
	$string = str_replace("{{content}}", $post->post_content,$string); 
	$string = str_replace("{{excerpt}}", $post->post_excerpt,$string); 
	$string = str_replace("{{id}}", $post->ID,$string); 
	$string = str_replace("{{featured-image}}", ncp_get_the_post_thumbnail_url($post->ID), $string);
	return $string;
}

//* Returns the Post thumbnail URL
function ncp_get_the_post_thumbnail_url($id) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id, '', true);
	return $thumb_url[0];
}