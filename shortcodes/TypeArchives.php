<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypeArchives', 'Grafik_Functions_Shortcode_TypeArchives' );
	function Grafik_Functions_Shortcode_TypeArchives( $atts, $content = '' ) {

		global $wp_query;
		global $GRAFIK_MODE;
		$callback_output = '';

		$a = shortcode_atts( array(
			'type' => 'post',
			'format' => 'links', // or dropdown
			'class' => '',
			'id' => ''
		), $atts, 'TypeArchives' );

		// Construct the query...
		$callback_query = new WP_Query( array(
			'post_type' => $a[ 'type' ]
			, 'posts_per_page' => -1
		) );

		// Loop the query...
		preg_match_all(
			"/<li><a[\\s]*href=[\"']([^\"']*)[\"'][^>]*>([^<]*)<\\/a>[^\\(]*\\(([^\\)]*)\\)<\\/li>/i",
			wp_get_archives( array(
				'post_type' => $a[ 'type' ],
				'type' => 'monthly',
				'show_post_count' => true,
				'echo' => 0
			) ),
			$callback_archives
		);

		// Restructure the array...
		$callback_restructured = array();
		foreach( $callback_archives as $key => $val ) {
			foreach( $val as $val_key => $val_val ) {
				$callback_restructured[ $val_key ][ $key ] = $val_val;
			}
		}
		$callback_archives = $callback_restructured;

		// Loop the results...
		foreach( $callback_archives as $key => $val ) {
			$callback_output .=
			'<li class="ge-typearchives-item">'.
				'<a href="'.esc_url( $val[ 1 ] ).'" class="ge-typearchives-link">'.
					'<span class="ge-typearchives-name">'.$val[ 2 ].'</span>'.
					'<span class="ge-typearchives-count">'.$val[ 3 ].'</span>'.
				'</a>'.
			'</li>';
		}

		if( empty( $callback_output ) ) return '';

		return
		'<div class="ge-typearchives-container'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			'<div class="ge-typearchives-content">'.$content.'</div>'.
			'<ul class="ge-typearchives-list'.( $a[ 'format' ] == 'dropdown' ? 'dropdown' : '').'">'.$callback_output.'</ul>'.
		'</div>';

	}

?>