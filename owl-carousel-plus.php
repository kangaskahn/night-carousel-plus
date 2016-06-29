<?php
/**
* Plugin Name: Owl Carousel Plus
* Plugin URI: http://labs.mattvona.com
* Description: Easy Manager for the Owl Carousel Jquery Plugin
* Version: 0.1.0
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