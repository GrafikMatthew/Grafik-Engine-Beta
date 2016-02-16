<?php

	#
	# SECURE THEME
	#

	if( !defined('ABSPATH') ) exit;

	add_filter( 'excerpt_length', function() { return 24; } , 999 );
	add_filter( 'excerpt_more', function() { return '...'; } , 999 );

	#
	# GRAFIK ENVIRONMENT VARS (NON-DISPLAY)
	#

	$GRAFIK_OBJECT = get_queried_object();
	$GRAFIK_OBJECT_ID = get_queried_object_id();
	$GRAFIK_MODE = array(
		"is_404" => is_404(),
		"is_archive" => is_archive(),
		"is_attachment" => is_attachment(),
		"is_author" => is_author(),
		"is_category" => is_category(),
		"is_front_page" => is_front_page(),
		"is_home" => is_home(),
		"is_page" => is_page(),
		"is_search" => is_search(),
		"is_single" => is_single(),
		"is_tag" => is_tag(),
		"is_tax" => is_tax()
	);
	$GRAFIK_OPTIONS = array(
		'global' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_Global_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_Global_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_Global_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_Global_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_Global_Scripts' ), true )
		),
		'blog' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_Blog_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_Blog_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_Blog_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_Blog_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_Blog_Scripts' ), true )
		),
		'authors' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Scripts' ), true )
		),
		'categories' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Scripts' ), true )
		),
		'posts' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Scripts' ), true )
		),
		'pages' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_Pages_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_Pages_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_Pages_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_Pages_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_Pages_Scripts' ), true )
		),
		'404errors' => array(
			'styles' => json_decode( get_option( 'Grafik_Functions_404Errors_Styles' ), true ),
			'header' => json_decode( get_option( 'Grafik_Functions_404Errors_Header' ), true ),
			'content' => json_decode( get_option( 'Grafik_Functions_404Errors_Content' ), true ),
			'footer' => json_decode( get_option( 'Grafik_Functions_404Errors_Footer' ), true ),
			'scripts' => json_decode( get_option( 'Grafik_Functions_404Errors_Scripts' ), true )
		)
	);
	$GRAFIK_TYPES = array(
		'styles' => json_decode( get_option( 'Grafik_PostType_Styles' ), true ),
		'header' => json_decode( get_option( 'Grafik_PostType_Header' ), true ),
		'content' => json_decode( get_option( 'Grafik_PostType_Content' ), true ),
		'footer' => json_decode( get_option( 'Grafik_PostType_Footer' ), true ),
		'scripts' => json_decode( get_option( 'Grafik_PostType_Scripts' ), true ),
		'structures' => json_decode( get_option( 'Grafik_PostType_Structure' ), true )
	);
	if( $GRAFIK_MODE[ 'is_archive' ] ) {
		$GRAFIK_OPTIONS[ 'type' ] = array(
			'styles' => $GRAFIK_TYPES[ 'styles' ][ $GRAFIK_OBJECT->rewrite[ 'slug' ] ],
			'header' => $GRAFIK_TYPES[ 'header' ][ $GRAFIK_OBJECT->rewrite[ 'slug' ] ],
			'content' => $GRAFIK_TYPES[ 'content' ][ $GRAFIK_OBJECT->rewrite[ 'slug' ] ],
			'footer' => $GRAFIK_TYPES[ 'footer' ][ $GRAFIK_OBJECT->rewrite[ 'slug' ] ],
			'scripts' => $GRAFIK_TYPES[ 'scripts' ][ $GRAFIK_OBJECT->rewrite[ 'slug' ] ],
			'structures' => $GRAFIK_TYPES[ 'structures' ][ $GRAFIK_OBJECT->rewrite[ 'slug' ] ]
		);
	}
	if( $GRAFIK_MODE[ 'is_single' ] ) {
		$GRAFIK_OPTIONS[ 'type' ] = array(
			'styles' => $GRAFIK_TYPES[ 'styles' ][ $GRAFIK_OBJECT->post_type ],
			'header' => $GRAFIK_TYPES[ 'header' ][ $GRAFIK_OBJECT->post_type ],
			'content' => $GRAFIK_TYPES[ 'content' ][ $GRAFIK_OBJECT->post_type ],
			'footer' => $GRAFIK_TYPES[ 'footer' ][ $GRAFIK_OBJECT->post_type ],
			'scripts' => $GRAFIK_TYPES[ 'scripts' ][ $GRAFIK_OBJECT->post_type ],
			'structures' => $GRAFIK_TYPES[ 'structures' ][ $GRAFIK_OBJECT->post_type ]
		);
	}

	#
	# GRAFIK PRESENTATION VARS (DISPLAY)
	#

	$GRAFIK_LANG = Grafik_EchoString( 'language_attributes' );
	$GRAFIK_CHAR = Grafik_EchoString( 'bloginfo', array( 'charset' ) );
	$GRAFIK_PING = Grafik_EchoString( 'bloginfo', array( 'pingback_url' ) );
	$GRAFIK_VIEW = array(
		'document' => array(
			'styles' => array( 'html' ),
			'header' => array( 'tl', 'tr', 'ml', 'mr', 'bl', 'br' ),
			'content' => array( 't', 'l', 'c', 'r', 'b' ),
			'footer' => array( 'tl', 'tr', 'ml', 'mr', 'bl', 'br' ),
			'scripts' => array( 'html' )
		),
		'inherit' => array()
	);

	#
	# GRAFIK ASSET INHERITANCE
	#

	// Global
	$GRAFIK_VIEW[ 'inherit' ] = array( 'global' );

	if( $GRAFIK_MODE['is_archive'] == 1) {

		// Home
		// if( $GRAFIK_MODE['is_home'] == 1 ) $GRAFIK_VIEW[ 'inherit' ][] = 'home';

		// By Author
		// if( $GRAFIK_MODE['is_author'] == 1 ) $GRAFIK_VIEW[ 'inherit' ][] = 'authors';
		
		// By Category
		// if( $GRAFIK_MODE['is_category'] == 1 ) $GRAFIK_VIEW[ 'inherit' ][] = 'categories';

		// Archives
		$GRAFIK_VIEW[ 'inherit' ][] = 'type';

	} else if( $GRAFIK_MODE['is_single'] == 1 ) {

		// Posts
		$GRAFIK_VIEW[ 'inherit' ][] = 'type';

	} else if( $GRAFIK_MODE['is_page'] == 1 ) {

		// Pages
		$GRAFIK_VIEW[ 'inherit' ][] = 'pages';

	} else if( $GRAFIK_MODE['is_404'] == 1 ) {

		// 404 Error Page
		$GRAFIK_VIEW[ 'inherit' ][] = '404errors';

	}

	$GRAFIK_TITLE = get_the_title( $GRAFIK_OBJECT_ID );
	$GRAFIK_META = get_post_meta( $GRAFIK_OBJECT_ID );
	$GRAFIK_FUNCTIONS = json_decode( $GRAFIK_META[ 'Grafik_Functions' ][ 0 ], true );

	#
	# MENU LOCATIONS
	#
	$GRAFIK_MENU_LOCATIONS = array(
		'header-tl', 'header-tr', 'header-ml', 'header-mr', 'header-bl', 'header-br',
		'content-t', 'content-l', 'content-c', 'content-r', 'content-b',
		'footer-tl', 'footer-tr', 'footer-ml', 'footer-mr', 'footer-bl', 'footer-br'
	);
	$GRAFIK_MENUS = array();
	foreach($GRAFIK_MENU_LOCATIONS as $key => $val) {
		$GRAFIK_MENUS[$val] = wp_nav_menu( array(
			'theme_location' => $val,
			'menu_id' => 'theme-menu-'.$val,
			'menu_class' => null,
			'container' => false,
			'fallback_cb' => null,
			'echo' => false
		) );
	}

	#
	# THEME HTML
	#

	$GRAFIK_HTML = array(
		'styles' => array( 'html' => '' ),
		'header' => array( 'tl' => '', 'tr' => '', 'ml' => '', 'mr' => '', 'bl' => '', 'br' => '' ),
		'content' => array( 't' => '', 'l' => '', 'c' => '', 'r' => '', 'b' => '' ),
		'footer' => array( 'tl' => '', 'tr' => '', 'ml' => '', 'mr' => '', 'bl' => '', 'br' => '' ),
		'scripts' => array( 'html' => '' )
	);
	foreach( $GRAFIK_VIEW[ 'document' ] as $doc_key => $doc_vals ) {
		foreach( $doc_vals as $doc_val ) {
			foreach( $GRAFIK_VIEW[ 'inherit' ] as $inherit_val ) {
				// echo '<!-- $GRAFIK_HTML[ '.$doc_key.' ][ '.$doc_val.' ][ $GRAFIK_FUNCTIONS[ '.$doc_key.' ][ behavior-'.$doc_val.'-'.$inherit_val.' ] ] -->'."\n";
				if( !isset( $GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-'.$inherit_val ] ] ) ) {
					$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-'.$inherit_val ] ] = '';
				}
				$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-'.$inherit_val ] ] .= Grafik_ReadDecode( $GRAFIK_OPTIONS[ $inherit_val ][ $doc_key ][ $doc_val ] );
			}
			if( !isset( $GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-self' ] ] ) ) {
				$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-self' ] ] = '';
			}
			$GRAFIK_HTML[ $doc_key ][ $doc_val ][ $GRAFIK_FUNCTIONS[ $doc_key ][ 'behavior-'.$doc_val.'-self' ] ] .= Grafik_ReadDecode( $GRAFIK_FUNCTIONS[ $doc_key ][ $doc_val ] );
			$GRAFIK_HTML[ $doc_key ][ $doc_val ][ 0 ] = '';
			ksort( $GRAFIK_HTML[ $doc_key ][ $doc_val ] );
			$GRAFIK_HTML[ $doc_key ][ $doc_val ] = implode( '', $GRAFIK_HTML[ $doc_key ][ $doc_val ] );
		}
	}

	#
	# THEME OUTPUT
	#

	global $wp_query;
	echo
	'<!DOCTYPE html>'.
	'<html '.$GRAFIK_LANG.' class="no-js">'.
		'<head>'.
			'<meta charset="'.$GRAFIK_CHAR.'" />'.
			'<title>'.Grafik_EchoString( 'wp_title' ).'</title>'.
			'<meta http-equiv="X-UA-Compatible" content="IE=edge">'.
			'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />'.
			'<link rel="pingback" href="'.$GRAFIK_PING.'" />'.
			Grafik_Favicon().
			'<!--[if lt IE 9]><script src="'.esc_url( get_template_directory_uri() ).'/js/html5.js"></script><![endif]-->'.
			'<script src="'.esc_url( get_template_directory_uri() ).'/js/modernizr.js"></script>'.
			str_replace( "\n", '', Grafik_EchoString( 'wp_head' ) ).
			Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'styles' ][ 'html' ] ).
		'</head>'.
		'<body '.Grafik_EchoString( 'body_class' ).'>'.
			'<div class="theme">'.
				'<section class="theme-header">'.
					'<div class="theme-header-top">'.
						'<div class="theme-header-top-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['header-tl'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'tl' ] ) ).'</div>'.
						'<div class="theme-header-top-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['header-tr'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'tr' ] ) ).'</div>'.
					'</div>'.
					'<div class="theme-header-middle">'.
						'<div class="theme-header-middle-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['header-ml'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'ml' ] ) ).'</div>'.
						'<div class="theme-header-middle-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['header-mr'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'mr' ] ) ).'</div>'.
					'</div>'.
					'<div class="theme-header-bottom">'.
						'<div class="theme-header-bottom-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['header-bl'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'bl' ] ) ).'</div>'.
						'<div class="theme-header-bottom-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['header-br'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'header' ][ 'br' ] ) ).'</div>'.
					'</div>'.
				'</section>'.
				'<section class="theme-content">'.
					'<div class="theme-content-top">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-t'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 't' ] ) ).'</div>'.
					'<div class="theme-content-middle">'.
						'<div class="theme-content-middle-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-l'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'l' ] ) ).'</div>'.
						'<div class="theme-content-middle-center">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-c'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'c' ] ) ).'</div>'.
						'<div class="theme-content-middle-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-r'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'r' ] ) ).'</div>'.
					'</div>'.
					'<div class="theme-content-bottom">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['content-b'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'content' ][ 'b' ] ) ).'</div>'.
				'</section>'.
				'<section class="theme-footer">'.
					'<div class="theme-footer-top">'.
						'<div class="theme-footer-top-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['footer-tl'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'tl' ] ) ).'</div>'.
						'<div class="theme-footer-top-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['footer-tr'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'tr' ] ) ).'</div>'.
					'</div>'.
					'<div class="theme-footer-middle">'.
						'<div class="theme-footer-middle-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['footer-ml'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'ml' ] ) ).'</div>'.
						'<div class="theme-footer-middle-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['footer-mr'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'mr' ] ) ).'</div>'.
					'</div>'.
					'<div class="theme-footer-bottom">'.
						'<div class="theme-footer-bottom-left">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['footer-bl'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'bl' ] ) ).'</div>'.
						'<div class="theme-footer-bottom-right">'.str_replace("{{ MENU }}", $GRAFIK_MENUS['footer-br'], Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'footer' ][ 'br' ] ) ).'</div>'.
					'</div>'.
				'</section>'.
			'</div>'.
			str_replace( "\n", '', Grafik_EchoString( 'wp_footer' ) ).
			Grafik_ShortcodeLoop( $GRAFIK_HTML[ 'scripts' ][ 'html' ] ).
			// "\n<!-- wp_query: ".print_r( $wp_query, true )." -->".
			// "\n<!-- GRAFIK_OBJECT_ID: ".$GRAFIK_OBJECT_ID." -->".
			// "\n<!-- GRAFIK_MODE: ".print_r( $GRAFIK_MODE, true )." -->".
			// "\n<!-- GRAFIK_OPTIONS: ".print_r( $GRAFIK_OPTIONS, true )." -->".
			// "\n<!-- GRAFIK_OBJECT: ".print_r( $GRAFIK_OBJECT, true )." -->".
			// "\n<!-- GRAFIK_TYPES: ".print_r( $GRAFIK_TYPES, true )." -->".
			// "\n<!-- GRAFIK_META: ".print_r( $GRAFIK_META, true )." -->".
			// "\n<!-- GRAFIK_HTML: ".htmlspecialchars( print_r( $GRAFIK_HTML, true ) )." -->".
			// "\n<!-- GRAFIK_MENUS: ".print_r( $GRAFIK_MENUS, true )." -->".
		'</body>'.
	'</html>';

?>