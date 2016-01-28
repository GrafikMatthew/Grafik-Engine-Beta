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

		$GRAFIK_FUNCTIONS = json_decode('{
			"global" : {
				"label" : "GLOBAL",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_Global_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_Global_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_Global_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_Global_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_Global_Scripts" }
				}
			},
			"404-errors" : {
				"label" : "404 Errors",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_404Errors_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_404Errors_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_404Errors_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_404Errors_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_404Errors_Scripts" }
				}
			},
			"pages" : {
				"label" : "Static Pages",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_Pages_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_Pages_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_Pages_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_Pages_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_Pages_Scripts" }
				}
			},
			"blog" : {
				"label" : "Blog",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_Blog_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_Blog_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_Blog_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_Blog_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_Blog_Scripts" },
					"structure" : { "label" : "Structure", "function" : "Grafik_Functions_Blog_Structure" }
				}
			},
			"blog-authors" : {
				"label" : "Blog Authors",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_BlogAuthors_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_BlogAuthors_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_BlogAuthors_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_BlogAuthors_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_BlogAuthors_Scripts" },
					"structure" : { "label" : "Structure", "function" : "Grafik_Functions_BlogAuthors_Structure" }
				}
			},
			"blog-categories" : {
				"label" : "Blog Categories",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_BlogCategories_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_BlogCategories_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_BlogCategories_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_BlogCategories_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_BlogCategories_Scripts" },
					"structure" : { "label" : "Structure", "function" : "Grafik_Functions_BlogCategories_Structure" }
				}
			},
			"blog-posts" : {
				"label" : "Blog Posts",
				"map" : {
					"styles" : { "label" : "Styles", "function" : "Grafik_Functions_BlogPosts_Styles" },
					"header" : { "label" : "Header", "function" : "Grafik_Functions_BlogPosts_Header" },
					"content" : { "label" : "Content", "function" : "Grafik_Functions_BlogPosts_Content" },
					"footer" : { "label" : "Footer", "function" : "Grafik_Functions_BlogPosts_Footer" },
					"scripts" : { "label" : "Scripts", "function" : "Grafik_Functions_BlogPosts_Scripts" },
					"structure" : { "label" : "Structure", "function" : "Grafik_Functions_BlogPosts_Structure" }
				}
			}
		}',true);

		$active_primary = isset( $_GET[ 'func' ] ) ? $_GET[ 'func' ] : '';
		if( !array_key_exists( $active_primary, $GRAFIK_FUNCTIONS ) ) {
			reset( $GRAFIK_FUNCTIONS );
			$active_primary = key( $GRAFIK_FUNCTIONS );
		}
		$output_primary = '';
		foreach( $GRAFIK_FUNCTIONS as $key => $val ) {
			$output_primary .=
			'<li'.( $active_primary == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page='.$_GET[ 'page' ].'&amp;func='.$key.'">'.
					$val[ 'label' ].
				'</a>'.
			'</li>';
		}

		$active_secondary = isset( $_GET[ 'edit' ] ) ? $_GET[ 'edit' ] : '';
		if( !array_key_exists( $active_secondary, $GRAFIK_FUNCTIONS[$active_primary]['map'] ) ) {
			reset( $GRAFIK_FUNCTIONS[ $active_primary ][ 'map' ] );
			$active_secondary = key( $GRAFIK_FUNCTIONS[ $active_primary ][ 'map' ] );
		}
		$output_secondary = '';
		foreach( $GRAFIK_FUNCTIONS[ $active_primary ][ 'map' ] as $key => $val ) {
			$output_secondary .=
			'<li'.( $active_secondary == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page='.$_GET[ 'page' ].'&amp;func='.$active_primary.'&amp;edit='.$key.'">'.
					$val[ 'label' ].
				'</a>'.
			'</li>';
		}

		include dirname( __FILE__ ).'/../functions/'.$active_primary.'.php';

		echo
		'<div class="grafik-functions">'.
			'<h1><span>Templates</span></h1>'.
			'<div class="grafik-functions-display">'.
				'<div class="grafik-functions-primarynav">'.
					'<ul>'.$output_primary.'</ul>'.
				'</div>'.
				'<div class="grafik-functions-primarydisplay">'.
					'<h2>'.$GRAFIK_FUNCTIONS[ $active_primary ][ 'label' ].'</h2>'.
					'<div class="grafik-functions-secondarynav">'.
						'<ul>'.$output_secondary.'</ul>'.
					'</div>'.
					'<div class="grafik-functions-secondarydisplay">'.
						'<h3>'.$GRAFIK_FUNCTIONS[$active_primary]['map'][$active_secondary]['label'].'</h3>'.
						call_user_func( $GRAFIK_FUNCTIONS[$active_primary]['map'][$active_secondary]['function'] ).
					'</div>'.
				'</div>'.
				'<script type="text/javascript" src="'.get_template_directory_uri().'/js/functions.js"></script>'.
			'</div>'.
		'</div>'.
		Grafik_ProfileColors();

	}

?>