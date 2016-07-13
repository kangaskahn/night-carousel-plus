<?php
/*======================================================================
=            Owl Carousel Slide Carousel Custom Meta Fields            =
======================================================================*/

/*=========================================
=            TERM PAGE OPTIONS            =
=========================================*/
function ncp_OwlCarouselSlideCarousel_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[ncp_custom_options][slider_settings]"><?php _e( 'Carousel Options', 'owl-carousel-plus' ); ?></label>
		<textarea type="text" name="term_meta[ncp_custom_options][slider_settings]" id="term_meta[ncp_custom_options][slider_settings]" rows="20" cols="40">
loop:true,
margin:10,
responsiveClass:true,
responsive:{
    0:{
        items:1,
        nav:true
    },
    600:{
        items:3,
        nav:false
    },
    1000:{
        items:5,
        nav:true,
        loop:false
    }
}
		</textarea>
		<p class="description"><?php _e( 'Enter options or leave it blank. Default options have been provided. <a href="https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html" target="_blank">Use this list to explore more carousel options</a>.','owl-carousel-plus' ); ?></p>
	</div>

	<div class="form-field">
		<label for="term_meta[ncp_custom_options][slider_template]"><?php _e( 'Carousel Template', 'owl-carousel-plus' ); ?></label>
		<textarea type="text" name="term_meta[ncp_custom_options][slider_template]" id="term_meta[ncp_custom_options][slider_template]" rows="20" cols="40">
<div class="item">
	{{title}}
</div>
		</textarea>
		<p class="description"><?php _e( 'Owl Carousel Slide Template. <a href="https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html" target="_blank">Use this link for help </a>.','owl-carousel-plus' ); ?></p>
	</div>
<?php
}
//add_action( 'ncp-carousel_add_form_fields', 'ncp_OwlCarouselSlideCarousel_add_new_meta_field', 10, 2 );

/*==============================================
=            EDIT TERM PAGE OPTIONS            =
==============================================*/
function ncp_OwlCarouselSlideCarousel_edit_meta_field($term) {
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); 
 	?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[ncp_custom_options][slider_settings]"><?php _e( 'Carousel Options', 'owl-carousel-plus' ); ?></label></th>
		<td>
			<textarea type="text" name="term_meta[ncp_custom_options][slider_settings]" id="term_meta[ncp_custom_options]" rows="20" cols="40">
<?php echo esc_attr( $term_meta['ncp_custom_options']['slider_settings'] ) ? esc_attr( $term_meta['ncp_custom_options']['slider_settings'] ) : ''; ?>
			</textarea>
			<p class="description"><?php _e( 'Enter options or leave it blank. Default options have been provided. <a href="https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html" target="_blank">Use this list to explore more carousel options</a>.','owl-carousel-plus' ); ?></p>
		</td>
	</tr>
<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[ncp_custom_options][slider_template]"><?php _e( 'Carousel Template', 'owl-carousel-plus' ); ?></label></th>
		<td>
			<textarea type="text" name="term_meta[ncp_custom_options][slider_template]" id="term_meta[ncp_custom_options]" rows="20" cols="40">
<?php echo  stripslashes_deep($term_meta['ncp_custom_options']['slider_template'])  ? stripslashes_deep($term_meta['ncp_custom_options']['slider_template'])  : ''; ?>
			</textarea>
			<p class="description"><?php _e( 'The template allows you to customize the html for each slide. <a href="https://owlcarousel2.github.io/OwlCarousel2/docs/api-options.html" target="_blank">Visit the github to view more template variables and request your own! </a>.','owl-carousel-plus' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'ncp-carousel_edit_form_fields', 'ncp_OwlCarouselSlideCarousel_edit_meta_field', 10, 2 );

/*====================================
=            SAVE OPTIONS            =
====================================*/
function ncp_OwlCarouselSlideCarousel_save( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = stripslashes_deep($_POST['term_meta'][$key]);
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_ncp-carousel', 'ncp_OwlCarouselSlideCarousel_save', 10, 2 );  
add_action( 'create_ncp-carousel', 'ncp_OwlCarouselSlideCarousel_save', 10, 2 );