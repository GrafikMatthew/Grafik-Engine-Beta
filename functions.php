<?php

	/*

	888888 88  88 8888o. .o8888 888888 88 .o88o. 8888o. .o8888    8888o. 88  88 8888o.
	88     88  88 88  88 88       88   88 88  88 88  88 88        88  88 88  88 88  88
	8888   88  88 88  88 88       88   88 88  88 88  88 'Y88o.    8888Y' 888888 8888Y'
	88     88  88 88  88 88       88   88 88  88 88  88     88    88     88  88 88    
	88     'Y88Y' 88  88 'Y8888   88   88 'Y88Y' 88  88 8888Y' 88 88     88  88 88    

	*/

	if( !defined('ABSPATH') ) exit;

	# SUPPORT

	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form' ) );

	# FILTERS

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

	# ACTIONS

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	add_action( 'init', function() {

		register_nav_menus( array(
			'Header_TopLeft' => 'Header (Top Left)',
			'Header_TopRight' => 'Header (Top Right)',
			'Header_MiddleLeft' => 'Header (Middle Left)',
			'Header_MiddleRight' => 'Header (Middle Right)',
			'Header_BottomLeft' => 'Header (Bottom Left)',
			'Header_BottomRight' => 'Header (Bottom Right)',
			'Content_Top' => 'Content (Top)',
			'Content_Left' => 'Content (Left)',
			'Content_Center' => 'Content (Center)',
			'Content_Right' => 'Content (Right)',
			'Content_Bottom' => 'Content (Bottom)',
			'Footer_TopLeft' => 'Footer (Top Left)',
			'Footer_TopRight' => 'Footer (Top Right)',
			'Footer_MiddleLeft' => 'Footer (Middle Left)',
			'Footer_MiddleRight' => 'Footer (Middle Right)',
			'Footer_BottomLeft' => 'Footer (Bottom Left)',
			'Footer_BottomRight' => 'Footer (Bottom Right)'
		) );

		$Grafik_CustomTypes = json_decode( get_option('Grafik_PostType_Info', '[]'), true );
		foreach( $Grafik_CustomTypes as $key => $val ) {
			if( $key == 'save-time' || $key == 'save-user' ) continue;
			register_post_type( $key, array(
				'labels' => array(
					'name' => Grafik_ReadDecode( $val[ 'plural' ] ),
					'singular_name' => Grafik_ReadDecode( $val[ 'single' ] ),
					'add_new' => 'Add New',
					'add_new_item' => 'Add New '.Grafik_ReadDecode( $val[ 'single' ] ),
					'edit' => 'Edit',
					'edit_item' => 'Edit '.Grafik_ReadDecode( $val[ 'single' ] ),
					'new_item' => 'New '.Grafik_ReadDecode( $val[ 'single' ] ),
					'view' => 'View',
					'view_item' => 'View '.Grafik_ReadDecode( $val[ 'single' ] ),
					'search_items' => 'Search '.Grafik_ReadDecode( $val[ 'plural' ] ),
					'not_found' => 'No '.Grafik_ReadDecode( $val[ 'plural' ] ).' Found',
					'not_found_in_trash' => 'No '.Grafik_ReadDecode( $val[ 'plural' ] ).' Found In Trash',
					'parent' => 'Parent '.Grafik_ReadDecode( $val[ 'single' ] )
				),
				'public' => true,
				'has_archive' => true,
				'menu_position' => 6,
				'supports' => array( 'author', 'custom-fields', 'editor', 'thumbnail', 'title', 'excerpt' ),
				'taxonomies' => array( 'category' )
			) );
		}

	} );
	add_action( 'admin_init', function() {
		global $submenu;
		unset( $submenu[ 'themes.php' ][ 6 ] );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
	}, 102 );
	add_action( 'admin_enqueue_scripts', function() {
		wp_enqueue_style(
			'grafik-css',
			get_template_directory_uri().'/style.css',
			false
		);
	} );

	# FUNCTIONS

	include 'functions/filters.php';
	include 'functions/utilities.php';
	include 'functions/menus.php';
	include 'functions/metabox.php';
	include 'functions/posttypes.php';
	include 'functions/templates.php';

	# SHORTCODES

	foreach( glob( dirname( __FILE__ ).'/shortcodes/*.php' ) as $shortcode ) {
		include $shortcode;
	}

	# OPTIONS

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
