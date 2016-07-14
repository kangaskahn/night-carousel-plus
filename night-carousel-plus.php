<?php
/**
* Plugin Name: Night Carousel Plus
* Plugin URI: http://labs.mattvona.com
* Description: Easy Manager for the Owl Carousel Jquery Plugin
* Version: 1.1.4
* Author: Matt Vona
* Author URI: http://labs.mattvona.com
* License: GPLv2
*/

/* Add Enqueue Owl Carousel Assets */
require "src/ncp-enqueue.php";

/* Add Owl Carousel Slide Custom Post Type */
require "src/ncp-cpt-owl-slides.php";

/* Add OWl Carousel Slide Carousel Options and Meta */
require "src/ncp-carousel-options.php";

/* Add OWl Carousel Slide Carousel Options and Meta */
require "src/ncp-shortcodes.php";

/* Set Post thumbnails for OCP Slides */
add_theme_support( 'post-thumbnails', array('ncp-slides') );