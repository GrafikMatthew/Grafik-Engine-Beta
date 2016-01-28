<?php

	if( !defined( 'ABSPATH' ) ) exit;

	add_shortcode( 'RecentPosts', 'Grafik_Functions_Shortcodes_RecentPosts' );
	function Grafik_Functions_Shortcodes_RecentPosts( $atts, $content = null ) {

		$shortcode_output = '';

		$a = shortcode_atts( array(
			'heading' => 'Recent Posts',
			'number' => -1,
			'mode' => 'category', // category, author
			'sources' => 0,
			'unfiltered' => 1,
			'class' => '',
			'id' => ''
		), $atts, 'RecentPosts' );

		$query_params = array(
			'posts_per_page' => $a['number'],
			'ignore_filters' => $a['unfiltered']
		);
		if( $a['mode'] == 'category' ) $query_params['cat'] = $a['sources'];
		if( $a['mode'] == 'author' ) $query_params['author'] = $a['sources'];
		$RecentPosts = new WP_Query( $query_params );
		while( $RecentPosts->have_posts() ) {

			$RecentPosts->the_post();
			$RecentPost = get_post();

			$RecentPost_Date = explode( '|', date(
				"d|j|S|l|D|m|n|F|M|Y|y|a|A|g|h|G|H|i|s|T|c|r",
				strtotime( $RecentPost->post_date )
			) );

			$RecentPost_CategoryNames = array();
			$RecentPost_CategoryLinks = array();
			$RecentPost_CategoryIds = wp_get_post_categories( $RecentPost->ID );
			foreach( $RecentPost_CategoryIds as $RecentPost_CategoryId ) {
				if($a['mode'] == 'category') {
					$a_sources = explode( ',', $a['sources'] );
					if( in_array( $RecentPost_CategoryId, $a_sources ) ) continue;
				}
				$category = get_category( $RecentPost_CategoryId );
				$category->URL = get_category_link( $RecentPost_CategoryId );
				$RecentPost_CategoryNames[] =
				'<li class="cat-item cat-item-'.$RecentPost_CategoryId.'">'.
					$category->name.
				'</li>';
				$RecentPost_CategoryLinks[] =
				'<li class="cat-item cat-item-'.$RecentPost_CategoryId.'">'.
					'<a href="'.$category->URL.'">'.
						$category->name.
					'</a>'.
				'</li>';
			}

			$Curlycodes = array(
				array( '{{ ID }}', $RecentPost->ID ),
				array( '{{ PARENT_ID }}', $RecentPost->post_parent ),
				array( '{{ AUTHOR_ID }}', $RecentPost->post_author ),
				array( '{{ AUTHOR_SLUG }}', 'get_the_author_meta(\'user_nicename\')' ),
				array( '{{ AUTHOR_NAME }}', 'get_the_author()' ),
				array( '{{ CATEGORY_NAMES }}', '<ul>'.implode( '', $RecentPost_CategoryNames ).'</ul>' ),
				array( '{{ CATEGORY_LINKS }}', '<ul>'.implode( '', $RecentPost_CategoryLinks ).'</ul>' ),
				array( '{{ FEATURED_IMAGE }}', 'get_the_post_thumbnail()' ),
				array( '{{ CONTENT }}', $RecentPost->post_content ),
				array( '{{ CONTENT_TRIMMED }}', wp_trim_words( $RecentPost->post_content, 50, null ) ),
				array( '{{ TITLE }}', $RecentPost->post_title ),
				array( '{{ TITLE_SLUG }}', $RecentPost->post_name ),
				array( '{{ EXCERPT }}', $RecentPost->post_excerpt ),
				array( '{{ GUID }}', $RecentPost->guid ),
				array( '{{ PERMALINK }}', get_permalink() ),
				array( '{{ DATE_DAY }}', $RecentPost_Date[1] ),
				array( '{{ DATE_DAY_PADDED }}', $RecentPost_Date[0] ),
				array( '{{ DATE_DAY_SUFFIX }}', $RecentPost_Date[2] ),
				array( '{{ DATE_WEEKDAY }}', $RecentPost_Date[3] ),
				array( '{{ DATE_WEEKDAY_ABBR }}', $RecentPost_Date[4] ),
				array( '{{ DATE_MONTH }}', $RecentPost_Date[6] ),
				array( '{{ DATE_MONTH_PADDED }}', $RecentPost_Date[5] ),
				array( '{{ DATE_MONTH_FULL }}', $RecentPost_Date[7] ),
				array( '{{ DATE_MONTH_ABBR }}', $RecentPost_Date[8] ),
				array( '{{ DATE_YEAR }}', $RecentPost_Date[9] ),
				array( '{{ DATE_YEAR_ABBR }}', $RecentPost_Date[10] ),
				array( '{{ TIME_24H }}', $RecentPost_Date[15] ),
				array( '{{ TIME_24H_PADDED }}', $RecentPost_Date[16] ),
				array( '{{ TIME_12H }}', $RecentPost_Date[13] ),
				array( '{{ TIME_12H_PADDED }}', $RecentPost_Date[14] ),
				array( '{{ TIME_12H_SUFFIX }}', $RecentPost_Date[11] ),
				array( '{{ TIME_MINUTES }}', $RecentPost_Date[17] ),
				array( '{{ TIME_SECONDS }}', $RecentPost_Date[18] ),
				array( '{{ TIME_ZONE }}', $RecentPost_Date[19] ),
				array( '{{ TIME_ISO8601 }}', $RecentPost_Date[20] ),
				array( '{{ TIME_RFC2822 }}', $RecentPost_Date[21] )
			);

			$replaced_content = $content;
			foreach( $Curlycodes as $key => $val ) {
				$replaced_content = str_replace( $val[0], $val[1], $replaced_content );
			}

			$shortcode_output .= $replaced_content;

		}

		wp_reset_postdata();
		wp_reset_query();

		return
		'<div class="theme-recentposts'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<div class="theme-recentposts-interior">'.
				( empty( $a['heading'] ) ? null : '<h2>'.$a['heading'].'</h2>' ).
				$shortcode_output.
			'</div>'.
		'</div>';

	}

?>