<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	#
	# EVENT HOOKS
	#
	add_action( 'admin_menu', function() {
		add_theme_page( 'GE: Post Types', 'GE: Post Types', 'manage_options', 'ge-posttypes', 'Grafik_PostTypes_Output' );
	}, 103 );

	#
	# SUBMENU CONSTRUCTOR
	#
	function Grafik_PostTypes_Output() {

		#
		# STORED OPTIONS
		#

		$options_info = json_decode( get_option( 'Grafik_PostTypes_Info', '[]' ), true );
		$options_styles = json_decode( get_option( 'Grafik_PostType_Styles', '[]' ), true );
		$options_header = json_decode( get_option( 'Grafik_PostType_Header', '[]' ), true );
		$options_content = json_decode( get_option( 'Grafik_PostType_Content', '[]' ), true );
		$options_footer = json_decode( get_option( 'Grafik_PostType_Footer', '[]' ), true );
		$options_scripts = json_decode( get_option( 'Grafik_PostType_Scripts', '[]' ), true );
		$options_structure = json_decode( get_option( 'Grafik_PostType_Structure', '[]' ), true );
		ksort( $options_info );

		#
		# QUERY MAPPING
		#
		$map_func = array(
			'create' => 'Create Type',
			'edit' => 'Edit Type'
		);
		$map_edit = array();
		foreach( $options_info as $key => $val ) {
			if( !is_array( $val ) ) continue;
			$map_edit[ $key ] = $val[ 'plural' ];
		}
		$map_data = array(
			'info' => 'Info',
			'styles' => 'Styles',
			'header' => 'Header',
			'content' => 'Content',
			'footer' => 'Footer',
			'scripts' => 'Scripts',
			'structure' => 'Structure'
		);

		#
		# URL QUERY
		#

		$mapped_func = ( isset( $_GET[ 'func' ] ) && array_key_exists( $_GET[ 'func' ], $map_func ) ? $_GET[ 'func' ] : null );
		$mapped_edit = ( isset( $_GET[ 'edit' ] ) && array_key_exists( $_GET[ 'edit' ], $map_edit ) ? $_GET[ 'edit' ] : null );
		$mapped_data = ( isset( $_GET[ 'data' ] ) && array_key_exists( $_GET[ 'data' ], $map_data ) ? $_GET[ 'data' ] : null );
		if( !isset( $_GET[ 'func' ] ) ) $mapped_func = 'create';
		if( !isset( $_GET[ 'data' ] ) ) $mapped_data = 'info';

		#
		# BUILD NAVIGATION
		#

		$nav_edit =
		'<li'.( $mapped_func != 'edit' ? ' class="active"' : '' ).'>'.
			'<a href="?page=ge-posttypes&amp;func=create">Create Type</a>'.
		'</li>';
		foreach( $map_edit as $key => $val ) {
			$count = wp_count_posts( $key );
			$nav_edit .=
			'<li'.( $mapped_edit == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page=ge-posttypes&amp;func=edit&amp;edit='.$key.'">'.
					'<span>'.Grafik_ReadDecode( $val ).'</span>'.
					'<span style="float:right;">('.$count->publish.')</span>'.
				'</a>'.
			'</li>';
		}
		$nav_edit =
		'<div class="grafik-functions-primarynav">'.
			'<ul>'.$nav_edit.'</ul>'.
		'</div>';

		#
		# BUILD SUBNAVIGATION
		#

		$nav_data = '';
		foreach( $map_data as $key => $val ) {
			$nav_data .=
			'<li'.( $mapped_data == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page=ge-posttypes&amp;func=edit&amp;edit='.$mapped_edit.'&amp;data='.$key.'">'.$val.'</a>'.
			'</li>';
		}
		$nav_data =
		'<div class="grafik-functions-secondarynav">'.
			'<ul>'.$nav_data.'</ul>'.
		'</div>';

		#
		# BUILD DISPLAY TITLE
		#

		$display_title = '';
		if( $mapped_func == 'create' ) {
			$display_title .= 'Create Type';
		} else {
			$display_title .= 'Edit Type: ';
			if( empty( $mapped_edit ) ) {
				$display_title .= 'Error!';
			} else {
				$display_title .= Grafik_ReadDecode( $options_info[ $mapped_edit ][ 'plural' ] );
			}
		}
		$display_title = '<h2>'.$display_title.'</h2>';

		#
		# BUILD DISPLAY SUBTITLE
		#

		$display_subtitle = '';
		if( empty( $mapped_data ) ) {
			$display_subtitle .= 'Error!';
		} else {
			$display_subtitle .= $map_data[ $mapped_data ];
		}
		$display_subtitle = '<h3>'.$display_subtitle.'</h3>';

		#
		# BUILD FORM
		#

		$display_form = '';
		if( empty( $mapped_func ) || $mapped_func == 'create' ) {

			$display_form .=
			'<input type="hidden" name="action" value="create">'.
			'<p><strong>Unique Slug:</strong></p>'.
			'<p><input type="text" name="create-slug" placeholder="custom-type" value="'.$mapped_edit.'"></p>'.
			'<p><strong>Single Name:</strong></p>'.
			'<p><input type="text" name="create-s-name" placeholder="Custom Type" value="'.Grafik_ReadDecode( $options_info[ $mapped_edit ][ 'singular' ] ).'"></p>'.
			'<p><strong>Plural Name:</strong></p>'.
			'<p><input type="text" name="create-p-name" placeholder="Custom Types" value="'.Grafik_ReadDecode( $options_info[ $mapped_edit ][ 'plural' ] ).'"></p>';

		} else {
			if( empty( $mapped_edit ) || empty( $mapped_data ) ) {

				$display_form .= '<p>Requested operation cannot be performed.</p>';

			} else {

				$display_form .=
				'<!-- '.print_r( $options_info[ $mapped_edit ], true ).' -->'.
				'<input type="hidden" name="id" value="'.$mapped_edit.'" />'.
				'<input type="hidden" name="action" value="edit-'.$mapped_edit.'" />';

				if( empty( $mapped_data ) || $mapped_data == 'info' ) {

					$display_form .=
					'<p><strong>Unique Slug:</strong></p>'.
					'<p><input type="text" value="'.$mapped_edit.'" disabled="disabled"></p>'.
					'<p><strong>Single Name:</strong></p>'.
					'<p><input type="text" name="edit-s-name" placeholder="Custom Type" value="'.Grafik_ReadDecode( $options_info[ $mapped_edit ][ 'singular' ] ).'"></p>'.
					'<p><strong>Plural Name:</strong></p>'.
					'<p><input type="text" name="edit-p-name" placeholder="Custom Types" value="'.Grafik_ReadDecode( $options_info[ $mapped_edit ][ 'plural' ] ).'"></p>';

				} else if ( $mapped_data == 'styles' ) {

					$display_form .=
					'<p><strong>HTML:</strong></p>'.
					'<p><textarea name="edit-html"></textarea></p>'.
					'<p><select name="edit-html-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>';

				} else if ( $mapped_data == 'header' ) {

					$display_form .=
					'<table>'.
						'<tbody>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Top Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Header_TL"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Header_BehaviorTL"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Top Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Header_TR"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Header_BehaviorTR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Middle Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Header_ML"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Header_BehaviorML"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Middle Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Header_MR"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Header_BehaviorMR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Bottom Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Header_BL"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Header_BehaviorBL"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Bottom Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Header_BR"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Header_BehaviorBR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
						'</tbody>'.
					'</table>';

				} else if ( $mapped_data == 'content' ) {

					$display_form .=
					'<table>'.
						'<tbody>'.
							'<tr>'.
								'<td colspan="3">'.
									'<p><strong>Top:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Content_T"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Content_BehaviorT"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td style="width:25%">'.
									'<p><strong>Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Content_L"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Content_BehaviorL"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td style="width:50%">'.
									'<p><strong>Center:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Content_C"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Content_BehaviorC"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td style="width:25%">'.
									'<p><strong>Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Content_R"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Content_BehaviorR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td colspan="3">'.
									'<p><strong>Bottom:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Content_B"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Content_BehaviorB"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
						'</tbody>'.
					'</table>';

				} else if ( $mapped_data == 'footer' ) {

					$display_form .=
					'<table>'.
						'<tbody>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Top Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Footer_TL"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Footer_BehaviorTL"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Top Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Footer_TR"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Footer_BehaviorTR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Middle Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Footer_ML"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Footer_BehaviorML"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Middle Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Footer_MR"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Footer_BehaviorMR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Bottom Left:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Footer_BL"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Footer_BehaviorBL"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Bottom Right:</strong></p>'.
									'<p><textarea name="Grafik_Functions_Global_Footer_BR"></textarea></p>'.
									'<p><select name="Grafik_Functions_Global_Footer_BehaviorBR"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
						'</tbody>'.
					'</table>';

				} else if ( $mapped_data == 'scripts') {

					$display_form .=
					'<p><textarea name="Grafik_Functions_Global_Scripts_HTML"></textarea></p>'.
					'<p><select name="Grafik_Functions_Global_Scripts_BehaviorHTML"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>';

				} else if ( $mapped_data == 'structure' ) {

					$display_form .=
					'<table>'.
						'<tbody>'.
							'<tr><td><p><strong>HTML:</strong></p><p><textarea name="Grafik_Functions_Blog_Structure_HTML"></textarea></p></td></tr>'.
							'<tr><td>'.Grafik_CurlyHints().'</td></tr>'.
						'</tbody>'.
					'</table>';

				} else {

					$display_form .= '<p>Requested operation cannot be performed.</p>';

				}

			}
		}

		#
		# RETURN INTERFACE
		#
		echo
		'<div class="grafik-functions">'.
			'<h1><span>Post Types</span></h1>'.
			'<div class="grafik-functions-display">'.
				$nav_edit.
				'<div class="grafik-functions-primarydisplay">'.
					$display_title.
					( $mapped_func == 'create' ? '' : $nav_data ).
					'<div class="grafik-functions-secondarydisplay">'.
						$display_subtitle.
						'<form method="POST">'.
							$display_form.
							'<div>'.
								'<hr/>'.
								'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
								( $mapped_func == 'create' ? '' :
									'<span class="last-update">'.
										'Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).
									'</span>'
								).
							'</div>'.
							wp_nonce_field( 'Grafik_PostTypes_Nonce', 'Grafik_PostTypes_Nonce', true, false ).
						'</form>'.
					'</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
		'<script type="text/javascript">'.
			'(function($){'.
				'var ReflowInterval = window.setInterval(function(){'.
					'$(".grafik-functions-secondarydisplay").css({'.
						'"min-height":$(".grafik-functions-primarynav").outerHeight()'.
					'});'.
				'},50);'.
			'})(jQuery);'.
		'</script>'.
		Grafik_ProfileColors();

		/*
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

			if( isset( $_POST[ 'Grafik_PostTypes_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_PostTypes_Nonce' ], 'Grafik_PostTypes_Nonce' ) ) {

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

				update_option( 'Grafik_PostTypes', json_encode( $option_modified ) );
			}

			

		}
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
					wp_nonce_field( 'Grafik_PostTypes_Nonce', 'Grafik_PostTypes_Nonce', true, false ).
				'</form>'.
			'</div>'.
		'</div>'.
		*/

	}

?>