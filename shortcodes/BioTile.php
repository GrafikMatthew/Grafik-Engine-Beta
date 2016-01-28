<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( "BioTile", "Grafik_Functions_Shortcode_BioTile" );
	function Grafik_Functions_Shortcode_BioTile( $atts, $content = null ) {

		$a = shortcode_atts( array(
			'thumbnail' => '',
			'name' => '',
			'title' => '',
			'extra' => '',
			'fullsize' => '',
			'class' => '',
			'id' => ''
		), $atts );

		return
		'<div class="theme-biotile'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<div class="theme-biotile-preview">'.
				'<div class="theme-biotile-thumbnail">'.( empty( $a['thumbnail'] ) ? null : '<img src="'.$a['thumbnail'].'" alt="'.$a['name'].'" />' ).'</div>'.
				'<div class="theme-biotile-name">'.( empty( $a['name'] ) ? null : $a['name'] ).'</div>'.
				'<div class="theme-biotile-title">'.( empty( $a['title'] ) ? null : $a['title'] ).'</div>'.
				'<div class="theme-biotile-extra">'.( empty( $a['extra'] ) ? null : $a['extra'] ).'</div>'.
			'</div>'.
			'<div class="theme-biotile-content">'.
				'<div class="theme-biotile-content-fullsize">'.( empty( $a['fullsize'] ) ? null : '<img src="'.$a['fullsize'].'" alt="'.$a['name'].'" />' ).'</div>'.
				'<div class="theme-biotile-content-name">'.( empty( $a['name'] ) ? null : $a['name'] ).'</div>'.
				'<div class="theme-biotile-content-title">'.( empty( $a['title'] ) ? null : $a['title'] ).'</div>'.
				'<div class="theme-biotile-content-main">'.( empty( $content ) ? null : $content ).'</div>'.
			'</div>'.
		'</div>';

	}

?>