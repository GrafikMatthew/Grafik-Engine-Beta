<?php

	#
	# SECURED THEME
	#
	if( !defined( 'ABSPATH' ) ) exit;

	#
	# ADD SHORTCODE
	#
	add_shortcode( 'TypeLatest', 'Grafik_Functions_Shortcode_TypeLatest' );
	function Grafik_Functions_Shortcode_TypeLatest( $atts, $content = '' ) {

		global $wp_query;
		global $GRAFIK_MODE;
		$callback_output = '';

		$a = shortcode_atts( array(
			'type' => 'post',
			'limit' => 5,
			'force_context' => false,
			'author' => '',
			'category' => '',
			'not_category' => '',
			'cat' => '',
			'content' => '',
			'class' => '',
			'id' => ''
		), $atts, 'TypeLatest' );

		// Determine the author...
		$callback_author = null;
		if( $GRAFIK_MODE[ 'is_author' ] == 1 && $a[ 'force_context' ] ) {
			// FORCED AUTHOR CONTEXT
			$a[ 'author' ] = $wp_query->query_vars[ 'author' ];
		}
		if( !empty( $a[ 'author' ] ) ) {
			if( is_numeric( $a[ 'author' ] ) ) {
				// ID
				$callback_author = get_user_by( 'id', $a[ 'author' ] );
			} else {
				if( is_email( $a[ 'author'] ) ) {
					// EMAIL
					$callback_author = get_user_by( 'email', $a[ 'author' ] );
				} else {
					if( validate_username( $a[ 'author' ] ) ) {
						// LOGIN
						$callback_author = get_user_by( 'login', $a[ 'author'] );
					} else {
						// SLUG
						$callback_author = get_user_by( 'slug', $a[ 'author' ] );
					}
				}
			}
		}

		// Determine the category...
		$callback_category = null;
		if( $GRAFIK_MODE[ 'is_category' ] == 1 && $a[ 'force_context' ] ) {
			// FORCED CATEGORY CONTEXT
			$a[ 'category' ] = $wp_query->query_vars[ 'cat' ];
		}
		if( !empty( $a[ 'category' ] ) ) {
			if( is_numeric( $a[ 'category' ] ) ) {
				// ID
				$callback_category = get_term_by( 'id', $a[ 'category' ], 'category' );
			} else {
				// Name
				if( term_exists( $a[ 'category' ], 'category' ) ) {
					$callback_category = get_term_by( 'name', $a[ 'category' ], 'category' );
				} else {
					$callback_category = get_term_by( 'slug', $a[ 'category' ], 'category' );
				}
			}
		}

		// Construct the query...
		$callback_query_array = array(
			'post_type' => explode( ',', $a[ 'type' ] ),
			'posts_per_page' => $a[ 'limit' ],
			'category__not_in' => explode( ',', $a[ 'not_category' ] ),
			'cat' => ( empty( $a[ 'cat' ] ) ? $callback_category->cat_ID : $a[ 'cat' ] )
		);
		$callback_query = new WP_Query( $callback_query_array );

		// Loop the query...
		if( $callback_query->have_posts() ) {
			while( $callback_query->have_posts() ) {
				$callback_query->the_post();
				$callback_output .= '<li class="ge-typelatest-item">'.Grafik_CurlyCodes( get_the_ID(), $content ).'</li>';
			}
			wp_reset_postdata();
		} else {
			$callback_output .= '<span class="ge-typelatest-empty">'.$a[ 'empty_msg' ].'</span>';
		}

		return
		'<div class="ge-typelatest-container'.(empty($a['class']) ? null : ' '.$a['class']).'"'.(empty($a['id']) ? null : ' id="'.$a['id'].'"').'>'.
			'<div class="ge-typelatest-content">'.$a[ 'content' ].'</div>'.
			'<ul class="ge-typelatest-list">'.$callback_output.'</ul>'.
		'</div>';

	}

?>