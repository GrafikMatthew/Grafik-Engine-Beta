<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypeAuthors', 'Grafik_Functions_Shortcode_TypeAuthors' );
	function Grafik_Functions_Shortcode_TypeAuthors( $atts, $content = '' ) {

		global $wp_query;
		global $GRAFIK_MODE;

		$a = shortcode_atts( array(
			'type' => 'post',
			'class' => '',
			'id' => ''
		), $atts, 'TypeArchive' );

		// Construct the query...
		$callback_query = new WP_Query( array(
			'post_type' => $a[ 'type' ]
			, 'posts_per_page' => -1
		) );

		// Loop the query...
		$callback_authors = array();
		if( $callback_query->have_posts() ) {
			while( $callback_query->have_posts() ) {
				$callback_query->the_post();
				$callback_post = get_post();
				$callback_authors[ $callback_post->post_author ] ++;
			}
			wp_reset_postdata();
		} else {
			$callback_output .= '<span class="empty-message">'.$a['empty_msg'].'</span>';
		}

		$callback_output = '<!-- '.print_r( $callback_authors, true).' -->';

		return
		'<div class="theme-typeauthors'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			$callback_output.
		'</div>';

	}

?>