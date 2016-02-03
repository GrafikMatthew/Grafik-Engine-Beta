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
		$callback_output = '';

		$a = shortcode_atts( array(
			'type' => 'post',
			'class' => '',
			'id' => ''
		), $atts, 'TypeAuthors' );

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

		// Loop the results...
		foreach( $callback_authors as $key => $val ) {
			$callback_output .=
			'<li class="ge-typeauthors-item">'.
				'<a href="'.esc_url( get_author_posts_url( $key ) ).'" class="ge-typeauthors-link">'.
					'<span class="ge-typeauthors-name">'.get_the_author_meta( 'display_name', $key ).'</span>'.
					'<span class="ge-typeauthors-count">'.$val.'</span>'.
				'</a>'.
			'</li>';
		}

		if( empty( $callback_output ) ) return '';

		return
		'<div class="ge-typeauthors-container'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			'<div class="ge-typeauthors-content">'.$content.'</div>'.
			'<ul class="ge-typeauthors-list">'.$callback_output.'</ul>'.
		'</div>';

	}

?>