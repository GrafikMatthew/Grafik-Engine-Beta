<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( "AncestorLink", "Grafik_Functions_Shortcode_AncestorLink" );
	function Grafik_Functions_Shortcode_AncestorLink( $atts ) {

		global $GRAFIK_OBJECT_ID;

		$a = shortcode_atts( array(
			'level' => 0,
			'class' => '',
			'id' => ''
		), $atts );

		$r_ancestors = get_post_ancestors( $GRAFIK_OBJECT_ID );
		array_unshift( $r_ancestors, $GRAFIK_OBJECT_ID );
		$ancestors = array_reverse( $r_ancestors );
		$level_id = $ancestors[ min( count( $ancestors ), $a['level'] ) ];

		return
		'<a href="'.get_permalink( $level_id ).'" class="theme-ancestorlink'.( $level_id == $GRAFIK_OBJECT_ID ? ' active' : null).( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			get_the_title( $level_id ).
		'</a>';

	}
	

?>