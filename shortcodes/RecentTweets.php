<?php

	function Grafik_Shortcode_RecentTweets_Callback( $atts, $content = null ) {

		$a = shortcode_atts( array(
			'ckey' => '',
			'csecret' => '',
			'atoken' => '',
			'asecret' => '',
			'uname' => '',
			'count' => '',
			'class' => '',
			'id' => ''
		), $atts );

		return
		'<div class="theme-recenttweets'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			$content.
		'</div>';

	}
	add_shortcode( "RecentTweets", "Grafik_Shortcode_RecentTweets_Callback" );

?>