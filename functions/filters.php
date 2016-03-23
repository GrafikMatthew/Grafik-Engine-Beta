<?php

	#
	# SECURE THEME
	#

	if( !defined('ABSPATH') ) exit;

	#
	# EVENT HOOKS
	#

	add_action( 'admin_menu', function() {
		add_theme_page( 'GE: Category Filters', 'GE: Category Filters', 'manage_options', 'grafik-engine-categoryfilters', 'Grafik_CategoryFilters_Output' );
	}, 103 );

	#
	# SUBMENU CONSTRUCTOR
	#

	function Grafik_CategoryFilters_Output() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_CategoryFilters', '[]'), true );
		$categories = get_categories( array( 'hide_empty' => 0 ) ); 

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_CategoryFilters_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_CategoryFilters_Nonce' ], 'Grafik_CategoryFilters_Nonce' ) ) {
			foreach( $_POST as $key => $val ) {
				if( strpos( $key, 'category-id-' ) === 0 ) {
					$key_parts = explode( '-', $key );
					$key_id = (int)end( $key_parts );
					$option_modified['behavior-'.$key_id] = (int)$val;
				}
			}
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_CategoryFilters', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# BUILD CONTROLS
		#
		$callback_output = '';
		foreach( $categories as $i => $category ) {
			$callback_output .=
			'<tr>'.
				'<td>'.
					'<strong>'.$category->name.'</strong>['.$category->cat_ID.'] '.$category->slug.
					'<em>Description: '.( empty( $category->description ) ? 'Blank' : $category->description ).'</em>'.
				'</td>'.
				'<td>'.
					'<select name="category-id-'.$category->cat_ID.'" style="font-size:inherit;">'.
						'<option value="0"'.( $option_modified['behavior-'.$category->cat_ID] == 0 ? ' selected="selected"' : '' ).'>Do Not Hide</option>'.
						'<option value="1"'.( $option_modified['behavior-'.$category->cat_ID] == 1 ? ' selected="selected"' : '' ).'>Hide From Lists</option>'.
						'<option value="2"'.( $option_modified['behavior-'.$category->cat_ID] == 2 ? ' selected="selected"' : '' ).'>Hide From Blog</option>'.
						'<option value="3"'.( $option_modified['behavior-'.$category->cat_ID] == 3 ? ' selected="selected"' : '' ).'>Hide From Lists &amp; Blog</option>'.
					'</select>'.
				'</td>'.
			'</tr>';
		}

		#
		# RETURN INTERFACE
		#
		echo
		'<div class="grafik-functions">'.
			'<h1><span>Category Filters</span></h1>'.
			'<div class="grafik-functions-display">'.
				'<form method="POST">'.
					'<table class="grafik-categoryfilters">'.
						$callback_output.
					'</table>'.
					'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
					'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
					wp_nonce_field( 'Grafik_CategoryFilters_Nonce', 'Grafik_CategoryFilters_Nonce', true, false ).
				'</form>'.
			'</div>'.
		'</div>'.
		Grafik_ProfileColors();

	}

	#
	# EVENT HOOKS
	#

	add_action( 'pre_get_posts', 'Grafik_CategoryFilters_Apply' );

	#
	# QUERY CONSTRUCTOR
	#

	function Grafik_CategoryFilters_Apply( $query ) {

		$ignore_filters = isset( $query->query[ 'ignore_filters' ] ) ? (int)$query->query[ 'ignore_filters' ] : 0;
		if( is_admin() || !$query->is_main_query() || $ignore_filters == 1 ) return;

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_CategoryFilters', '[]'), true );

		$omit = array();
		foreach( $option_stored as $key => $val ) {
			if( strpos( $key, 'behavior-' ) !== 0 ) continue;
			$key_parts = explode( '-', $key );
			$key_id = (int)end( $key_parts );
			$key_val = (int)$val;
			if( $key_val == 2 || $key_val == 3 ) {
				$omit[] = '-'.$key_id;
			}
		}
		$query->set( 'cat', implode( ',', $omit ) );

	}

?>