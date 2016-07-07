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

	//* Set Term if the carousel flag is set
	if ($carousel) {
		$termID = get_term_by('name', $carousel, 'ocp-carousel')->term_id;
	}

	//* Hook the javascript for the slider
	add_action( 'wp_footer', function() use ( $carousel ) {
			ocp_carouselScript($carousel); 
	});

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
			
			//* Run the custom filter function
			echo ocp_filter(get_option( "taxonomy_$termID" )['ocp_custom_options']['slider_template'], $ocpSlideQuery->post);
			$i++;
		} 
		wp_reset_postdata();
?>
		</div>
<?php
	} else {
		// no posts found
		echo "No slides found in this carousel.";
	}

	// Restore original Post Data
	wp_reset_query();
	$output = ob_get_clean();
	return $output;
}

//* Generates javascript
function ocp_carouselScript($id, $options) {
		$script = "";
		if ($id) { 
			$options = get_option( "taxonomy_$id" )['ocp_custom_options']['slider_settings'];
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
function ocp_filter($string, $post) { 
	$string = str_replace("{{title}}", $post->post_title,$string); 
	$string = str_replace("{{content}}", $post->post_content,$string); 
	$string = str_replace("{{excerpt}}", $post->post_excerpt,$string); 
	$string = str_replace("{{id}}", $post->ID,$string); 
	$string = str_replace("{{featured-image}}", ocp_get_the_post_thumbnail_url($post->ID), $string);
	return $string;
}

//* Returns the Post thumbnail URL
function ocp_get_the_post_thumbnail_url($id) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id, '', true);
	return $thumb_url[0];
}