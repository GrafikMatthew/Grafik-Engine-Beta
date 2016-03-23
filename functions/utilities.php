<?php

	#
	# SECURE THEME
	#

	if( !defined('ABSPATH') ) exit;

	#
	# UTILITY FUNCTIONS
	#

	function Grafik_PrefillTextarea( $value ) {
		return esc_textarea( Grafik_ReadDecode( $value ) );
	}

	function Grafik_ReadDecode( $value ) {
		return stripslashes( base64_decode( $value ) );
	}

	function Grafik_WriteEncode( $value ) {
		return base64_encode( $value );
	}

	function Grafik_Avatar( $id_or_email ) {
		return get_avatar( $id_or_email );
	}

	function Grafik_EchoString( $func, $args = array() ) {
		ob_start();
		call_user_func_array( $func, $args );
		$string = ob_get_contents();
		ob_end_clean();
		return $string;
	}

	function Grafik_Favicon() {
		$url = get_site_url();
		return
		'<link rel="apple-touch-icon-precomposed" sizes="57x57" href="'.$url.'/favicon/apple-touch-icon-57x57.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.$url.'/favicon/apple-touch-icon-114x114.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.$url.'/favicon/apple-touch-icon-72x72.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.$url.'/favicon/apple-touch-icon-144x144.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="60x60" href="'.$url.'/favicon/apple-touch-icon-60x60.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="120x120" href="'.$url.'/favicon/apple-touch-icon-120x120.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="76x76" href="'.$url.'/favicon/apple-touch-icon-76x76.png" />'.
		'<link rel="apple-touch-icon-precomposed" sizes="152x152" href="'.$url.'/favicon/apple-touch-icon-152x152.png" />'.
		'<link rel="icon" type="image/png" href="'.$url.'/favicon/favicon-196x196.png" sizes="196x196" />'.
		'<link rel="icon" type="image/png" href="'.$url.'/favicon/favicon-96x96.png" sizes="96x96" />'.
		'<link rel="icon" type="image/png" href="'.$url.'/favicon/favicon-32x32.png" sizes="32x32" />'.
		'<link rel="icon" type="image/png" href="'.$url.'/favicon/favicon-16x16.png" sizes="16x16" />'.
		'<link rel="icon" type="image/png" href="'.$url.'/favicon/favicon-128.png" sizes="128x128" />'.
		'<meta name="application-name" content="'.get_bloginfo( 'name' ).'"/>'.
		'<meta name="msapplication-TileColor" content="#000000" />'.
		'<meta name="msapplication-TileImage" content="'.$url.'/favicon/mstile-144x144.png" />'.
		'<meta name="msapplication-square70x70logo" content="'.$url.'/favicon/mstile-70x70.png" />'.
		'<meta name="msapplication-square150x150logo" content="'.$url.'/favicon/mstile-150x150.png" />'.
		'<meta name="msapplication-wide310x150logo" content="'.$url.'/favicon/mstile-310x150.png" />'.
		'<meta name="msapplication-square310x310logo" content="'.$url.'/favicon/mstile-310x310.png" />';
	}

	function Grafik_MetaboxBehavior( $name, $selected ) {
		return
		'<select name="'.$name.'">'.
			'<option value="0"'.( $selected == 0 ? ' selected="selected"' : '' ).'>Disabled</option>'.
			'<option value="1"'.( $selected == 1 ? ' selected="selected"' : '' ).'>1st</option>'.
			'<option value="2"'.( $selected == 2 ? ' selected="selected"' : '' ).'>2nd</option>'.
			'<option value="3"'.( $selected == 3 ? ' selected="selected"' : '' ).'>3rd</option>'.
			'<option value="4"'.( $selected == 4 ? ' selected="selected"' : '' ).'>4th</option>'.
		'</select>';
	}

	function Grafik_ShortcodeLoop( $content = '' ) {
		if( empty( $content ) ) return '';
		$old_md5 = md5( $content );
		$content = do_shortcode( $content );
		$new_md5 = md5( $content );
		if( $old_md5 == $new_md5 ) return $content;
		return Grafik_ShortcodeLoop( $content );
	}

	function Grafik_ProfileColors() {
		global $_wp_admin_css_colors;
		$user_colors = $_wp_admin_css_colors[ get_user_meta( get_current_user_id(), 'admin_color', true) ]->colors;
		$user_icons = $_wp_admin_css_colors[ get_user_meta( get_current_user_id(), 'admin_color', true) ]->icon_colors;
		return
		'<style type="text/css">'.
			'.grafik-functions h1,'.
			'.grafik-functions h1::after { background-color: '.$user_colors[1].'; }'.
			'.grafik-functions-display { border-color: '.$user_colors[1].'; }'.
			'.grafik-functions-primarynav a:focus,'.
			'.grafik-functions-primarynav a:hover,'.
			'.grafik-functions-primarynav a:active,'.
			'.grafik-functions-primarynav li.active a { background-color: '.$user_colors[3].'; }'.
			'.grafik-functions-primarydisplay { border-color: '.$user_colors[3].'; }'.
		'</style>';
	}

	function Grafik_CurlyCodes( $post_id, $structure = '') {

		if( empty( $structure ) ) return '';

		$post = get_post( $post_id );

		$assets_author = get_userdata( $post->post_author );

		$options = json_decode( get_option('Grafik_CategoryFilters', '[]'), true );
		$exclusions = array();
		foreach( $options as $key => $val ) {
			if( strpos( $key, 'behavior-' ) !== 0 ) continue;
			if( $val == 1 || $val == 3 ) {
				$key_parts = explode( '-', $key );
				$key_id = (int)end( $key_parts );
				$exclusions[] = $key_id;
			}
		}
		$category_names = array();
		$category_links = array();
		$post_categories = wp_get_post_categories( $post_id );
		foreach( $post_categories as $category_id ) {
			if( $options[ 'behavior-'.$category_id ] == 1 ) continue;
			if( $options[ 'behavior-'.$category_id ] == 3 ) continue;
			$category = get_category( $category_id );
			$category->URL = get_category_link( $category_id );
			$category_names[] = '<li class="cat-item cat-item-'.$category_id.'">'.$category->name.'</li>';
			$category_links[] = '<li class="cat-item cat-item-'.$category_id.'"><a href="'.$category->URL.'">'.$category->name.'</a></li>';
		}
		$post_type = $post->post_type;
		$post_types = json_decode( get_option('Grafik_PostType_Info', '[]'), true );

		preg_match_all("/ src=\"([^\"]*)\"/", get_the_post_thumbnail(), $assets_image);

		$assets_date = explode( '|', date( "d|j|S|l|D|m|n|F|M|Y|y|a|A|g|h|G|H|i|s|T|c|r", strtotime( $post->post_date ) ) );
		$assets = array(
			array( '{{ RAW }}', print_r( $post, true ) )
			, array( '{{ ID }}', $post->ID )
			, array( '{{ PARENT_ID }}', $post->post_parent )
			, array( '{{ AUTHOR_ID }}', $post->post_author )
			, array( '{{ AUTHOR_SLUG }}', get_the_author_meta( 'user_nicename', $post->post_author ) )
			, array( '{{ AUTHOR_NAME }}', $assets_author->first_name.' '.$assets_author->last_name )
			, array( '{{ AUTHOR_FIRST }}', $assets_author->first_name )
			, array( '{{ AUTHOR_LAST }}', $assets_author->last_name )
			, array( '{{ AUTHOR_USERNAME }}', $assets_author->user_login )
			, array( '{{ CATEGORY_NAMES }}', '<ul>'.implode( '', $category_names ).'</ul>' )
			, array( '{{ CATEGORY_LINKS }}', '<ul>'.implode( '', $category_links ).'</ul>' )
			, array( '{{ FEATURED_IMAGE }}', get_the_post_thumbnail() )
			, array( '{{ FEATURED_IMAGE_URL }}', empty( $assets_image ) ? '' : $assets_image[ 1 ][ 0 ] )
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
			, array( '{{ TYPE_SLUG }}', $post_type )
			, array( '{{ TYPE_SINGLE }}', Grafik_ReadDecode( $post_types[ $post_type ][ 'single' ] ) )
			, array( '{{ TYPE_PLURAL }}', Grafik_ReadDecode( $post_types[ $post_type ][ 'plural' ] ) )
		);
		foreach( $assets as $asset ) {
			$structure = str_replace( $asset[ 0 ], $asset[ 1 ], $structure );
		}
		return $structure;
	}

	function Grafik_CurlyHints() {
		return
		'<div class="cheat-sheet" style="cursor: pointer;">'.
			'<p><strong>Cheat Sheet</strong></p>'.
			'<table class="showable" style="display: none;">'.
				'<tbody>'.
					'<tr><td colspan="3"><hr></td></tr>'.
					'<tr>'.
						'<td style="width:33.33333%">'.
							'<table>'.
								'<tbody>'.
									'<tr><th style="width:33.33333%">GUID:</th><td>{{ GUID }}</td></tr>'.
									'<tr><th style="width:33.33333%">Permalink:</th><td>{{ PERMALINK }}</td></tr>'.
									'<tr><th style="width:33.33333%">&nbsp;</th><td>&nbsp;</td></tr>'.
									'<tr><th style="width:33.33333%">Post ID:</th><td>{{ ID }}</td></tr>'.
									'<tr><th style="width:33.33333%">Parent ID:</th><td>{{ PARENT_ID }}</td></tr>'.
									'<tr><th style="width:33.33333%">Author ID:</th><td>{{ AUTHOR_ID }}</td></tr>'.
									'<tr><th style="width:33.33333%">Author Slug:</th><td>{{ AUTHOR_SLUG }}</td></tr>'.
									'<tr><th style="width:33.33333%">Author Name:</th><td>{{ AUTHOR_NAME }}</td></tr>'.
									'<tr><th style="width:33.33333%">Category Names:</th><td>{{ CATEGORY_NAMES }}</td></tr>'.
									'<tr><th style="width:33.33333%">Category Links:</th><td>{{ CATEGORY_LINKS }}</td></tr>'.
									'<tr><th style="width:33.33333%">Featured Image:</th><td>{{ FEATURED_IMAGE }}</td></tr>'.
									'<tr><th style="width:33.33333%">Content:</th><td>{{ CONTENT }}</td></tr>'.
									'<tr><th style="width:33.33333%">Title:</th><td>{{ TITLE }}</td></tr>'.
									'<tr><th style="width:33.33333%">Title Slug:</th><td>{{ TITLE_SLUG }}</td></tr>'.
									'<tr><th style="width:33.33333%">Excerpt:</th><td>{{ EXCERPT }}</td></tr>'.
								'</tbody>'.
							'</table>'.
						'</td>'.
						'<td style="width:33.33333%">'.
							'<table>'.
								'<tbody>'.
									'<tr><th style="width:33.33333%">Type Slug:</th><td>{{ TYPE_SLUG }}</td></tr>'.
									'<tr><th style="width:33.33333%">Type Name (Single):</th><td>{{ TYPE_SINGLE }}</td></tr>'.
									'<tr><th style="width:33.33333%">Type Name (Plural):</th><td>{{ TYPE_PLURAL }}</td></tr>'.
									'<tr><th style="width:33.33333%">&nbsp;</th><td>&nbsp;</td></tr>'.
									'<tr><th style="width:33.33333%">Day:</th><td>{{ DATE_DAY }}</td></tr>'.
									'<tr><th style="width:33.33333%">Day (Padded):</th><td>{{ DATE_DAY_PADDED }}</td></tr>'.
									'<tr><th style="width:33.33333%">Day Suffix:</th><td>{{ DATE_DAY_SUFFIX }}</td></tr>'.
									'<tr><th style="width:33.33333%">Weekday:</th><td>{{ DATE_WEEKDAY }}</td></tr>'.
									'<tr><th style="width:33.33333%">Weekday (Abbr):</th><td>{{ DATE_WEEKDAY_ABBR }}</td></tr>'.
									'<tr><th style="width:33.33333%">Month:</th><td>{{ DATE_MONTH }}</td></tr>'.
									'<tr><th style="width:33.33333%">Month (Padded):</th><td>{{ DATE_MONTH_PADDED }}</td></tr>'.
									'<tr><th style="width:33.33333%">Month (Full):</th><td>{{ DATE_MONTH_FULL }}</td></tr>'.
									'<tr><th style="width:33.33333%">Month (Abbr):</th><td>{{ DATE_MONTH_ABBR }}</td></tr>'.
									'<tr><th style="width:33.33333%">Year:</th><td>{{ DATE_YEAR }}</td></tr>'.
									'<tr><th style="width:33.33333%">Year (Abbr):</th><td>{{ DATE_YEAR_ABBR }}</td></tr>'.
								'</tbody>'.
							'</table>'.
						'</td>'.
						'<td style="width:33.33333%">'.
							'<table>'.
								'<tbody>'.
									'<tr><th style="width:33.33333%">24H Hour:</th><td>{{ TIME_24H }}</td></tr>'.
									'<tr><th style="width:33.33333%">24H Hour (Padded):</th><td>{{ TIME_24H_PADDED }}</td></tr>'.
									'<tr><th style="width:33.33333%">12H Hour:</th><td>{{ TIME_12H }}</td></tr>'.
									'<tr><th style="width:33.33333%">12H Hour (Padded):</th><td>{{ TIME_12H_PADDED }}</td></tr>'.
									'<tr><th style="width:33.33333%">12H Suffix:</th><td>{{ TIME_12H_SUFFIX }}</td></tr>'.
									'<tr><th style="width:33.33333%">Minutes:</th><td>{{ TIME_MINUTES }}</td></tr>'.
									'<tr><th style="width:33.33333%">Seconds:</th><td>{{ TIME_SECONDS }}</td></tr>'.
									'<tr><th style="width:33.33333%">Timezone:</th><td>{{ TIME_ZONE }}</td></tr>'.
									'<tr><th style="width:33.33333%">ISO8601:</th><td>{{ TIME_ISO8601 }}</td></tr>'.
									'<tr><th style="width:33.33333%">RFC2822:</th><td>{{ TIME_RFC2822 }}</td></tr>'.
								'</tbody>'.
							'</table>'.
						'</td>'.
					'</tr>'.
				'</tbody>'.
			'</table>'.
		'</div>';
	}

	function Grafik_ContainsKeys( $array, $keys, $strict = false ) {
		foreach( $keys as $key ) {
			if( array_key_exists( $key, $array ) ) {
				if( !$strict ) return true;
			} else {
				if( $strict ) return false;
			}
		}
		return true;
	}

?>