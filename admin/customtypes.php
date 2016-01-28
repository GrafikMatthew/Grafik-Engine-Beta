<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	#
	# EVENT HOOKS
	#
	add_action( 'admin_menu', function() {
		add_theme_page( 'GE: Custom Types', 'GE: Custom Types', 'manage_options', 'grafik-engine-customtypes', 'Grafik_CustomTypes_Output' );
	}, 103 );

	#
	# SUBMENU CONSTRUCTOR
	#
	function Grafik_CustomTypes_Output() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_CustomTypes', '[]'), true );

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_GET[ 'edit' ] ) ) {

			// http://codex.wordpress.org/Function_Reference/add_post_type_support

			if( isset( $option_modified[ $_GET[ 'edit' ] ] ) ) {

			} else {

			}

		} else {

			// Overview Editor...

			if( isset( $_POST[ 'Grafik_CustomTypes_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_CustomTypes_Nonce' ], 'Grafik_CustomTypes_Nonce' ) ) {

				if( !empty( $_POST[ 'new-customtypes-name' ] ) && !empty( $_POST[ 'new-customtypes-plural' ] ) && !empty( $_POST[ 'new-customtypes-singular' ] ) ) {
					$option_modified[ $_POST[ 'new-customtypes-name' ] ][ 'plural' ] = Grafik_WriteEncode( $_POST[ 'new-customtypes-plural' ] );
					$option_modified[ $_POST[ 'new-customtypes-name' ] ][ 'singular' ] = Grafik_WriteEncode( $_POST[ 'new-customtypes-singular' ] );
					$option_modified[ $_POST[ 'new-customtypes-name' ] ][ 'public' ] = (int)$_POST[ 'new-customtypes-haspublic' ] == 'on' ? 1 : 0;
					$option_modified[ $_POST[ 'new-customtypes-name' ] ][ 'archive' ] = (int)$_POST[ 'new-customtypes-hasarchive' ] == 'on' ? 1 : 0;
					$option_modified['save-time'] = time();
					$option_modified['save-user'] = get_current_user_id();
				}

				foreach( $_POST as $key => $val ) {
					if( strpos( $key, 'delete-' ) == 0 ) {
						$deletion_key = substr( $key, 7 );
						unset( $option_modified[ $deletion_key ] );
					}
				}

				update_option( 'Grafik_CustomTypes', json_encode( $option_modified ) );
			}

			$callback_output = '';
			$option_customtypes = get_post_types( array('_builtin' => false), 'objects' );
			foreach( $option_customtypes as $key => $val ) {
				if( !isset( $option_modified[ $key ] ) ) continue;
				$callback_output .=
				'<tr>'.
					'<td><input type="checkbox" name="delete-'.$key.'" >'.
					'<td>'.$key.'</td>'.
					'<td>'.$val->labels->name.'</td>'.
					'<td>'.$val->labels->singular_name.'</td>'.
					'<td>'.( (int)$val->public == 1 ? 'Yes' : 'No' ).'</td>'.
					'<td>'.( (int)$val->has_archive == 1 ? 'Yes' : 'No' ).'</td>'.
					'<td><a href="#">Settings</a></td>'.
				'</tr>';
			}

			$callback_output =
			'<tr><th>DELETE</th><th>NAME</th><th>PLURAL FORM</th><th>SINGULAR FORM</th><th>PUBLIC</th><th>ARCHIVES</th><th>EDIT</th></tr>'.
			'<tr><td colspan="7"><hr/></td></tr>'.
			$callback_output.
			'<tr><td colspan="7"><hr/></td></tr>'.
			'<tr>'.
				'<td>&nbsp;</td>'.
				'<td><input type="text" name="new-customtypes-name" placeholder="New Name" /></td>'.
				'<td><input type="text" name="new-customtypes-plural" placeholder="New Plural Form" /></td>'.
				'<td><input type="text" name="new-customtypes-singular" placeholder="New Singular Form" /></td>'.
				'<td><label><input type="checkbox" name="new-customtypes-haspublic" />Public?</label></td>'.
				'<td><label><input type="checkbox" name="new-customtypes-hasarchive" />Archives?</label></td>'.
				'<td>&nbsp;</td>'.
			'</tr>';

		}

		#
		# RETURN INTERFACE
		#
		echo
		'<div class="grafik-functions">'.
			'<h1><span>Custom Types</span></h1>'.
			'<div class="grafik-functions-display">'.
				'<form method="POST">'.
					'<table class="grafik-customtypes">'.
						$callback_output.
						'<tr><td colspan="7"><hr/></td></tr>'.
						'<tr><td colspan="7"><pre>'.print_r( $option_modified, true ).'</pre></td></tr>'.
						'<tr><td colspan="7"><hr/></td></tr>'.
						'<tr>'.
							'<td colspan="7">'.
								'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
								'<span class="last-update">'.
									'Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).
								'</span>'.
							'</td>'.
						'</tr>'.
					'</table>'.
					wp_nonce_field( 'Grafik_CustomTypes_Nonce', 'Grafik_CustomTypes_Nonce', true, false ).
				'</form>'.
			'</div>'.
		'</div>'.
		Grafik_ProfileColors();

	}

?>