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

		$output = '';

		#
		# STORED OPTIONS
		#

		$options_info = json_decode( get_option( 'Grafik_PostType_Info', '[]' ), true );
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

		#
		# BUILD NAVIGATION
		#

		$nav_edit =
		'<li'.( $mapped_func != 'edit' ? ' class="active"' : '' ).'>'.
			'<a href="?page=ge-posttypes&amp;func=create">Create Type</a>'.
		'</li>';
		foreach( $map_edit as $key => $val ) {
			$count = wp_count_posts( $key );
			$output_temp .=
			'<li'.( $mapped_edit == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page=ge-posttypes&amp;func=edit&amp;edit='.$key.'">'.
					'<span>'.Grafik_ReadDecode( $val[ 'plural' ] ).'</span>'.
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
			$output_temp .=
			'<li'.( $mapped_data == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page=ge-posttypes&amp;func=edit&amp;edit={{ KEY }}">'.$val.'</a>'.
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
				$display_title .= $options_info[ $mapped_edit ][ 'plural' ];
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
		# BUILD DISPLAY BODY
		#

		$display_body = '';
		switch( $mapped_func ) {

			case 'edit':
				if( empty( $mapped_data ) ) {
					$display .=
					'<h3>'
				} else {
					$diplay 
				}



					$callback_output_temp .=
					'<h2>'.Grafik_ReadDecode( $options_index[ $callback_edit ][ 'plural' ] ).'</h2>'.
					'<div class="grafik-functions-secondarynav">'.
						'<ul>'.
							'<li'.( $callback_data != 'template' && $callback_data != 'structure' ? ' class="active"' : '' ).'>'.
								'<a href="?page=ge-posttypes&amp;func=edit&amp;edit='.$callback_edit.'">Info</a>'.
							'</li>'.
							'<li'.( $callback_data == 'template' ? ' class="active"' : '' ).'>'.
								'<a href="?page=ge-posttypes&amp;func=edit&amp;edit='.$callback_edit.'&amp;data=template">Template</a>'.
							'</li>'.
							'<li'.( $callback_data == 'structure' ? ' class="active"' : '' ).'>'.
								'<a href="?page=ge-posttypes&amp;func=edit&amp;edit='.$callback_edit.'&amp;data=structure">Structure</a>'.
							'</li>'.
						'</ul>'.
					'</div>'.
					'<div class="grafik-functions-secondarydisplay">'.
					'</div>';

				} else {

					$callback_output_temp .=
					'<h2>Edit</h2>'.
					'<div class="grafik-functions-secondarynav">'.
						'<ul>'.
							'<li><a href="#">Info</a></li>'.
							'<li><a href="#">Template</a></li>'.
							'<li><a href="#">Structure</a></li>'.
						'</ul>'.
					'</div>'.
					'<div class="grafik-functions-secondarydisplay">'.
						'<p><strong>Error:</strong> Post Type Not Found</p>'.
					'</div>';

				}

				
				break;
			default:
				$callback_output_temp .=
				'<h2>Create Type</h2>'.
				'<div class="grafik-functions-secondarynav">'.
					'<ul>'.
						'<li class="active"><a href="#">Info</a></li>'.
						'<li><a href="#">Template</a></li>'.
						'<li><a href="#">Structure</a></li>'.
					'</ul>'.
				'</div>'.
				'<div class="grafik-functions-secondarydisplay">'.
				'</div>';
				break;
		}
		$callback_output .=
		'<div class="grafik-functions-primarydisplay">'.
			$callback_output_temp.
		'</div>';

		/*
		$callback_output = '';
		if( empty( $_GET[ 'option' ] ) ) $_GET[ 'option' ] = null;
		switch( $_GET[ 'option' ] ) {

			case 'create':

				// CREATOR VIEW
				$callback_title = 'Post Types: Create';
				break;

			case 'edit':

				// EDITOR VIEW
				$callback_title = 'Post Types: Edit';
				break;

			default:

				// GENERAL VIEW
				$callback_title = 'Post Types';

				

					if( !is_array( $val ) ) continue;
					$callback_typecount = wp_count_posts( $key );
					$callback_output .=
					'<tr>'.
						'<td>'.$key.'</td>'.
						'<td>'.Grafik_ReadDecode ( $val[ 'plural' ] ).'</td>'.
						'<td>'.Grafik_ReadDecode ( $val[ 'singular' ] ).'</td>'.
						'<td>'.$callback_typecount->publish.'</td>'.
						'<td><a href="?page=ge-posttypes&amp;option=edit&amp;id='.$key.'">Edit</td>'.
					'</tr>';
				}
				$callback_output =
				'<table class="grafik-posttypes-general">'.
					'<tr>'.
						'<th>ID</th>'.
						'<th>Plural Form</th>'.
						'<th>Single Form</th>'.
						'<th>Published Posts</th>'.
						'<th>Options</th>'.
					'</tr>'.
					'<tr><td colspan="5"><hr/></td></tr>'.
					$callback_output.
					'<tr><td colspan="5"><hr/></td></tr>'.
					'<tr><td colspan="5"><a href="?page=ge-posttypes&amp;option=create">Create Type</a></td></tr>'.
				'</table>';
				break;

		}
		*/

		#
		# RETURN INTERFACE
		#
		echo
		'<div class="grafik-functions">'.
			'<h1><span>Post Types</span></h1>'.
			'<div class="grafik-functions-display">'.
				$callback_output.
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