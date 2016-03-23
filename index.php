<?php

	/*

	88 8888o. 8888o. 888888 88  88  8888o. 88  88 8888o.
	88 88  88 88  88 88     '8..8'  88  88 88  88 88  88
	88 88  88 88  88 8888    '88'   8888Y' 888888 8888Y'
	88 88  88 88  88 88     .8''8.  88     88  88 88    
	88 88  88 8888Y' 888888 88  88  88     88  88 88    

	*/

	if( !defined('ABSPATH') ) exit;

	add_filter( 'excerpt_length', function() { return 24; } , 999 );
	add_filter( 'excerpt_more', function() { return '...'; } , 999 );

	$GRAFIK_MODE = array( null
		, "is_404"			=> is_404()
		, "is_archive"		=> is_archive()
		, "is_attachment"	=> is_attachment()
		, "is_author"		=> is_author()
		, "is_category"		=> is_category()
		, "is_front_page"	=> is_front_page()
		, "is_home"			=> is_home()
		, "is_page"			=> is_page()
		, "is_search"		=> is_search()
		, "is_single"		=> is_single()
		, "is_tag"			=> is_tag()
		, "is_tax"			=> is_tax()
	);

	$GRAFIK_TEMPLATE = 'Global';
	if( $GRAFIK_MODE[ 'is_page' ] == 1 )		$GRAFIK_TEMPLATE = 'Pages';
	if( $GRAFIK_MODE[ 'is_404' ] == 1 )			$GRAFIK_TEMPLATE = 'NotFound';
	if( $GRAFIK_MODE[ 'is_search' ] == 1 )		$GRAFIK_TEMPLATE = 'SearchResults';
	if( $GRAFIK_MODE[ 'is_single' ] == 1 )		$GRAFIK_TEMPLATE = 'PostTypes';
	if( $GRAFIK_MODE[ 'is_archive' ] == 1)		$GRAFIK_TEMPLATE = 'ArchiveTypes';
	if( $GRAFIK_MODE[ 'is_author' ] == 1 )		$GRAFIK_TEMPLATE = 'ArchiveAuthors';
	if( $GRAFIK_MODE[ 'is_category' ] == 1 )	$GRAFIK_TEMPLATE = 'ArchiveCategories';

	$GRAFIK_HTML = Grafik_Templates_GetHTML( $GRAFIK_TEMPLATE );

	echo
	'<!DOCTYPE html>'.
	'<html '.Grafik_EchoString( 'language_attributes' ).' class="no-js">'.
		'<head>'.
			'<meta charset="'.Grafik_EchoString( 'bloginfo', array( 'charset' ) ).'" />'.
			'<title>'.Grafik_EchoString( 'wp_title' ).'</title>'.
			'<meta http-equiv="X-UA-Compatible" content="IE=edge">'.
			'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />'.
			'<link rel="pingback" href="'.Grafik_EchoString( 'bloginfo', array( 'pingback_url' ) ).'" />'.
			Grafik_Favicon().
			'<!--[if lt IE 9]><script src="'.esc_url( get_template_directory_uri() ).'/js/html5.js"></script><![endif]-->'.
			'<script src="'.esc_url( get_template_directory_uri() ).'/js/modernizr.js"></script>'.
			str_replace( "\n", '', Grafik_EchoString( 'wp_head' ) ).
			$GRAFIK_HTML[ 'Styles_Head' ].
			$GRAFIK_HTML[ 'Scripts_Head' ].
		'</head>'.
		'<body '.Grafik_EchoString( 'body_class' ).'>'.
			$GRAFIK_HTML[ 'Scripts_Intro' ].
			'<div class="GE-Theme">'.
				( empty( $GRAFIK_HTML[ 'Header_TopLeft' ].$GRAFIK_HTML[ 'Header_TopRight' ].$GRAFIK_HTML[ 'Header_MiddleLeft' ].$GRAFIK_HTML[ 'Header_MiddleRight' ].$GRAFIK_HTML[ 'Header_BottomLeft' ].$GRAFIK_HTML[ 'Header_BottomRight' ] ) ? '' :
				'<section class="GE-Theme-Header">'.
					( empty( $GRAFIK_HTML[ 'Header_TopLeft' ].$GRAFIK_HTML[ 'Header_TopRight' ] ) ? '' :
					'<div class="GE-Theme-Header-Top">'.
						( empty( $GRAFIK_HTML[ 'Header_TopLeft' ] ) ? '' : '<div class="GE-Theme-Header-Top-Left">'.$GRAFIK_HTML[ 'Header_TopLeft' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Header_TopRight' ] ) ? '' : '<div class="GE-Theme-Header-Top-Right">'.$GRAFIK_HTML[ 'Header_TopRight' ].'</div>' ).
					'</div>' ).
					( empty( $GRAFIK_HTML[ 'Header_MiddleLeft' ].$GRAFIK_HTML[ 'Header_MiddleRight' ] ) ? '' :
					'<div class="GE-Theme-Header-Middle">'.
						( empty( $GRAFIK_HTML[ 'Header_MiddleLeft' ] ) ? '' : '<div class="GE-Theme-Header-Middle-Left">'.$GRAFIK_HTML[ 'Header_MiddleLeft' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Header_MiddleRight' ] ) ? '' : '<div class="GE-Theme-Header-Middle-Right">'.$GRAFIK_HTML[ 'Header_MiddleRight' ].'</div>' ).
					'</div>' ).
					( empty( $GRAFIK_HTML[ 'Header_BottomLeft' ].$GRAFIK_HTML[ 'Header_BottomRight' ] ) ? '' :
					'<div class="GE-Theme-Header-Bottom">'.
						( empty( $GRAFIK_HTML[ 'Header_BottomLeft' ] ) ? '' : '<div class="GE-Theme-Header-Bottom-Left">'.$GRAFIK_HTML[ 'Header_BottomLeft' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Header_BottomRight' ] ) ? '' : '<div class="GE-Theme-Header-Bottom-Right">'.$GRAFIK_HTML[ 'Header_BottomRight' ].'</div>' ).
					'</div>' ).
				'</section>' ).
				( empty( $GRAFIK_HTML[ 'Content_Top' ].$GRAFIK_HTML[ 'Content_Left' ].$GRAFIK_HTML[ 'Content_Center' ].$GRAFIK_HTML[ 'Content_Right' ].$GRAFIK_HTML[ 'Content_Bottom' ] ) ? '' :
				'<section class="GE-Theme-Content">'.
					( empty( $GRAFIK_HTML[ 'Content_Top' ] ) ? '' : '<div class="GE-Theme-Content-Top">'.$GRAFIK_HTML[ 'Content_Top' ].'</div>' ).
					( empty( $GRAFIK_HTML[ 'Content_Left' ].$GRAFIK_HTML[ 'Content_Center' ].$GRAFIK_HTML[ 'Content_Right' ] ) ? '' :
					'<div class="GE-Theme-Content-Middle">'.
						( empty( $GRAFIK_HTML[ 'Content_Left' ] ) ? '' : '<div class="GE-Theme-Content-Middle-Left">'.$GRAFIK_HTML[ 'Content_Left' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Content_Center' ] ) ? '' : '<div class="GE-Theme-Content-Middle-Center">'.$GRAFIK_HTML[ 'Content_Center' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Content_Right' ] ) ? '' : '<div class="GE-Theme-Content-Middle-Right">'.$GRAFIK_HTML[ 'Content_Right' ].'</div>' ).
					'</div>' ).
					( empty( $GRAFIK_HTML[ 'Content_Bottom' ] ) ? '' : '<div class="GE-Theme-Content-Bottom">'.$GRAFIK_HTML[ 'Content_Bottom' ].'</div>' ).
				'</section>' ).
				( empty( $GRAFIK_HTML[ 'Footer_TopLeft' ].$GRAFIK_HTML[ 'Footer_TopRight' ].$GRAFIK_HTML[ 'Footer_MiddleLeft' ].$GRAFIK_HTML[ 'Footer_MiddleRight' ].$GRAFIK_HTML[ 'Footer_BottomLeft' ].$GRAFIK_HTML[ 'Footer_BottomRight' ] ) ? '' :
				'<section class="GE-Theme-Footer">'.
					( empty( $GRAFIK_HTML[ 'Footer_TopLeft' ].$GRAFIK_HTML[ 'Footer_TopRight' ] ) ? '' :
					'<div class="GE-Theme-Footer-Top">'.
						( empty( $GRAFIK_HTML[ 'Footer_TopLeft' ] ) ? '' : '<div class="GE-Theme-Footer-Top-Left">'.$GRAFIK_HTML[ 'Footer_TopLeft' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Footer_TopRight' ] ) ? '' : '<div class="GE-Theme-Footer-Top-Right">'.$GRAFIK_HTML[ 'Footer_TopRight' ].'</div>' ).
					'</div>' ).
					( empty( $GRAFIK_HTML[ 'Footer_MiddleLeft' ].$GRAFIK_HTML[ 'Footer_MiddleRight' ] ) ? '' :
					'<div class="GE-Theme-Footer-Middle">'.
						( empty( $GRAFIK_HTML[ 'Footer_MiddleLeft' ] ) ? '' : '<div class="GE-Theme-Footer-Middle-Left">'.$GRAFIK_HTML[ 'Footer_MiddleLeft' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Footer_MiddleRight' ] ) ? '' : '<div class="GE-Theme-Footer-Middle-Right">'.$GRAFIK_HTML[ 'Footer_MiddleRight' ].'</div>' ).
					'</div>' ).
					( empty( $GRAFIK_HTML[ 'Footer_BottomLeft' ].$GRAFIK_HTML[ 'Footer_BottomRight' ] ) ? '' :
					'<div class="GE-Theme-Footer-Bottom">'.
						( empty( $GRAFIK_HTML[ 'Footer_BottomLeft' ] ) ? '' : '<div class="GE-Theme-Footer-Bottom-Left">'.$GRAFIK_HTML[ 'Footer_BottomLeft' ].'</div>' ).
						( empty( $GRAFIK_HTML[ 'Footer_BottomRight' ] ) ? '' : '<div class="GE-Theme-Footer-Bottom-Right">'.$GRAFIK_HTML[ 'Footer_BottomRight' ].'</div>' ).
					'</div>' ).
				'</section>' ).
			'</div>'.
			str_replace( "\n", '', Grafik_EchoString( 'wp_footer' ) ).
			$GRAFIK_HTML[ 'Scripts_Outro' ].
		'</body>'.
	'</html>';
