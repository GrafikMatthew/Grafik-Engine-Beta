<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	#
	# DEPENDENCIES
	#

	include 'functions/utilities.php';

	include 'admin/categoryfilters.php';
	include 'admin/posttypes.php';
	include 'admin/metabox.php';
	include 'admin/templates.php';

	// include 'integrations/yoast.php';

	foreach( glob( dirname( __FILE__ ).'/shortcodes/*.php' ) as $shortcode ) {
		include $shortcode;
	}

	#
	# THEME CSS
	#

	add_action( 'admin_enqueue_scripts', 'Grafik_Functions_EnqueueScripts' );
	function Grafik_Functions_EnqueueScripts() {
		wp_enqueue_style( 'grafik-css', get_template_directory_uri().'/style.css', false );
	}

	/*
	wp_register_style( 'grafik-theme', get_template_directory_uri().'/style.css', false, '1.0.0' );
	wp_enqueue_style( 'grafik-theme' );
	*/

	#
	# THEME SUPPORT
	#

	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );

	#
	# THEME FILTERS
	#

 	add_filter( 'show_admin_bar', '__return_false' );
	add_filter( 'get_search_form', function( $form ) {

		return
		'<form role="search" method="GET" class="theme-blogsearch" action="'.get_permalink( get_option( 'page_for_posts' ) ).'">'.
			'<label>'.
				'<div class="label">Search</div>'.
				'<div class="input"><input type="text" value="'.get_search_query().'" name="s" placeholder="SEARCH BLOG" /></div>'.
			'</label>'.
			'<div class="submit"><button type="submit">Search</button></div>'.
			'<input type="hidden" value="post" name="post_type" />'.
		'</form>';

	} );

	#
	# ACTIONS
	#

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	add_action( 'init', function() {

		// Menu Locations...
		register_nav_menus( array(
			'header-tl' => 'Header (Top Left)',
			'header-tr' => 'Header (Top Right)',
			'header-ml' => 'Header (Middle Left)',
			'header-mr' => 'Header (Middle Right)',
			'header-bl' => 'Header (Bottom Left)',
			'header-br' => 'Header (Bottom Right)',
			'content-t' => 'Content (Top)',
			'content-l' => 'Content (Left)',
			'content-c' => 'Content (Center)',
			'content-r' => 'Content (Right)',
			'content-b' => 'Content (Bottom)',
			'footer-tl' => 'Footer (Top Left)',
			'footer-tr' => 'Footer (Top Right)',
			'footer-ml' => 'Footer (Middle Left)',
			'footer-mr' => 'Footer (Middle Right)',
			'footer-bl' => 'Footer (Bottom Left)',
			'footer-br' => 'Footer (Bottom Right)'
		) );

		// Custom Types...
		$Grafik_CustomTypes = json_decode( get_option('Grafik_PostTypes', '[]'), true );
		foreach( $Grafik_CustomTypes as $key => $val ) {
			if( $key == 'save-time' || $key == 'save-user' ) continue;
			register_post_type( $key, array(
				'labels' => array(
					'name' => Grafik_ReadDecode( $val[ 'plural' ] ),
					'singular_name' => Grafik_ReadDecode( $val[ 'singular' ] ),
					'add_new' => 'Add New',
					'add_new_item' => 'Add New '.Grafik_ReadDecode( $val[ 'singular' ] ),
					'edit' => 'Edit',
					'edit_item' => 'Edit '.Grafik_ReadDecode( $val[ 'singular' ] ),
					'new_item' => 'New '.Grafik_ReadDecode( $val[ 'singular' ] ),
					'view' => 'View',
					'view_item' => 'View '.Grafik_ReadDecode( $val[ 'singular' ] ),
					'search_items' => 'Search '.Grafik_ReadDecode( $val[ 'plural' ] ),
					'not_found' => 'No '.Grafik_ReadDecode( $val[ 'plural' ] ).' Found',
					'not_found_in_trash' => 'No '.Grafik_ReadDecode( $val[ 'plural' ] ).' Found In Trash',
					'parent' => 'Parent '.Grafik_ReadDecode( $val[ 'singular' ] )
				),
				'public' => ( $val[ 'public' ] == 1 ? true : false ),
				'menu_position' => 6,
				'supports' => array( 'author', 'custom-fields', 'editor', 'thumbnail', 'title' ),
				'taxonomies' => array( 'category' ),
				'has_archive' => ( $val[ 'archive' ] == 1 ? true : false )
			) );
		}

	} );

	add_action( 'admin_init', function() {
		global $submenu;
		unset( $submenu[ 'themes.php' ][ 6 ] );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
	}, 102 );

	// Custom General Options
	class Grafik_GeneralSetting_AdminMenu_HidePosts {
		function Grafik_GeneralSetting_AdminMenu_HidePosts() {
			add_filter( 'admin_init', array( &$this, 'register_fields' ) );
		}
		function register_fields() {
			register_setting(
				'general',
				'Grafik_AdminMenu_HidePosts',
				'esc_attr'
			);
			add_settings_field(
				'Grafik_AdminMenu_HidePosts',
				'<label for="Grafik_AdminMenu_HidePosts">Posts Menu</label>',
				array( &$this, 'fields_html' ),
				'general'
			);
		}
		function fields_html() {
			$value = get_option( 'Grafik_AdminMenu_HidePosts', '' );
			echo '<input type="checkbox" id="Grafik_AdminMenu_HidePosts" name="Grafik_AdminMenu_HidePosts"'.( $value == 'on' ? ' checked' : '' ).' /> Check to Hide';
		}
	}
	$Grafik_GSAMHP = new Grafik_GeneralSetting_AdminMenu_HidePosts();
	if( get_option( 'Grafik_AdminMenu_HidePosts', '' ) == 'on' ) {
		add_action( 'admin_menu', function() {
			remove_menu_page( 'edit.php' );
		} );
	}

?>
