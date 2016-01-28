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

	/*
	add_filter( 'pre_get_posts', 'Grafik_MetaboxQuery');
	function Grafik_MetaboxQuery( $query ) {
		if( $query->is_search ) {
			$meta_query_args = array(
				array( 'key' => 'your_key', 'value' => $query->query_vars['s'] = '', 'compare' => 'LIKE' ),
			);
			$query->set( 'meta_query', $meta_query_args );
		};
	}
	*/

?>