<?php

	add_shortcode( "BlogAuthors", "Grafik_Functions_Shortcode_BlogAuthors" );
	function Grafik_Functions_Shortcode_BlogAuthors( $atts ) {

		$a = shortcode_atts( array(
			'orderby' => 'name', // Values: name, email, url, registered, id, user_login, post_count
			'order' => 'ASC', // Values: ASC, DESC
			'number' => 0, // Value: (int)
			'optioncount' => 0, // Values: 0 (false), 1 (true)
			'exclude_admin' => 1, // Values: 0 (false), 1 (true)
			'show_fullname' => 0, // Values: 0 (false), 1 (true)
			'hide_empty' => 1, // Values: 0 (false), 1 (true)
			'heading' => 'Blog Authors', // Value: (string)
			'class' => '',
			'id' => ''
		), $atts, "BlogAuthors" );
		$a['echo'] = 0;

		$content = '<ul>'.wp_list_authors( $a ).'</ul>';

		return
		'<div class="theme-blogauthors'.( empty( $a['class'] ) ? null : ' '.$a['class'] ).'"'.( empty( $a['id'] ) ? null : ' id="'.$a['id'].'"' ).'>'.
			'<div class="theme-blogauthors-interior">'.
				( empty( $a['heading'] ) ? null : '<h2>'.$a['heading'].'</h2>' ).
				( empty( $content ) ? null : $content ).
			'</div>'.
		'</div>';

	}

?>