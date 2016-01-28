<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'Hide', 'Grafik_Functions_Shortcodes_Hide' );
	function Grafik_Functions_Shortcodes_Hide( $atts, $content = null ) {

		return '';

	}

?>