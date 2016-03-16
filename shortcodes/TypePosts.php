<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypePosts', 'Grafik_Functions_Shortcode_TypePosts' );
	function Grafik_Functions_Shortcode_TypePosts( $atts, $content = '' ) {

		global $wp_query;
		global $GRAFIK_MODE;
		$callback_output = '';

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
			'post' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Structure', true ), true),
			'search' => json_decode( get_option( 'Grafik_Functions_Search_Structure', true ), true )
		);

		if( $GRAFIK_MODE[ 'is_single' ] == 1 ) {

			// Determine which template to use...
			// $post_structure = Grafik_ReadDecode( $callback_structures[ 'post' ][ 'html' ] );
			$post_structure = $content;

			// Get the post...
			$callback_output .= Grafik_CurlyCodes( get_the_ID(), $post_structure );

		} else {

			// Determine which template to use...
			if( $GRAFIK_MODE[ 'is_author' ] == 1 ) {
				$post_structure = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'author' ][ 'behavior-html' ] == 1 ? 'home' : 'author' ) ][ 'html' ] );
			} else if( $GRAFIK_MODE[ 'is_category' ] == 1 ) {
				$post_structure = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'category' ][ 'behavior-html' ] == 1 ? 'home' : 'category' ) ][ 'html' ] );
			} else if( $GRAFIK_MODE[ 'is_search' ] == 1)  {
				$post_structure = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'search' ][ 'behavior-html '] == 1 ? 'home' : 'search' ) ][ 'html' ] );
			} else {
				$post_structure = Grafik_ReadDecode( $callback_structures[ 'home' ][ 'html' ] );
			}

			// Construct the query...
			$callback_query = new WP_Query( array(
				'post_type' => explode( ',', $a[ 'type' ] )
				, 'author' => $wp_query->query_vars[ 'author' ]
				, 'cat' => $wp_query->query_vars[ 'cat' ]
				, 'paged' => $wp_query->query_vars[ 'paged' ]
				, 's' => get_search_query()
			) );

			// Loop the query...
			if( $callback_query->have_posts() ) {
				while( $callback_query->have_posts() ) {
					$callback_query->the_post();
					$callback_output .= Grafik_CurlyCodes( get_the_ID(), $post_structure );
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
		'<!-- '.print_r( $callback_query, true ).' -->'.
		'<div class="theme-typeposts'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			$callback_output.
		'</div>';

	}

?>