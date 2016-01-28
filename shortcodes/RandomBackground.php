<?php

	function Grafik_Shortcode_RandomBackground_Callback( $atts, $content = null ) {

		$a = shortcode_atts( array(
			'size' => 'cover',
			'position' => '50% 50%',
			'desktop_images' => '',
			'tablet_images' => '',
			'phone_images' => '',
			'class' => '',
			'id' => ''
		), $atts );

		$desktop_images = empty( $a['desktop_images'] ) ? null : explode(' ', $a['desktop_images'] );
		$tablet_images = empty( $a['tablet_images'] ) ? null : explode(' ', $a['tablet_images'] );
		$phone_images = empty( $a['phone_images'] ) ? null : explode(' ', $a['phone_images'] );

		$style_base =
		( empty( $a['size'] ) ? null : 'background-size:'.$a['size'].';' ).
		( empty( $a['position'] ) ? null : 'background-position:'.$a['position'].';' );

		$desktop_style = $style_base.( empty( $desktop_images ) ? null : 'background-image:url('.$desktop_images[array_rand( $desktop_images, 1 )].');' );
		$tablet_style = $style_base.( empty( $tablet_images ) ? null : 'background-image:url('.$tablet_images[array_rand( $tablet_images, 1 )].');' );
		$phone_style = $style_base.( empty( $phone_images ) ? null : 'background-image:url('.$phone_images[array_rand( $phone_images, 1 )].');' );

		return
		'<div class="theme-randombackground'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			( empty( $desktop_images ) ? null : '<div class="theme-randombackground-desktop" style="'.$desktop_style.'">' ).
			( empty( $tablet_images ) ? null : '<div class="theme-randombackground-tablet" style="'.$tablet_style.'">' ).
			( empty( $phone_images ) ? null : '<div class="theme-randombackground-phone" style="'.$phone_style.'">' ).
			Grafik_ShortcodeLoop( $content ).
			( empty( $phone_images ) ? null : '</div>' ).
			( empty( $tablet_images ) ? null : '</div>' ).
			( empty( $desktop_images ) ? null : '</div>' ).
		'</div>';

	}
	add_shortcode( "RandomBackground", "Grafik_Shortcode_RandomBackground_Callback" );

?>