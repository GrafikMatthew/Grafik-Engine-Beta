<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( "BlogArchives", "Grafik_Functions_Shortcode_BlogArchives" );
	function Grafik_Functions_Shortcode_BlogArchives( $atts, $content = null ) {

		$a = shortcode_atts( array(
			'type' => 'select',
			'before' => '',
			'after' => '',
			'heading' => 'Blog Archives',
			'class' => '',
			'id' => ''
		), $atts, "BlogArchives" );

		$args = array(
			'type' => 'monthly',
			'limit' => '',
			'format' => 'custom',
			'before' => '<i>',
			'after' => '</i>',
			'show_post_count' => true,
			'echo' => 0
		);

		$callback_tokens = array( '{{ MATCH }}', '{{ URL }}', '{{ MONTH }}', '{{ YEAR }}', '{{ COUNT }}' );

		$archives_regex = array();
		$callback_pattern = "/<i><a href='([^']+)'>([^<]+)[\\s]+([^<]+)<\\/a>[^(]+\\(([^<]+)\\)<\\/i>/";
		$callback_string = wp_get_archives( $args );
		preg_match_all($callback_pattern, $callback_string, $archives_regex);

		$callback_values = array();
		foreach($archives_regex as $key => $val) {
			foreach($val as $subkey => $subval) {
				$callback_values[$subkey][$key] = $subval;
			}
		}

		$callback_output = '';
		foreach($callback_values as $key => $val) {
			$callback_output .= str_replace( $callback_tokens, $val, $content );
		}

		return
		'<div class="theme-blogarchives'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<div class="theme-blogarchives-interior">'.
				( empty( $a['heading'] ) ? null : '<h2>'.$a['heading'].'</h2>' ).
				$a['before'].$callback_output.$a['after'].
			'</div>'.
		'</div>';

	}

?>