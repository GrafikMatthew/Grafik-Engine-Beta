<?php

	function Grafik_Shortcode_BlurEmail_Callback( $atts ) {

		global $GRAFIK_ID;

		$a = shortcode_atts( array(
			'mailbox' => '',
			'link' => 'true',
			'text' => '',
			'class' => '',
			'id' => ''
		), $atts );

		if( empty( $a['mailbox'] ) ) return null;

		return
		'<span class="theme-bluremail'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			( $a['link'] == 'true' ? '<a href="'.antispambot( 'mailto://'.$a['mailbox'] ).'">' : null ).
				antispambot( empty( $a['text'] ) ? $a['mailbox'] : $a['text'] ).
			( $a['link'] == 'true' ? '</a>' : null ).
		'</span>';

	}
	add_shortcode( "BlurEmail", "Grafik_Shortcode_BlurEmail_Callback" );

?>