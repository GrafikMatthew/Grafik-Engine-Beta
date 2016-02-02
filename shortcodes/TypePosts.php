<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypePosts', 'Grafik_Functions_Shortcode_TypePosts' );
	function Grafik_Functions_Shortcode_TypePosts( $atts ) {

		global $wp_query;
		global $GRAFIK_MODE;

		$a = shortcode_atts( array(

			'type' => 'post',
			'empty_msg' => 'No posts to show, this archive is empty!',
			'listing_page' => 'single',
			'single_mode' => 'scroll',
			'single_scroll' => 'Loading More',
			'single_click' => 'Load More',
			'multi_prev' => '&ldquo; Prev',
			'multi_next' => 'Next &rdquo;',

			'class' => '',
			'id' => ''

		), $atts, 'TypePosts' );

		$callback_structures = array(
			'home' => json_decode( get_option( 'Grafik_Functions_Blog_Structure', true ), true),
			'author' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Structure', true ), true),
			'category' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Structure', true ), true),
			'post' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Structure', true ), true)
		);

		$callback_output = '';
		if( $GRAFIK_MODE[ 'is_single' ] == 1 ) {

			// Determine which template to use...
			$post_structure = Grafik_ReadDecode( $callback_structures[ 'post' ][ 'html' ] );

			// Get the post...
			$callback_output .= Grafik_Functions_Shortcode_TypePosts_Assets( get_the_ID(), $post_structure );

		} else {

			// Determine which template to use...
			if( $GRAFIK_MODE[ 'is_author' ] == 1 ) {
				$post_structure = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'author' ][ 'behavior-html' ] == 1 ? 'home' : 'author' ) ][ 'html' ] );
			} else if( $GRAFIK_MODE[ 'is_category' ] == 1 ) {
				$post_structure = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'category' ][ 'behavior-html' ] == 1 ? 'home' : 'category' ) ][ 'html' ] );
			} else {
				$post_structure = Grafik_ReadDecode( $callback_structures[ 'home' ][ 'html' ] );
			}

			// Construct the query...
			$callback_query = new WP_Query( array(
				'post_type' => $a[ 'type' ]
				, 'author' => $wp_query->query_vars[ 'author' ]
				, 'cat' => $wp_query->query_vars[ 'cat' ]
				, 'paged' => $wp_query->query_vars[ 'paged' ]
			) );

			// Loop the query...
			if( $callback_query->have_posts() ) {
				while( $callback_query->have_posts() ) {
					$callback_query->the_post();
					$callback_output .= Grafik_Functions_Shortcode_TypePosts_Assets( get_the_ID(), $post_structure );
				}
				wp_reset_postdata();
			} else {
				$callback_output .= '<span class="empty-message">'.$a['empty_msg'].'</span>';
			}

			// Additional posts...
			if( $a[ 'listing_page' ] == 'single' ) {
				$callback_output =
				'<div class="single-wrapper">'.$callback_output.'</div>'.
				( $a[ 'single_mode' ] != 'scroll' ? '' : '<div class="single-scroll-loader"><span>'.$a[ 'single_scroll' ].'</span></div>' ).
				( $a[ 'single_mode' ] != 'click' ? '' : '<div class="single-click-loader"><span>'.$a[ 'single_click' ].'</span></div>' ).
				'<script src="'.esc_url( get_template_directory_uri() ).'/js/shortcodes/TypePosts.js"></script>';
			} else if( $a[ 'listing_page' ] == 'multi' ) {
				$callback_output =
				'<div class="multi-wrapper">'.$callback_output.'</div>'.
				'<div class="links-pagination">## TODO: PAGINATION ##</div>';
			} else {
				$callback_output =
				'<div class="default-wrapper">'.$callback_output.'</div>';
			}

		}

		return
		'<div class="theme-typeposts'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			$callback_output.
		'</div>';

	}

	function Grafik_Functions_Shortcode_TypePosts_Assets( $post_id, $post_structure = '' ) {

		if( empty( $post_structure ) ) return '';

		#
		# RESOURCES
		#
		$post = get_post( $post_id );
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
		$category_names = array();
		$category_links = array();
		$post_categories = wp_get_post_categories( $post_id );
		foreach( $post_categories as $category_id ) {
			if( $options[ 'behavior-'.$category_id ] == 1 ) continue;
			if( $options[ 'behavior-'.$category_id ] == 3 ) continue;
			$category = get_category( $category_id );
			$category->URL = get_category_link( $category_id );
			$category_names[] =
			'<li class="cat-item cat-item-'.$category_id.'">'.
				$category->name.
			'</li>';
			$category_links[] =
			'<li class="cat-item cat-item-'.$category_id.'">'.
				'<a href="'.$category->URL.'">'.
					$category->name.
				'</a>'.
			'</li>';
		}

		$assets_date = explode('|', date(
			"d|j|S|l|D|m|n|F|M|Y|y|a|A|g|h|G|H|i|s|T|c|r",
			strtotime( $post->post_date_gmt )
		) );
		$assets = array(
			'raw' => print_r( $post, true )
			, array( '{{ ID }}', $post->ID )
			, array( '{{ PARENT_ID }}', $post->post_parent )
			, array( '{{ AUTHOR_ID }}', $post->post_author )
			, array( '{{ AUTHOR_SLUG }}', get_the_author_meta( 'user_nicename' ) )
			, array( '{{ AUTHOR_NAME }}', get_the_author() )
			, array( '{{ CATEGORY_NAMES }}', '<ul>'.implode( '', $category_names ).'</ul>' )
			, array( '{{ CATEGORY_LINKS }}', '<ul>'.implode( '', $category_links ).'</ul>' )
			, array( '{{ FEATURED_IMAGE }}', get_the_post_thumbnail() )
			, array( '{{ CONTENT }}', $post->post_content )
			, array( '{{ TITLE }}', $post->post_title )
			, array( '{{ TITLE_SLUG }}', $post->post_name )
			, array( '{{ EXCERPT }}', get_the_excerpt() )
			, array( '{{ GUID }}', $post->guid )
			, array( '{{ PERMALINK }}', get_permalink() )
			, array( '{{ DATE_DAY }}', $assets_date[1] )
			, array( '{{ DATE_DAY_PADDED }}', $assets_date[0] )
			, array( '{{ DATE_DAY_SUFFIX }}', $assets_date[2] )
			, array( '{{ DATE_WEEKDAY }}', $assets_date[3] )
			, array( '{{ DATE_WEEKDAY_ABBR }}', $assets_date[4] )
			, array( '{{ DATE_MONTH }}', $assets_date[6] )
			, array( '{{ DATE_MONTH_PADDED }}', $assets_date[5] )
			, array( '{{ DATE_MONTH_FULL }}', $assets_date[7] )
			, array( '{{ DATE_MONTH_ABBR }}', $assets_date[8] )
			, array( '{{ DATE_YEAR }}', $assets_date[9] )
			, array( '{{ DATE_YEAR_ABBR }}', $assets_date[10] )
			, array( '{{ TIME_24H }}', $assets_date[15] )
			, array( '{{ TIME_24H_PADDED }}', $assets_date[16] )
			, array( '{{ TIME_12H }}', $assets_date[13] )
			, array( '{{ TIME_12H_PADDED }}', $assets_date[14] )
			, array( '{{ TIME_12H_SUFFIX }}', $assets_date[11] )
			, array( '{{ TIME_MINUTES }}', $assets_date[17] )
			, array( '{{ TIME_SECONDS }}', $assets_date[18] )
			, array( '{{ TIME_ZONE }}', $assets_date[19] )
			, array( '{{ TIME_ISO8601 }}', $assets_date[20] )
			, array( '{{ TIME_RFC2822 }}', $assets_date[21] )
		);

		foreach( $assets as $asset ) {
			$post_structure = str_replace( $asset[ 0 ], $asset[ 1 ], $post_structure );
		}

		return $post_structure;

	}

?>