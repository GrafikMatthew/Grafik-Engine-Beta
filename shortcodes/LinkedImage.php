<?php

	function Grafik_Shortcode_LinkedImage_Callback( $atts ) {

		$a = shortcode_atts( array(
			'src' => '',
			'href' => '#',
			'w' => '100',
			'h' => '100',
			'title' => '',
			'alt' => '',
			'class' => '',
			'id' => ''
		), $atts );

		foreach($a as $key => $val) {
			$a[$key] = trim( $val );
		}

		return
		'<div class="theme-linkedimage'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<a href="'.$a['href'].'" title="'.$a['title'].'">'.
				'<img src="'.$a['src'].'" width="'.$a['w'].'" height="'.$a['h'].'" alt="'.$a['alt'].'" />'.
			'</a>'.
		'</div>';

	}
	add_shortcode( "LinkedImage", "Grafik_Shortcode_LinkedImage_Callback" );

?>