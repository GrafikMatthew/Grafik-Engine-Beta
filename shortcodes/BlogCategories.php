<?php

	#
	# SECURED THEME
	#
	if( !defined('ABSPATH') ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( "BlogCategories", function( $atts ) {

		#
		# GET OPTIONS
		#
		$options = json_decode( get_option('Grafik_CategoryFilters', '[]'), true );

		#
		# FORMULATE EXCLUSIONS
		#
		$exclusions = array();
		foreach( $options as $key => $val ) {
			if( strpos( $key, 'behavior-' ) !== 0 ) continue;
			if( $val == 1 || $val == 3 ) {
				$key_parts = explode( '-', $key );
				$key_id = (int)end( $key_parts );
				$exclusions[] = $key_id;
			}
		}

		#
		# GET CATEGORIES
		#
		$a = shortcode_atts( array(
			'heading' => 'Blog Categories',
			'orderby' => 'name', // Values: ID, name, slug, count, term_group
			'order' => 'ASC', // Values: ASC, DESC
			'show_count' => 1, // Values: 0(false), 1(true)
			'hide_empty' => 1, // Values: 0(false), 1(true)
			'hierarchical' => 1, // Values: 0(false), 1(true)
			'depth' => 0,
			'pad_counts' => 0,
			'show_option_none' => 'No Categories',
			'number' => null,
			'class' => '',
			'id' => ''
		), $atts, "BlogCategories" );
		$categories = wp_list_categories( array(
			'orderby' => $a['orderby'],
			'order' => $a['order'],
			'show_count' => $a['show_count'],
			'hide_empty' => $a['hide_empty'],
			'hierarchical' => $a['hierarchical'],
			'depth' => $a['depth'],
			'pad_counts' => $a['pad_counts'],
			'show_option_none' => $a['show_option_none'],
			'number' => $a['number'],
			'use_desc_for_title' => 0,
			'exclude' => implode( ',', $exclusions ),
			'title_li' => '',
			'echo' => 0,
		) );

		#
		# RETURN OUTPUT
		#
		return
		'<div class="theme-blogcategories'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<div class="theme-blogcategories-interior">'.
				( empty( $a['heading'] ) ? null : '<h2>'.$a['heading'].'</h2>' ).
				( empty( $categories ) ? null : '<ul>'.$categories.'</ul>' ).
				'<!-- options: '.print_r( $options, true ).' -->'.
				'<!-- categories: '.print_r( $categories, true ).' -->'.
			'</div>'.
		'</div>';

	} );

?>