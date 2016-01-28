<?php

	add_shortcode( "ExpandingGridJS", "Grafik_Shortcode_ExpandingGridJS_Callback" );
	function Grafik_Shortcode_ExpandingGridJS_Callback() {
		return '<script src="'.esc_url( get_template_directory_uri() ).'/js/shortcodes/ExpandingGrid.js"></script>';
	}

	add_shortcode( "ExpandingGridCSS", "Grafik_Shortcode_ExpandingGridCSS_Callback" );
	function Grafik_Shortcode_ExpandingGridCSS_Callback() {
		return '<link rel="stylesheet" type="text/css" href="'.esc_url( get_template_directory_uri() ).'/css/shortcodes/ExpandingGrid.css" />';
	}

	add_shortcode( "ExpandingGrid", "Grafik_Shortcode_ExpandingGrid_Callback" );
	function Grafik_Shortcode_ExpandingGrid_Callback( $atts, $content = null ) {
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
		'<ul id="og-grid" class="og-grid'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'">'.
			$content.
		'</ul>';
	}

	add_shortcode( "ExpandingGridObj", "Grafik_Shortcode_ExpandingGridObj_Callback" );
	function Grafik_Shortcode_ExpandingGridObj_Callback( $atts ) {
		$a = shortcode_atts( array(
			'href' => '',
			'largesrc' => '',
			'title' => '',
			'description' => '',
			'thumbsrc' => '',
			'alt' => ''
		), $atts );
		return
		'<li>'.
			'<a href="'.$a[ 'href' ].'" data-largesrc="'.$a[ 'largesrc' ].'" data-title="'.$a[ 'title' ].'" data-description="'.$a[ 'description' ].'">'.
				'<img src="'.$a[ 'thumbsrc' ].'" alt="'.$a[ 'alt' ].'"/>'.
			'</a>'.
		'</li>';
	}

?>