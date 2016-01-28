<?php

	function Grafik_Shortcode_SystemContent_Callback( $atts ) {

		$a = shortcode_atts( array(
			'class' => '',
			'id' => ''
		), $atts );

		$queried_object = get_queried_object();

		return
		'<div class="theme-systemcontent'.( empty( $a[ 'class' ] ) ? null : ' '.$a[ 'class' ] ).'"'.( empty( $a[ 'id' ] ) ? null : ' id="'.$a[ 'id' ].'"' ).'>'.
			$queried_object->post_content.
		'</div>';

	}
	add_shortcode( "SystemContent", "Grafik_Shortcode_SystemContent_Callback" );

?>