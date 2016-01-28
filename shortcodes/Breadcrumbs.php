<?php

	function Grafik_Shortcode_Breadcrumbs_Callback( $atts ) {

		global $GRAFIK_ID;

		$a = shortcode_atts( array(
			'postid' => $GRAFIK_ID,
			'divider' => '&raquo;',
			'emptyhome' => 1,
			'includehome' => 0,
			'includeself' => 1,
			'class' => '',
			'id' => ''
		), $atts );

		$ancestors = get_post_ancestors( $a['postid'] );
		$ancestors = array_reverse( $ancestors );

		$links = array();
		if( $a['includehome'] == 1 || ( empty( $ancestors ) && $a['emptyhome'] == 1 ) ) {
			$links[] = '<a href="'.get_home_url().'">'.get_the_title( get_option( 'page_on_front' ) ).'</a>';
		}
		foreach($ancestors as $ancestor) {
			$links[] = '<a href="'.get_permalink( $ancestor ).'">'.get_the_title( $ancestor ).'</a>';
		}
		if( $a['includeself'] == 1 ) {
			$links[] = get_the_title( $a['postid'] );
		}

		return
		'<div class="theme-breadcrumbs'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			implode( '<span class="theme-breadcrumbs-divider">'.$a['divider'].'</span>', $links ).
		'</div>';

	}
	add_shortcode( "Breadcrumbs", "Grafik_Shortcode_Breadcrumbs_Callback" );

?>