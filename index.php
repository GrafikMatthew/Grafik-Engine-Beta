<?php

	#
	# SECURE THEME
	#

	if( !defined('ABSPATH') ) exit;

	/*

	888888 88 88     888888 888888 8888o.    888888o. .o88o. 8888o. .o8888
	88     88 88       88   88     88  88    88 88 88 88  88 88  88 88    
	8888   88 88       88   8888   8888Y'    88 88 88 88  88 88  88 'Y88o.
	88     88 88       88   88     88  88    88 88 88 88  88 88  88     88
	88     88 888888   88   888888 88  88    88 88 88 'Y88Y' 8888Y' 8888Y'

	*/

	add_filter( 'excerpt_length', function() { return 24; } , 999 );
	add_filter( 'excerpt_more', function() { return '...'; } , 999 );

	/*

	8888o. 888888 .o88o. 88  88 888888 .o8888 888888 888888 8888o.    .o88o. 8888o.     88 888888 .o8888 888888
	88  88 88     88  88 88  88 88     88       88   88     88  88    88  88 88  88     88 88     88       88  
	8888Y' 8888   88  88 88  88 8888   'Y88o.   88   8888   88  88    88  88 8888Y'     88 8888   88       88  
	88  88 88     'Y8888 88  88 88         88   88   88     88  88    88  88 88  88 88  88 88     88       88  
	88  88 888888     88 'Y88Y' 888888 8888Y'   88   888888 8888Y'    'Y88Y' 8888Y' 'Y88Y' 888888 'Y8888   88  

	*/

	$GRAFIK_OBJECT = get_queried_object();
	$GRAFIK_OBJECT_ID = get_queried_object_id();

	/*

	8888o. 88 .o8888 8888o. 88     .o88o. 88  88    888888o. .o88o. 8888o. 888888 .o8888
	88  88 88 88     88  88 88     88  88 88  88    88 88 88 88  88 88  88 88     88    
	88  88 88 'Y88o. 8888Y' 88     888888 'Y8888    88 88 88 88  88 88  88 8888   'Y88o.
	88  88 88     88 88     88     88  88     88    88 88 88 88  88 88  88 88         88
	8888Y' 88 8888Y' 88     888888 88  88 8888Y'    88 88 88 'Y88Y' 8888Y' 888888 8888Y'

	*/

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

	/*

	888888 888888 888888o. 8888o. 88     .o88o. 888888 888888    .o88o. .o8888 .o8888 888888 888888o. 8888o. 88     88  88
	  88   88     88 88 88 88  88 88     88  88   88   88        88  88 88     88     88     88 88 88 88  88 88     88  88
	  88   8888   88 88 88 8888Y' 88     888888   88   8888      888888 'Y88o. 'Y88o. 8888   88 88 88 8888Y' 88     'Y8888
	  88   88     88 88 88 88     88     88  88   88   88        88  88     88     88 88     88 88 88 88  88 88         88
	  88   888888 88 88 88 88     888888 88  88   88   888888    88  88 8888Y' 8888Y' 888888 88 88 88 8888Y' 888888 8888Y'

	*/

	$GRAFIK_TEMPLATES = Grafik_GetTemplateAssembly( $GRAFIK_MODE );

	/*

	.o8888 88  88 .o8888 888888 .o88o. 888888o.    888888 88  88 8888o. 888888 .o8888
	88     88  88 88       88   88  88 88 88 88      88   88  88 88  88 88     88    
	88     88  88 'Y88o.   88   88  88 88 88 88      88   'Y8888 8888Y' 8888   'Y88o.
	88     88  88     88   88   88  88 88 88 88      88       88 88     88         88
	'Y8888 'Y88Y' 8888Y'   88   'Y88Y' 88 88 88      88   8888Y' 88     888888 8888Y'

	*/

	$GRAFIK_TYPES = array(
		'tags' => json_decode( get_option( 'Grafik_PostType_Tags' ), true ),
		'styles' => json_decode( get_option( 'Grafik_PostType_Styles' ), true ),
		'header' => json_decode( get_option( 'Grafik_PostType_Header' ), true ),
		'content' => json_decode( get_option( 'Grafik_PostType_Content' ), true ),
		'footer' => json_decode( get_option( 'Grafik_PostType_Footer' ), true ),
		'scripts' => json_decode( get_option( 'Grafik_PostType_Scripts' ), true ),
		'structures' => json_decode( get_option( 'Grafik_PostType_Structure' ), true )
	);
	if( $GRAFIK_MODE[ 'is_archive' ] || $GRAFIK_MODE[ 'is_single' ] ) {
		if( $GRAFIK_MODE[ 'is_archive' ] ) {
			$GRAFIK_OBJECT_TYPE = $GRAFIK_OBJECT->rewrite[ 'slug' ];
		}
		if( $GRAFIK_MODE[ 'is_single' ] ) {
			$GRAFIK_OBJECT_TYPE = $GRAFIK_OBJECT->post_type;
		}
		$GRAFIK_OPTIONS[ 'type' ] = array(
			'tags' => $GRAFIK_TYPES[ 'tags' ][ $GRAFIK_OBJECT_TYPE ],
			'styles' => $GRAFIK_TYPES[ 'styles' ][ $GRAFIK_OBJECT_TYPE ],
			'header' => $GRAFIK_TYPES[ 'header' ][ $GRAFIK_OBJECT_TYPE ],
			'content' => $GRAFIK_TYPES[ 'content' ][ $GRAFIK_OBJECT_TYPE ],
			'footer' => $GRAFIK_TYPES[ 'footer' ][ $GRAFIK_OBJECT_TYPE ],
			'scripts' => $GRAFIK_TYPES[ 'scripts' ][ $GRAFIK_OBJECT_TYPE ],
			'structures' => $GRAFIK_TYPES[ 'structures' ][ $GRAFIK_OBJECT_TYPE ]
		);
	}

	/*

	.o88o. .o8888 .o8888 888888 888888    88 8888o. 88  88 888888 8888o. 88 888888 .o88o. 8888o. .o8888 888888
	88  88 88     88     88       88      88 88  88 88  88 88     88  88 88   88   88  88 88  88 88     88    
	888888 'Y88o. 'Y88o. 8888     88      88 88  88 888888 8888   8888Y' 88   88   888888 88  88 88     8888  
	88  88     88     88 88       88      88 88  88 88  88 88     88  88 88   88   88  88 88  88 88     88    
	88  88 8888Y' 8888Y' 888888   88      88 88  88 88  88 888888 88  88 88   88   88  88 88  88 'Y8888 888888

	*/

	$GRAFIK_VIEW = array(
		'document' => array(
			'tags' => array( 'before', 'after' ),
			'styles' => array( 'html' ),
			'header' => array( 'tl', 'tr', 'ml', 'mr', 'bl', 'br' ),
			'content' => array( 't', 'l', 'c', 'r', 'b' ),
			'footer' => array( 'tl', 'tr', 'ml', 'mr', 'bl', 'br' ),
			'scripts' => array( 'html' )
		),
		'inherit' => array( 'global' )
	);

	if( $GRAFIK_MODE[ 'is_archive' ] == 1) {

		$GRAFIK_VIEW[ 'inherit' ][] = 'type';
		# if( $GRAFIK_MODE['is_home'] == 1 ) $GRAFIK_VIEW[ 'inherit' ][] = 'home';
		# if( $GRAFIK_MODE['is_author'] == 1 ) $GRAFIK_VIEW[ 'inherit' ][] = 'authors';
		# if( $GRAFIK_MODE['is_category'] == 1 ) $GRAFIK_VIEW[ 'inherit' ][] = 'categories';

	} else if( $GRAFIK_MODE[ 'is_search' ] == 1 ) {

		$GRAFIK_VIEW[ 'inherit' ][] = 'search';

	} else if( $GRAFIK_MODE[ 'is_single' ] == 1 ) {

		$GRAFIK_VIEW[ 'inherit' ][] = 'type';

	} else if( $GRAFIK_MODE[ 'is_page' ] == 1 ) {

		$GRAFIK_VIEW[ 'inherit' ][] = 'pages';

	} else if( $GRAFIK_MODE[ 'is_404' ] == 1 ) {

		$GRAFIK_VIEW[ 'inherit' ][] = '404errors';

	}

	/*

	888888o. 888888 8888o. 88  88    8888o. 88     .o88o. .o8888 888888 888888o. 888888 8888o. 888888
	88 88 88 88     88  88 88  88    88  88 88     88  88 88     88     88 88 88 88     88  88   88  
	88 88 88 8888   88  88 88  88    8888Y' 88     888888 88     8888   88 88 88 8888   88  88   88  
	88 88 88 88     88  88 88  88    88     88     88  88 88     88     88 88 88 88     88  88   88  
	88 88 88 888888 88  88 'Y88Y'    88     888888 88  88 'Y8888 888888 88 88 88 888888 88  88   88  

	*/

	$GRAFIK_MENU_LOCATIONS = array(
		'header-tl', 'header-tr', 'header-ml', 'header-mr', 'header-bl', 'header-br',
		'content-t', 'content-l', 'content-c', 'content-r', 'content-b',
		'footer-tl', 'footer-tr', 'footer-ml', 'footer-mr', 'footer-bl', 'footer-br'
	);
	$GRAFIK_MENUS = array();
	foreach( $GRAFIK_MENU_LOCATIONS as $key => $val ) {
		$GRAFIK_MENUS[ $val ] = wp_nav_menu( array(
			'theme_location' => $val,
			'menu_id' => 'theme-menu-'.$val,
			'menu_class' => null,
			'container' => false,
			'fallback_cb' => null,
			'echo' => false
		) );
	}

	/*

	88  88 888888 888888o. 88        8888o. 88     .o88o. .o8888 88  88 .o8888
	88  88   88   88 88 88 88        88  88 88     88  88 88     88 .8' 88    
	888888   88   88 88 88 88        8888Y' 88     88  88 88     8888'  'Y88o.
	88  88   88   88 88 88 88        88  88 88     88  88 88     88 '8.     88
	88  88   88   88 88 88 888888    8888Y' 888888 'Y88Y' 'Y8888 88  88 8888Y'

	*/

	$GRAFIK_META = get_post_meta( $GRAFIK_OBJECT_ID );
	$GRAFIK_FUNCTIONS = json_decode( $GRAFIK_META[ 'Grafik_Functions' ][ 0 ], true );

	$GRAFIK_HTML = array(
		'tags' => array( 'before' => '', 'after' => '' ),
		'styles' => array( 'html' => '' ),
		'header' => array( 'tl' => '', 'tr' => '', 'ml' => '', 'mr' => '', 'bl' => '', 'br' => '' ),
		'content' => array( 't' => '', 'l' => '', 'c' => '', 'r' => '', 'b' => '' ),
		'footer' => array( 'tl' => '', 'tr' => '', 'ml' => '', 'mr' => '', 'bl' => '', 'br' => '' ),
		'scripts' => array( 'html' => '' )
	);

	// INHERITANCE TREE
	$GRAFIK_INHERITANCE = array(
		'global' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
			'pages' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
				'404errors' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
			'archives' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
				'archive-type' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
			'posts' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
				'post-type' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
		'specific-page' => array( 'tags' => array( 'before' => '', 'after' => '' ) ),
		'specific-post' => array( 'tags' => array( 'before' => '', 'after' => '' ) )
	);
	// - Global
	if( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'behavior-before' ] != 0 ) {
		$GRAFIK_INHERITANCE[ 'global' ][ 'tags' ][ 'before' ] = Grafik_ReadDecode( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'before' ] );
	}
	// - Pages
	if( $GRAFIK_MODE[ 'is_page' ] == 1 ) {
		if( $GRAFIK_OPTIONS[ 'pages' ][ 'tags' ][ 'behavior-before' ] == 1 ) {
			$GRAFIK_INHERITANCE[ 'pages' ][ 'tags' ][ 'before' ] .= Grafik_ReadDecode( $GRAFIK_OPTIONS[ 'pages' ][ 'tags' ][ 'before' ] );
		}
		if( $GRAFIK_OPTIONS[ 'pages' ][ 'tags' ][ 'behavior-before' ] == 2 ) {
			$GRAFIK_INHERITANCE[ 'pages' ][ 'tags' ][ 'before' ] = Grafik_ReadDecode( $GRAFIK_OPTIONS[ 'pages' ][ 'tags' ][ 'before' ] ).$GRAFIK_INHERITANCE[ 'pages' ][ 'tags' ][ 'before' ];
		}
		if( $GRAFIK_OPTIONS[ 'pages' ][ 'tags' ][ 'behavior-before-global' ] == 0 ) {
			$GRAFIK_INHERITANCE[ 'global' ][ 'tags' ][ 'before' ] = '';
		}
	}







	$GRAFIK_HTML[ 'tags' ][ 'after' ] .= $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'behavior-after' ] == 1 ? Grafik_ReadDecode( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'after' ] ) : '';



	# RIGHT NOW ONLY GLOBAL HAS TAGS, ALL LEVELS NEED TAGS WITH APPROPRIATE INHERITANCE CHAINING...
	if( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'mode-body-before' ] != 1 ) {
		$GRAFIK_HTML[ 'tags' ][ 'before' ] = Grafik_ReadDecode( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'before' ] );
	}
	if( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'mode-body-after' ] != 1 ) {
		$GRAFIK_HTML[ 'tags' ][ 'after' ] =  Grafik_ReadDecode( $GRAFIK_OPTIONS[ 'global' ][ 'tags' ][ 'html-body-after' ] );
	}

	foreach( $GRAFIK_VIEW[ 'document' ] as $doc_key => $doc_vals ) {
		foreach( $doc_vals as $doc_val ) {

			foreach( $GRAFIK_VIEW[ 'inherit' ] as $inherit_val ) {
				if( !isset( $GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-'.$inherit_val ] ] ) ) {
					$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-'.$inherit_val ] ] = '';
				}
				if( isset( $GRAFIK_OPTIONS[ $inherit_val ][ $doc_key ][ $doc_val ] ) ) {
					$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-'.$inherit_val ] ] .= Grafik_ReadDecode( $GRAFIK_OPTIONS[ $inherit_val ][ $doc_key ][ $doc_val ] );
				}
			}

			if( !isset( $GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-self' ] ] ) ) {
				$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-self' ] ] = '';
			}
			if( isset( $GRAFIK_FUNCTIONS[ $doc_key ][ $doc_val ] ) ) {
				$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-self' ] ] .= Grafik_ReadDecode( $GRAFIK_FUNCTIONS[ $doc_key ][ $doc_val ] );
			}

			if( is_array( $GRAFIK_HTML[ $doc_key ][ $doc_val ] ) ) {
				ksort( $GRAFIK_HTML[ $doc_key ][ $doc_val ] );
				$GRAFIK_HTML[ $doc_key ][ $doc_val ] = implode( '', $GRAFIK_HTML[ $doc_key ][ $doc_val ] );
			}

		}
	}

	/*

	8888o. 888888 8888o. 8888o. 888888 8888o.    .o88o. 88  88 888888 8888o. 88  88 888888
	88  88 88     88  88 88  88 88     88  88    88  88 88  88   88   88  88 88  88   88  
	8888Y' 8888   88  88 88  88 8888   8888Y'    88  88 88  88   88   8888Y' 88  88   88  
	88  88 88     88  88 88  88 88     88  88    88  88 88  88   88   88     88  88   88  
	88  88 888888 88  88 8888Y' 888888 88  88    'Y88Y' 'Y88Y'   88   88     'Y88Y'   88  

	*/

	global $wp_query;
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

			# WORDPRESS HEAD
			str_replace( "\n", '', Grafik_EchoString( 'wp_head' ) ).

			# THEME STYLE BLOCK
			Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'styles' ][ 'html' ] ).

		'</head>'.
		'<body '.Grafik_EchoString( 'body_class' ).'>'.

			# TAG BLOCK BEFORE
			Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'tags' ][ 'before' ] ).

			'<div class="theme">'.

				# SECTION HEADER
				( empty( $GRAFIK_HTML[ 'header' ][ 'tl' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'tr' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'ml' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'mr' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'bl' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'br' ] ) ? '' :
					'<section class="theme-header">'.
						# DIV HEADER TOP
						( empty( $GRAFIK_HTML[ 'header' ][ 'tl' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'tr' ] ) ? '' :
							'<div class="theme-header-top">'.
								( empty( $GRAFIK_HTML[ 'header' ][ 'tl' ] ) ? '' : '<div class="theme-header-top-left">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'header-tl' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'tl' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'header' ][ 'tr' ] ) ? '' : '<div class="theme-header-top-right">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'header-tr' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'tr' ] ) ).'</div>' ).
							'</div>'
						).
						# DIV HEADER MIDDLE
						( empty( $GRAFIK_HTML[ 'header' ][ 'ml' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'mr' ] ) ? '' :
							'<div class="theme-header-middle">'.
								( empty( $GRAFIK_HTML[ 'header' ][ 'ml' ] ) ? '' : '<div class="theme-header-middle-left">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'header-ml' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'ml' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'header' ][ 'mr' ] ) ? '' : '<div class="theme-header-middle-right">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'header-mr' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'mr' ] ) ).'</div>' ).
							'</div>'
						).
						# DIV HEADER BOTTOM
						( empty( $GRAFIK_HTML[ 'header' ][ 'bl' ] ) && empty( $GRAFIK_HTML[ 'header' ][ 'br' ] ) ? '' :
							'<div class="theme-header-bottom">'.
								( empty( $GRAFIK_HTML[ 'header' ][ 'bl' ] ) ? '' : '<div class="theme-header-bottom-left">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'header-bl' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'bl' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'header' ][ 'br' ] ) ? '' : '<div class="theme-header-bottom-right">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'header-br' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'br' ] ) ).'</div>' ).
							'</div>'
						).
					'</section>'
				).

				# SECTION CONTENT
				( empty( $GRAFIK_HTML[ 'content' ][ 't' ] ) && empty( $GRAFIK_HTML[ 'content' ][ 'l' ] ) && empty( $GRAFIK_HTML[ 'content' ][ 'c' ] ) && empty( $GRAFIK_HTML[ 'content' ][ 'r' ] ) && empty( $GRAFIK_HTML[ 'content' ][ 'b' ] ) ? '' :
					'<section class="theme-content">'.
						# DIV CONTENT TOP
						( empty( $GRAFIK_HTML[ 'content' ][ 't' ] ) ? '' : '<div class="theme-content-top">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'content-t' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 't' ] ) ).'</div>' ).
						# DIV CONTENT LEFT, CENTER, RIGHT
						( empty( $GRAFIK_HTML[ 'content' ][ 'l' ] ) && empty( $GRAFIK_HTML[ 'content' ][ 'c' ] ) && empty( $GRAFIK_HTML[ 'content' ][ 'r' ] ) ? '' :
							'<div class="theme-content-middle">'.
								( empty( $GRAFIK_HTML[ 'content' ][ 'l' ] ) ? '' : '<div class="theme-content-middle-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-l'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'l' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'content' ][ 'c' ] ) ? '' : '<div class="theme-content-middle-center">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-c'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'c' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'content' ][ 'r' ] ) ? '' : '<div class="theme-content-middle-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-r'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'r' ] ) ).'</div>' ).
							'</div>'
						).
						# DIV CONTENT BOTTOM
						( empty( $GRAFIK_HTML[ 'content' ][ 'b' ] ) ? '' : '<div class="theme-content-bottom">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-b'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'b' ] ) ).'</div>' ).
					'</section>'
				).

				# SECTION FOOTER
				( empty( $GRAFIK_HTML[ 'footer' ][ 'tl' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'tr' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'ml' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'mr' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'bl' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'br' ] ) ? '' :
					'<section class="theme-footer">'.
						# DIV FOOTER TOP
						( empty( $GRAFIK_HTML[ 'footer' ][ 'tl' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'tr' ] ) ? '' :
							'<div class="theme-footer-top">'.
								( empty( $GRAFIK_HTML[ 'footer' ][ 'tl' ] ) ? '' : '<div class="theme-footer-top-left">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'footer-tl' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'tl' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'footer' ][ 'tr' ] ) ? '' : '<div class="theme-footer-top-right">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'footer-tr' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'tr' ] ) ).'</div>' ).
							'</div>'
						).
						# DIV FOOTER MIDDLE
						( empty( $GRAFIK_HTML[ 'footer' ][ 'ml' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'mr' ] ) ? '' :
							'<div class="theme-footer-middle">'.
								( empty( $GRAFIK_HTML[ 'footer' ][ 'ml' ] ) ? '' : '<div class="theme-footer-middle-left">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'footer-ml' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'ml' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'footer' ][ 'mr' ] ) ? '' : '<div class="theme-footer-middle-right">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'footer-mr' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'mr' ] ) ).'</div>' ).
							'</div>'
						).
						# DIV FOOTER BOTTOM
						( empty( $GRAFIK_HTML[ 'footer' ][ 'bl' ] ) && empty( $GRAFIK_HTML[ 'footer' ][ 'br' ] ) ? '' :
							'<div class="theme-footer-bottom">'.
								( empty( $GRAFIK_HTML[ 'footer' ][ 'bl' ] ) ? '' : '<div class="theme-footer-bottom-left">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'footer-bl' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'bl' ] ) ).'</div>' ).
								( empty( $GRAFIK_HTML[ 'footer' ][ 'br' ] ) ? '' : '<div class="theme-footer-bottom-right">'.str_replace( "{{ MENU }}", $GRAFIK_MENUS[ 'footer-br' ], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'br' ] ) ).'</div>' ).
							'</div>'
						).
					'</section>'
				).

			'</div>'.

			str_replace( "\n", '', Grafik_EchoString( 'wp_footer' ) ).
			Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'scripts' ][ 'html' ] ).

			# TAG BLOCK AFTER
			Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'tags' ][ 'after' ] ).

		'</body>'.
	'</html>'.
	# "\n<!-- wp_query: ".print_r( $wp_query, true )." -->".
	# "\n<!-- GRAFIK_OBJECT: ".print_r( $GRAFIK_OBJECT, true )." -->".
	# "\n<!-- GRAFIK_MODE: ".print_r( $GRAFIK_MODE, true )." -->".
	# "\n<!-- GRAFIK_OPTIONS: ".print_r( $GRAFIK_OPTIONS, true )." -->".
	# "\n<!-- GRAFIK_TYPES: ".print_r( $GRAFIK_TYPES, true )." -->".
	# "\n<!-- GRAFIK_META: ".print_r( $GRAFIK_META, true )." -->".
	# "\n<!-- GRAFIK_HTML: ".htmlspecialchars( print_r( $GRAFIK_HTML, true ) )." -->".
	# "\n<!-- GRAFIK_MENUS: ".print_r( $GRAFIK_MENUS, true )." -->".
	"\n<!-- GRAFIK_TEMPLATES: ".print_r( $GRAFIK_TEMPLATES, true )." -->".
	'';

?>