<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'Blog', 'Grafik_Functions_Shortcode_Blog' );
	function Grafik_Functions_Shortcode_Blog( $atts ) {

		global $GRAFIK_MODE;

		$a = shortcode_atts( array(
			'empty_msg' => 'No posts to show, the blog is empty!',
			'page_mode' => 'lazy', // valid: lazy | links
			'page_links_prev' => '&ldquo; Prev',
			'page_links_next' => 'Next &rdquo;',
			'page_lazy_mode' => 'scroll', // valid: scroll | click
			'page_lazy_scroll' => 'Loading More',
			'page_lazy_click' => 'Load More',
			'class' => '',
			'id' => ''
		), $atts, "Blog" );

		$callback_structures = array(
			'home' => json_decode( get_option( 'Grafik_Functions_Blog_Structure', true ), true),
			'author' => json_decode( get_option( 'Grafik_Functions_BlogAuthors_Structure', true ), true),
			'category' => json_decode( get_option( 'Grafik_Functions_BlogCategories_Structure', true ), true),
			'post' => json_decode( get_option( 'Grafik_Functions_BlogPosts_Structure', true ), true)
		);

		$callback_output = '';
		if(have_posts()) {
			while(have_posts()) {
				$callback_template = '';
				if($GRAFIK_MODE['is_home'] == 1) {
					$callback_template = Grafik_ReadDecode( $callback_structures[ 'home' ][ 'html' ] );
				} else if($GRAFIK_MODE['is_archive'] == 1) {
					$callback_template = Grafik_ReadDecode( $callback_structures[ 'home' ][ 'html' ] );
				} else if($GRAFIK_MODE['is_author'] == 1) {
					$callback_template = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'author' ][ 'behavior-html' ] == 1 ? 'home' : 'author' ) ][ 'html' ] );
				} else if($GRAFIK_MODE['is_category'] == 1) {
					$callback_template = Grafik_ReadDecode( $callback_structures[ ( $callback_structures[ 'category' ][ 'behavior-html' ] == 1 ? 'home' : 'category' ) ][ 'html' ] );
				} else if($GRAFIK_MODE['is_single'] == 1) {
					$callback_template = Grafik_ReadDecode( $callback_structures[ 'post' ][ 'html' ] );
				}
				$callback_assets = Grafik_Functions_Shortcode_Blog_Assets();
				$callback_output .= str_replace($callback_assets['tokens'], $callback_assets['values'], $callback_template);
			}
		} else {
			$callback_output .= '<span class="empty-message">'.$a['empty_msg'].'</span>';
		}

		if( $GRAFIK_MODE[ 'is_single' ] != 1 ) {
			if( $a[ 'page_mode' ] == 'lazy' ) {
				$callback_output =
					'<div class="lazy-wrapper">'.$callback_output.'</div>'.
					($a['page_lazy_mode'] != 'scroll' ? '' : '<div class="lazy-loader-scroll"><span>'.$a['page_lazy_scroll'].'</span></div>').
					($a['page_lazy_mode'] != 'click' ? '' : '<div class="lazy-loader-click"><span>'.$a['page_lazy_click'].'</span></div>').
					'<script src="'.esc_url(get_template_directory_uri()).'/js/shortcodes/Blog.js"></script>';
			} else if( $a[ 'page_mode' ] == 'links' ) {
				$callback_output =
					'<div class="links-wrapper">'.$callback_output.'</div>'.
					'<div class="links-pagination">'.'<span>## TODO: PAGINATION ##</span>'.'</div>';
			} else {
				$callback_output =
					'<div class="default-wrapper">'.$callback_output.'</div>';
			}
		}

		return
		'<div class="theme-blog'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			$callback_output.
		'</div>';

	}

	function Grafik_Functions_Shortcode_Blog_Assets() {

		the_post();
		global $post;

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
		$category_names = array();
		$category_links = array();
		$post_categories = wp_get_post_categories( $post->ID );
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

		$assets_date = explode('|', date("d|j|S|l|D|m|n|F|M|Y|y|a|A|g|h|G|H|i|s|T|c|r", strtotime($post->post_date_gmt)));
		$assets = array(
			'raw' => print_r($post, true),
			'tokens' => array(
				'{{ ID }}',
				'{{ PARENT_ID }}',
				'{{ AUTHOR_ID }}',
				'{{ AUTHOR_SLUG }}',
				'{{ AUTHOR_NAME }}',
				'{{ CATEGORY_NAMES }}',
				'{{ CATEGORY_LINKS }}',
				'{{ FEATURED_IMAGE }}',
				'{{ CONTENT }}',
				'{{ TITLE }}',
				'{{ TITLE_SLUG }}',
				'{{ EXCERPT }}',
				'{{ GUID }}',
				'{{ PERMALINK }}',
				'{{ DATE_DAY }}',
				'{{ DATE_DAY_PADDED }}',
				'{{ DATE_DAY_SUFFIX }}',
				'{{ DATE_WEEKDAY }}',
				'{{ DATE_WEEKDAY_ABBR }}',
				'{{ DATE_MONTH }}',
				'{{ DATE_MONTH_PADDED }}',
				'{{ DATE_MONTH_FULL }}',
				'{{ DATE_MONTH_ABBR }}',
				'{{ DATE_YEAR }}',
				'{{ DATE_YEAR_ABBR }}',
				'{{ TIME_24H }}',
				'{{ TIME_24H_PADDED }}',
				'{{ TIME_12H }}',
				'{{ TIME_12H_PADDED }}',
				'{{ TIME_12H_SUFFIX }}',
				'{{ TIME_MINUTES }}',
				'{{ TIME_SECONDS }}',
				'{{ TIME_ZONE }}',
				'{{ TIME_ISO8601 }}',
				'{{ TIME_RFC2822 }}'
			),
			'values' => array(
				$post->ID,
				$post->post_parent,
				$post->post_author,
				get_the_author_meta('user_nicename'),
				get_the_author(),
				'<ul>'.implode( '', $category_names ).'</ul>',
				'<ul>'.implode( '', $category_links ).'</ul>',
				get_the_post_thumbnail(),
				$post->post_content,
				$post->post_title,
				$post->post_name,
				get_the_excerpt(),
				$post->guid,
				get_permalink(),
				$assets_date[1],
				$assets_date[0],
				$assets_date[2],
				$assets_date[3],
				$assets_date[4],
				$assets_date[6],
				$assets_date[5],
				$assets_date[7],
				$assets_date[8],
				$assets_date[9],
				$assets_date[10],
				$assets_date[15],
				$assets_date[16],
				$assets_date[13],
				$assets_date[14],
				$assets_date[11],
				$assets_date[17],
				$assets_date[18],
				$assets_date[19],
				$assets_date[20],
				$assets_date[21]
			)
		);

		return $assets;

	}

?>