<?php

	function Grafik_Shortcode_PaginatedPosts_Callback( $atts ) {

		// Content Buffer...
		$content = '';

		// Query Params...
		$a = shortcode_atts(
			array(
				'category' => '',
				'format' => '',
				'perpage' => 10,
				'class' => '',
				'id' => ''
			)
			, $atts
			, "PaginatedPosts"
		);

		// Convert Category Slugs to IDs...
		$category_list = explode(",", $a['category']);
		foreach($category_list as $key => $val) {
			if(is_numeric($val)) continue;
			$is_negative = substr($val, 0, 1) == "-";
			$trim_val = trim($val, "-");
			$category = get_category_by_slug($trim_val);
			$category_list[$key] = ($is_negative ? "-" : null) . $category->term_id;
		}
		$a['category'] = implode(",", $category_list);

		// Paging...
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$PaginatedPosts_Args = array(
			'posts_per_page' => $a['perpage'],
			'cat' => $a['category'],
			'paged' => $paged
		);

		// Filters...
		$grafik_filters = get_option("grafik-filters");
		if(!is_array($grafik_filters)) $grafik_filters = json_decode($grafik_filters, true);

		// Display Posts Matching Query...
		wp_reset_postdata();
		$PaginatedPosts_Query = new WP_Query( $PaginatedPosts_Args );
		if( $PaginatedPosts_Query->have_posts() ) {
			while( $PaginatedPosts_Query->have_posts() ) {

				$PaginatedPosts_Query->the_post();

				$info_categories = array();
				$GRAFIK_CATEGORIES = wp_get_post_categories( get_the_ID() );
				foreach($GRAFIK_CATEGORIES as $key => $val) {

					$cat = get_category($val);

					// Filter Uncategorized from display...
					if(is_array($grafik_filters['category-masking']) && in_array($cat->term_id, $grafik_filters['category-masking'])) {
						continue;
					}

					$info_categories[] = '<span class="theme-paginatedposts-category '.$cat->slug.'">'.$cat->name.'</span>';

				}

				if( empty( $a['format'] ) ) {

					$content .=
					'<div class="theme-paginatedposts-post">'.
						'<div class="theme-paginatedposts-info">Posted: '.get_the_date( 'F dS, Y' ).'</div>'.
						'<div class="theme-paginatedposts-title">'.'<a href="'.get_permalink().'">'.get_the_title().'</a>'.'</div>'.
						'<div class="theme-paginatedposts-categories">'.implode('', $info_categories).'</div>'.
						'<div class="theme-paginatedposts-short">'.get_the_excerpt().'</div>'.
					'</div>';

				} else {

					$format_date = explode( '|', get_the_date("d|j|S|l|D|m|n|F|M|Y|y|a|A|g|h|G|H|i|s|T|c|r") );
					$format_data = array(

						# Preview Images
						"preview-mobile"		=> '<img src="'.Grafik_ReadDecode( get_post_meta( get_the_ID(), 'grafik-meta-preview-desktop', true) ).'" alt="'.get_the_title().'" />',
						"preview-tablet"		=> '<img src="'.Grafik_ReadDecode( get_post_meta( get_the_ID(), 'grafik-meta-preview-tablet', true) ).'" alt="'.get_the_title().'" />',
						"preview-desktop"		=> '<img src="'.Grafik_ReadDecode( get_post_meta( get_the_ID(), 'grafik-meta-preview-phone', true) ).'" alt="'.get_the_title().'" />',

						# Content
						"title"					=> get_the_title(),
						"excerpt"				=> preg_replace( '/[^A-Za-z0-9]+$/', '...', get_the_excerpt() ),
						"author"				=> get_the_author(),

						# Day of Month
						"day-intpadded"			=> $format_date[0],
						"day-int"				=> $format_date[1],
						"day-suffix"			=> $format_date[2],

						# Weekday
						"weekday-long"			=> $format_date[3],
						"weekday-short"			=> $format_date[4],

						# Month
						"month-intpadded"		=> $format_date[5],
						"month-int"				=> $format_date[6],
						"month-long"			=> $format_date[7],
						"month-short"			=> $format_date[8],

						# Year
						"year-long"				=> $format_date[9],
						"year-short"			=> $format_date[10],

						# Time
						"time-lower"			=> $format_date[11],
						"time-upper"			=> $format_date[12],
						"hour12-int"			=> $format_date[13],
						"hour12-intpadded"		=> $format_date[14],
						"hour24-int"			=> $format_date[15],
						"hour24-intpadded"		=> $format_date[16],
						"minutes"				=> $format_date[17],
						"seconds"				=> $format_date[18],
						"timezone"				=> $format_date[19],
						"timestamp-iso8601"		=> $format_date[20],
						"timestamp-rfc2822"		=> $format_date[21]

					);

					$format_content = '';
					$format_groups = explode( '|', $a['format'] );
					foreach($format_groups as $format_group) {
						$group_content = '';
						$group_objects = explode( ',', $format_group );
						foreach($group_objects as $group_object) {
							$group_content .=
							'<span class="'.$group_object.'">'.
								$format_data[$group_object].
							'</span>';
						}
						$format_content .=
						'<div class="format-group">'.
							$group_content.
						'</div>';
					}
					$content .=
					'<div class="theme-paginatedposts-post">'.
						'<a href="'.get_permalink().'">'.
							$format_content.
						'</a>'.
					'</div>';
				}

			}
			$big = 999999999;
			$PaginatedPost_Args = array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var( 'paged' ) ),
				'total' => $PaginatedPosts_Query->max_num_pages
			);
			$content .=
			'<div class="theme-paginatedposts-pagelinks">'.
				paginate_links( $PaginatedPost_Args ).
			'</div>'.
			wp_reset_postdata();
		}

		return
		'<div class="theme-paginatedposts'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			$content.
		'</div>';

	}
	add_shortcode( "PaginatedPosts", "Grafik_Shortcode_PaginatedPosts_Callback" );

?>