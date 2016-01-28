<?php

	// HTML

	function Grafik_Shortcode_ModalBox_Callback( $atts, $content = null ) {

		global $GRAFIK_ID;

		$a = shortcode_atts( array(
			'label' => '',
			'width' => '75%',
			'height' => '50%',
			'mode' => 'html', // html, img, iframe
			'class' => '',
			'id' => ''
		), $atts );

		if( empty( $content ) ) return null;

		return
		'<span data-width="'.$a['width'].'" data-height="'.$a['height'].'" data-mode="'.$a['mode'].'" data-content="'.htmlentities( $content, ENT_QUOTES ).'" class="theme-modalbox'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<span class="theme-modalbox-label">'.$a['label'].'</span>'.
			( $a['mode'] == 'html' ? null : '<noscript><a href="'.$content.'">'.$a['label'].'</a></noscript>' ).
		'</span>';

	}
	add_shortcode( "ModalBox", "Grafik_Shortcode_ModalBox_Callback" );

	// JS

	function Grafik_Shortcode_ModalBoxJS_Callback( $atts ) {

		return
		'<script>'.

			'var cssCurtain = {'.
				'"width" : "auto",'.
				'"height" : "auto",'.
				'"background" : "rgba(0,0,0,0.5)",'.
				'"position" : "fixed",'.
				'"top" : "0",'.
				'"right" : "0",'.
				'"bottom" : "0",'.
				'"left" : "0",'.
				'"z-index" : "9999"'.
			'};'.

			'var cssDisplay = {'.
				'"padding" : "20px",'.
				'"background" : "#fff",'.
				'"box-shadow" : "0px 10px 10px rgba(0,0,0,0.5)",'.
				'"position" : "fixed",'.
			'};'.

			'var cssImg = {'.
				'"display" : "block",'.
				'"margin" : "auto",'.
				'"max-width" : "100%",'.
				'"max-height" : "100%",'.
			'};'.

			'function Modalbox_Close() {'.

				'var modalboxCurtain = $( ".modalbox-curtain" );'.
				'modalboxCurtain.fadeOut( "250", function() {'.
					'modalboxCurtain.remove();'.
				'} );'.

			'}'.

			'function Modalbox_Open() {'.

				'var documentBody = $( "body" );'.
				'var thisModalbox = $( this );'.

				'var modalboxWidth = thisModalbox.data( "width" );'.
				'var modalboxHeight = thisModalbox.data( "height" );'.
				'var modalboxMode = thisModalbox.data( "mode" );'.
				'var modalboxContent = thisModalbox.data( "content" );'.

				'$( ".modalbox-curtain" ).remove();'.

				'var modalboxCurtain = $( "<div />" )'.
				'.appendTo( documentBody )'.
				'.addClass( "modalbox-curtain" )'.
				'.css( cssCurtain )'.
				'.hide()'.
				'.on( "click", Modalbox_Close );'.

				'var modalboxDisplay = $( "<div />" )'.
				'.appendTo( modalboxCurtain )'.
				'.addClass( "modalbox-display" )'.
				'.css( cssDisplay )'.
				'.css( {'.
					'"width" : modalboxWidth,'.
					'"height" : modalboxHeight,'.
					'"left" : "calc( 50% - ("+modalboxWidth+" / 2 ) )",'.
					'"top" : "calc( 50% - ("+modalboxHeight+" / 2 ) )"'.
				'} );'.

				'if( modalboxMode == "iframe" ) {'.

					'$( "<iframe />" )'.
					'.appendTo( modalboxDisplay )'.
					'.attr( "width", "100%" )'.
					'.attr( "height", "100%" )'.
					'.attr( "src", modalboxContent )'.
					'.css( { "border" : "none" } );'.

				'} else if( modalboxMode == "img" ) {'.

					'$( "<img />" )'.
					'.appendTo( modalboxDisplay )'.
					'.attr( "src", modalboxContent )'.
					'.css( cssImg );'.

				'} else {'.

					'modalboxDisplay.html( modalboxContent ).text();'.

				'}'.

				'modalboxCurtain.fadeIn( "250" );'.

			'}'.

			'$( document ).on( "ready" , function() {'.

				'$( ".theme-modalbox" ).on( "click" , Modalbox_Open );'.

			'} );'.

		'</script>';
	}
	add_shortcode( "ModalBoxJS", "Grafik_Shortcode_ModalBoxJS_Callback" );

	// CSS

	function Grafik_Shortcode_ModalBoxCSS_Callback( $atts ) {
		return
		'.modalbox-curtain {'.
			'width: auto;'.
			'height: auto;'.
			'background: rgba(0,0,0,0.5);'.
			'position: absolute;'.
			'top: 0;'.
			'right: 0;'.
			'bottom: 0;'.
			'left: 0;'.
			'z-index: 9999;'.
		'}'.
		'.modalbox-display {'.
			'padding: 20px;'.
			'box-shadow: 0px 10px 10px rgba(0,0,0,0.5);'.
		'}';
	}
	add_shortcode( "ModalBoxCSS", "Grafik_Shortcode_ModalBoxCSS_Callback" );

?>