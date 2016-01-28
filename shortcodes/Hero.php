<?php

	function Grafik_Shortcode_Hero_Callback( $atts, $content = null ) {

		$a = shortcode_atts( array(
			'title' => '',
			'bgcolor' => '',
			'bgimage' => '',
			'bgsize' => 'cover',
			'btnlink' => '',
			'btntext' => '',
			'class' => '',
			'id' => ''
		), $atts );

		$id = "";
		if( !empty( $a['id'] ) ) $id .= $a['id'];
		if( !empty( $id ) ) $id = " id=\"$id\"";

		$classes = "theme-hero";
		if( !empty( $a['class'] ) ) $classes .= " $a[class]";
		if( !empty( $classes ) ) $classes = " class=\"$classes\"";

		$styles = "";
		if( !empty( $a['bgimage'] ) ) $styles .= "background: url( $a[bgimage] ) no-repeat 50% 50%;";
		if( !empty( $a['bgcolor'] ) ) $styles .= "background-color: $a[bgcolor];";
		if( !empty( $a['bgsize'] ) ) $styles .= "background-size: $a[bgsize];";
		if( !empty( $styles ) ) $styles = " style=\"$styles\"";

		return
		'<div'.$id.$classes.$styles.'>'.
			'<div class="theme-hero-interior">'.
				'<div class="theme-hero-content">'.
					( empty( $a['title'] ) ? null :
						'<div class="theme-hero-content-title">'.
							'<h2>'.$a['title'].'</h2>'.
						'</div>'
					).
					'<div class="theme-hero-content-main">'.
						Grafik_ShortcodeLoop( $content ).
					'</div>'.
					( empty( $a['btntext'] ) || empty( $a['btnlink'] ) ? null :
						'<div class="theme-hero-content-button">'.
							'<a href="'.$a['btnlink'].'" title="'.$a['btntext'].'">'.
								$a['btntext'].
							'</a>'.
						'</div>'
					).
				'</div>'.
			'</div>'.
		'</div>';

	}
	add_shortcode( "Hero", "Grafik_Shortcode_Hero_Callback" );

?>