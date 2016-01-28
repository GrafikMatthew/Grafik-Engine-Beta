<?php

	function Grafik_Shortcode_JumpScroller_Callback( $atts, $content = null ) {

		global $GRAFIK_ID;

		$a = shortcode_atts( array(
			'legend_links' => '', // #element-id The Title of the Link|#another-element-id Another Link Title
			'scrollto_enabled' => true,
			'scrollto_speed' => 500,
			'scrollto_offset' => 0,
			'class' => '',
			'id' => ''
		), $atts );

		if( empty( $a['legend_links'] ) ) return null;
		$legend_links = explode( '|', $a['legend_links'] );

		$links = array();
		foreach( $legend_links as $legend_link ) {
			$link_parts = explode( ' ', $legend_link );
			$link_id = array_shift( $link_parts );
			$link_title = implode( ' ', $link_parts );
			$links[] = array(
				'id' => $link_id,
				'title' => $link_title
			);
		}

		$binding_id = 'jumpscroller_'.( microtime( true ) * 10000 );

		$link_list = '';
		foreach( $links as $link ) {
			$link_list .= '<li><a href="#'.trim($link['id'], '#').'">'.$link['title'].'</a></li>';
		}

		return
		'<div class="theme-jumpscroller'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<div class="theme-jumpscroller-interior">'.
				'<div class="theme-jumpscroller-legend">'.
					'<div class="theme-jumpscroller-legend-interior">'.
						'<ul id="'.$binding_id.'">'.$link_list.'</ul>'.
					'</div>'.
				'</div>'.
				'<div class="theme-jumpscroller-content">'.
					'<div class="theme-jumpscroller-content-interior">'.
						Grafik_ShortcodeLoop( $content ).
					'</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
		'<script>'.
			'(function() {'.
				'var JumpScroller_Top = 0;'.
				'var JumpScroller_Offset = '.$a['scrollto_offset'].';'.
				'var JumpScroller_Object;'.
				'function JumpScroller_UpdateTop() {'.
					'JumpScroller_Top = $( this ).scrollTop();'.
					'var FirstNotScrolled = true;'.
					'$.each( JumpScroller_Object, function( i ) {'.
						'var targetA = $( "a[href=#" + $( this ).attr( "id" ) + "]" );'.
						'if( $( this ).offset().top < JumpScroller_Top + '.$a['scrollto_offset'].' ) {'.
							'targetA.addClass( "scrolled" ).removeClass( "first-unscrolled" );'.
						'} else {'.
							'targetA.removeClass( "scrolled" );'.
							'if( FirstNotScrolled ) {'.
								'FirstNotScrolled = false;'.
								'targetA.addClass( "first-unscrolled" );'.
							'} else {'.
								'targetA.removeClass( "first-unscrolled" );'.
							'}'.
						'}'.
					'} );'.
				'}'.
				'$( document ).on( "ready", function() {'.
					'var JumpScroller_Ids = [];'.
					'$( "#'.$binding_id.' a" )'.
					'.each( function( i ) {'.
						'JumpScroller_Ids[JumpScroller_Ids.length] = $( this ).attr( "href" ).replace( "#", "" );'.
					'} );'.
					'var JumpScroller_Nodes = $.map( JumpScroller_Ids, function( i ) { return document.getElementById( i ); } );'.
					'JumpScroller_Object = $( JumpScroller_Nodes );'.
					'$( "#'.$binding_id.' a" )'.
					'.on( "click", function(e) {'.
						'var thisA = $( this );'.
						( $a['scrollto_enabled'] != true ? null :
							'e.preventDefault();'.
							'$( "html, body" )'.
							'.animate( {'.
								'scrollTop: $( $( thisA ).attr( "href" ) ).offset().top'.( empty( $a['scrollto_offset'] ) ? null : ' - '.$a['scrollto_offset'] ).
							'}'.( empty( $a['scrollto_speed'] ) ? null : ', '.$a['scrollto_speed'] ).' );'
						).
					'} );'.
					'$( window ).on( "scroll", JumpScroller_UpdateTop );'.
				'} );'.
			'})(jQuery);'.
		'</script>';

	}
	add_shortcode( "JumpScroller", "Grafik_Shortcode_JumpScroller_Callback" );

?>