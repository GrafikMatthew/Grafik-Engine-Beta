<?php

	#
	# SECURE THEME
	#

	if( !defined('ABSPATH') ) exit;

	#
	# EVENT HOOKS
	#

	add_action( 'admin_menu', function() {
		add_theme_page( 'GE: Templates', 'GE: Templates', 'manage_options', 'grafik-engine-templates', 'Grafik_Templates_Output' );
	}, 103 );

	#
	# admin_menu FUNCTION
	#

	function Grafik_Templates_Output() {

		$output_primary = '';
		$output_secondary = '';

		$template_map = array(
			'global'				=> array( 'label' => 'GLOBAL',							'prefix' => 'Grafik_Functions_Global_' ),
			'pages'					=> array( 'label' => 'Pages',							'prefix' => 'Grafik_Functions_Pages_' ),
			'not-found'				=> array( 'label' => 'Pages &mdash; Not Found',			'prefix' => 'Grafik_Functions_NotFound_' ),
			'search-results'		=> array( 'label' => 'Pages &mdash; Search Results',	'prefix' => 'Grafik_Functions_SearchResults_' ),
			'posts'					=> array( 'label' => 'Posts',							'prefix' => 'Grafik_Functions_Posts_' ),
			'post-types'			=> array( 'label' => 'Posts &mdash; Types',				'prefix' => 'Grafik_Functions_PostTypes_' ),
			'archives'				=> array( 'label' => 'Archives',						'prefix' => 'Grafik_Functions_Archives_' ),
			'archive-types'			=> array( 'label' => 'Archives &mdash; Types',			'prefix' => 'Grafik_Functions_ArchiveTypes_' ),
			'archive-authors'		=> array( 'label' => 'Archives &mdash; Authors',			'prefix' => 'Grafik_Functions_ArchiveAuthors_' ),
			'archive-categories'	=> array( 'label' => 'Archives &mdash; Categories',		'prefix' => 'Grafik_Functions_ArchiveCategories_' )
		);
		$section_map = array(
			'styles'	=> 'Styles',
			'header'	=> 'Header',
			'content'	=> 'Content',
			'footer'	=> 'Footer',
			'scripts'	=> 'Scripts'
		);

		$template = isset( $_GET[ 'template' ] ) ? $_GET[ 'template' ] : '';
		$section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : '';

		if( !array_key_exists( $template, $template_map ) ) $template = key( $template_map );
		if( !array_key_exists( $section, $section_map ) ) $section = key( $section_map );

		foreach( $template_map as $key => $val ) {
			$output_primary .=
			'<li'.( $template == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page='.$_GET[ 'page' ].'&amp;template='.$key.'">'.$val[ 'label' ].'</a>'.
			'</li>';
		}

		foreach( $section_map as $key => $val ) {
			$output_secondary .=
			'<li'.( $section == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page='.$_GET[ 'page' ].'&amp;template='.$template.'&amp;section='.$key.'">'.$val.'</a>'.
			'</li>';
		}

		include dirname( __FILE__ ).'/../functions/'.$template.'.php';

		echo
		'<div class="grafik-functions">'.
			'<h1><span>Templates</span></h1>'.
			'<div class="grafik-functions-display">'.
				'<div class="grafik-functions-primarynav">'.
					'<ul>'.$output_primary.'</ul>'.
				'</div>'.
				'<div class="grafik-functions-primarydisplay">'.
					'<h2>'.$template_map[ $template ][ 'label' ].'</h2>'.
					'<div class="grafik-functions-secondarynav">'.
						'<ul>'.$output_secondary.'</ul>'.
					'</div>'.
					'<div class="grafik-functions-secondarydisplay">'.
						'<h3>'.$section_map[ $section ].'</h3>'.
						call_user_func( $template_map[ $template ][ 'prefix' ].$section_map[ $section ] ).
					'</div>'.
				'</div>'.
				'<script type="text/javascript" src="'.get_template_directory_uri().'/js/functions.js"></script>'.
			'</div>'.
		'</div>'.
		Grafik_ProfileColors();

	}

?>