<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypeCategories', 'Grafik_Functions_Shortcode_TypeCategories' );
	function Grafik_Functions_Shortcode_TypeCategories( $atts, $content = '' ) {

		global $wp_query;
		global $GRAFIK_MODE;
		$callback_output = '';

		$a = shortcode_atts( array(
			'type' => 'post',
			'class' => '',
			'id' => ''
		), $atts, 'TypeCategories' );

		// Construct the query...
		$callback_query = new WP_Query( array(
			'post_type' => $a[ 'type' ]
			, 'posts_per_page' => -1
		) );

		// Loop the query...
		$callback_categories = array();
		if( $callback_query->have_posts() ) {
			while( $callback_query->have_posts() ) {
				$callback_query->the_post();
				$callback_post = get_post();
				$callback_postcats = wp_get_post_categories( $callback_post->ID );
				foreach( $callback_postcats as $key => $val ) {
					$callback_categories[ $val ] ++;
				}
			}
			wp_reset_postdata();
		} else {
			$callback_output .= '<span class="empty-message">'.$a['empty_msg'].'</span>';
		}

		// Loop the results...
		foreach( $callback_categories as $key => $val ) {
			$callback_output .=
			'<li class="ge-typecategories-item">'.
				'<a href="'.esc_url( get_category_link( $key ) ).'" class="ge-typecategories-link">'.
					'<span class="ge-typecategories-name">'.get_cat_name( $key ).'</span>'.
					'<span class="ge-typecategories-count">'.$val.'</span>'.
				'</a>'.
			'</li>';
		}

		if( empty( $callback_output ) ) return '';

		return
		'<div class="ge-typecategories-container'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			'<div class="ge-typecategories-content">'.$content.'</div>'.
			'<ul class="ge-typecategories-list">'.$callback_output.'</ul>'.
		'</div>';

	}

?>