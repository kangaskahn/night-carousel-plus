<?php

/*======================================
=            ENQUEUE ASSETS            =
======================================*/

//* Enqueue Owl Carousel v 2.1.0
//* https://owlcarousel2.github.io/OwlCarousel2/
add_action( 'wp_enqueue_scripts', 'eq_owl_carousel', 12 );
function eq_owl_carousel() {
	wp_enqueue_style( 'owlcarouselcss', plugin_dir_url( __FILE__ ) . '../assets/css/owl.carousel.min.css', '', '', 'screen' );
	wp_enqueue_style( 'owlcarouselthemecss', plugin_dir_url( __FILE__ ) . '../assets/css/owl.theme.default.css', '', '', 'screen' );
	wp_enqueue_script( 'owlcarouseljs', plugin_dir_url( __FILE__ ) . '../assets/js/owl.carousel.min.js', '', '', '' );
}