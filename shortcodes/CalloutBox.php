<?php

	function Grafik_Shortcode_CalloutBox_Callback( $atts, $content = null ) {

		$a = shortcode_atts( array(
			'imgsrc' => '',
			'imgurl' => '',
			'title' => '',
			'class' => '',
			'id' => ''
		), $atts );

		return
		'<div class="theme-calloutbox'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			( empty( $a['imgsrc'] ) ? null :
			'<div class="theme-calloutbox-image">'.
				( empty( $a['imgurl'] ) ? null : '<a href="'.$a['imgurl'].'">' ).
				'<img src="'.$a['imgsrc'].'" alt="'.$a['title'].'" />'.
				( empty( $a['imgurl'] ) ? null : '</a>' ).
			'</div>'
			).
			'<div class="theme-calloutbox-interior">'.
				( empty( $a['title'] ) ? null : '<div class="theme-calloutbox-title"><strong>'.$a['title'].'</strong></div>' ).
				( empty( $content ) ? null : '<div class="theme-calloutbox-content">'.Grafik_ShortcodeLoop( $content ).'</div>' ).
			'</div>'.
		'</div>';

	}
	add_shortcode( "CalloutBox", "Grafik_Shortcode_CalloutBox_Callback" );

?>