<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypeSearch', 'Grafik_Functions_Shortcode_TypeSearch' );
	function Grafik_Functions_Shortcode_TypeSearch( $atts, $content = '' ) {

		global $wp_query;
		global $GRAFIK_MODE;

		$a = shortcode_atts( array(
			'type' => 'post',
			'placeholder' => 'Search Posts',
			'button' => 'Submit',
			'class' => '',
			'id' => ''
		), $atts, 'TypeSearch' );

		return
		'<div class="ge-typesearch-container'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			'<div class="ge-typesearch-content">'.$content.'</div>'.
			'<form role="search" method="GET" class="ge-typesearch-form" action="'.home_url( '/' ).'">'.
				'<input type="hidden" name="post_type" value="'.$a[ 'type' ].'" />'.
				'<input class="ge-typesearch-field" name="s" type="search" placeholder="'.$a[ 'placeholder' ].'" value="'.get_search_query().'" />'.
				'<button type="submit" class="ge-typesearch-submit">'.$a[ 'button' ].'</button>'.
			'</form>'.
		'</div>';

	}

?>