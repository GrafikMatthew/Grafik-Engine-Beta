<?php

	function Grafik_Shortcode_PageTitle_Callback( $atts ) {

		global $GRAFIK_OBJECT_ID;
		global $GRAFIK_OBJECT;

		$a = shortcode_atts( array(
			'h' => 'h1',
			'post_category' => 'true',
			'class' => '',
			'id' => ''
		), $atts );

		$category_title = array();
		$categories = get_the_category( $GRAFIK_OBJECT_ID );
		foreach( $categories as $category ) {
			$category_title[] = $category->name;
		}

		return
		'<div class="theme-pagetitle'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			( empty( $a['h'] ) ? null : '<'.$a['h'].'>' ).
			( $GRAFIK_OBJECT->post_type == 'post' && $a['post_category'] == 'true' ? implode( ', ', $category_title ) : get_the_title( $GRAFIK_OBJECT_ID ) ).
			( empty( $a['h'] ) ? null : '</'.$a['h'].'>' ).
		'</div>';

	}
	add_shortcode( "PageTitle", "Grafik_Shortcode_PageTitle_Callback" );

?>