<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'BlogSearch', 'Grafik_Functions_Shortcode_BlogSearch' );
	function Grafik_Functions_Shortcode_BlogSearch( $atts ) {

		$a = shortcode_atts( array(
			'class' => '',
			'id' => ''
		), $atts, "BlogSearch" );

		return get_search_form( false );

	}

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'BlogSearchJS', 'Grafik_Functions_Shortcode_BlogSearchJS' );
	function Grafik_Functions_Shortcode_BlogSearchJS( $atts ) {

		$a = shortcode_atts( array(
			'class' => '',
			'id' => ''
		), $atts, "BlogSearchJS" );

		return
		'<script type="text/javascript">'.
			"$(document).on('ready', function() {".
				"$('.theme-blogsearch .input input[type=text]').on('keypress', function(e) {".
					"if(e.which == 13) {".
						"e.preventDefault();".
						"$(this).parents('form').get(0).submit();".
					"}".
				"});".
			"});".
		'</script>';

	}

?>