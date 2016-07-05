<?php
/**
* Plugin Name: Owl Carousel Plus
* Plugin URI: http://labs.mattvona.com
* Description: Easy Manager for the Owl Carousel Jquery Plugin
* Version: 1.1.0
* Author: Matt Vona
* Author URI: http://labs.mattvona.com
* License: tba
*/

/* Add Enqueue Owl Carousel Assets */
require "src/ocp-enqueue.php";

/* Add Owl Carousel Slide Custom Post Type */
require "src/ocp-cpt-owl-slides.php";

/* Add OWl Carousel Slide Carousel Options and Meta */
require "src/ocp-carousel-options.php";

/* Add OWl Carousel Slide Carousel Options and Meta */
require "src/ocp-shortcodes.php";

/* Set Post thumbnails for OCP Slides */
add_theme_support( 'post-thumbnails', array('ocp-slides') );