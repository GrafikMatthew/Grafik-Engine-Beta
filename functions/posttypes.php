<?php
	/*

	8888o. .o88o. .o8888 888888 888888 88  88 8888o. 888888 .o8888    8888o. 88  88 8888o.
	88  88 88  88 88       88     88   88  88 88  88 88     88        88  88 88  88 88  88
	8888Y' 88  88 'Y88o.   88     88   'Y8888 8888Y' 8888   'Y88o.    8888Y' 888888 8888Y'
	88     88  88     88   88     88       88 88     88         88    88     88  88 88    
	88     'Y88Y' 8888Y'   88     88   8888Y' 88     888888 8888Y' 88 88     88  88 88    

	*/
	if( !defined('ABSPATH') ) exit;
	add_action( 'admin_menu', function() {
		add_theme_page(
			'GE: Post Types',
			'GE: Post Types',
			'manage_options',
			'ge-posttypes',
			'Grafik_PostTypes_Output'
		);
	}, 103 );
	function Grafik_PostTypes_Output() {
		/*

		.o8888 888888 888888    .o88o. 8888o. 888888 88 .o88o. 8888o. .o8888
		88     88       88      88  88 88  88   88   88 88  88 88  88 88    
		88  88 8888     88      88  88 8888Y'   88   88 88  88 88  88 'Y88o.
		88  88 88       88      88  88 88       88   88 88  88 88  88     88
		'Y8888 888888   88      'Y88Y' 88       88   88 'Y88Y' 88  88 8888Y'

		*/
		$edit_options_info = $options_info = json_decode( get_option( 'Grafik_PostType_Info', '[]' ), true );
		$edit_options_styles = $options_styles = json_decode( get_option( 'Grafik_PostType_Styles', '[]' ), true );
		$edit_options_header = $options_header = json_decode( get_option( 'Grafik_PostType_Header', '[]' ), true );
		$edit_options_content = $options_content = json_decode( get_option( 'Grafik_PostType_Content', '[]' ), true );
		$edit_options_footer = $options_footer = json_decode( get_option( 'Grafik_PostType_Footer', '[]' ), true );
		$edit_options_scripts = $options_scripts = json_decode( get_option( 'Grafik_PostType_Scripts', '[]' ), true );
		$edit_options_structure = $options_structure = json_decode( get_option( 'Grafik_PostType_Structure', '[]' ), true );
		ksort( $options_info );
		/*

		888888 .o88o. 8888o. 888888o.    .o8888 88  88 8888o. 888888o. 88 888888
		88     88  88 88  88 88 88 88    88     88  88 88  88 88 88 88 88   88  
		8888   88  88 8888Y' 88 88 88    'Y88o. 88  88 8888Y' 88 88 88 88   88  
		88     88  88 88  88 88 88 88        88 88  88 88  88 88 88 88 88   88  
		88     'Y88Y' 88  88 88 88 88    8888Y' 'Y88Y' 8888Y' 88 88 88 88   88  

		*/
		$submit_status = '';
		if( isset( $_POST[ 'Grafik_PostTypes_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_PostTypes_Nonce' ], 'Grafik_PostTypes_Nonce' ) ) {

			$submit_save = array( 'time' => time(), 'user' =>  get_current_user_id() );
			$submit_id = empty( $_POST[ 'edit-id' ] ) ? '' : sanitize_text_field( $_POST[ 'edit-id' ] );

			switch( strtolower( $_POST['action'] ) ) {

				case 'create':
					$submit_id = sanitize_text_field( $_POST['create-slug'] );
					$edit_options_info[ $submit_id ][ 'single' ] = Grafik_WriteEncode( $_POST[ 'create-single' ] );
					$edit_options_info[ $submit_id ][ 'plural' ] = Grafik_WriteEncode( $_POST[ 'create-plural' ] );
					$edit_options_info[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Info', json_encode( $edit_options_info ) );
					break;

				case 'edit-info':
					$edit_options_info[ $submit_id ][ 'single' ] = Grafik_WriteEncode( $_POST[ 'edit-single' ] );
					$edit_options_info[ $submit_id ][ 'plural' ] = Grafik_WriteEncode( $_POST[ 'edit-plural' ] );
					$edit_options_info[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Info', json_encode( $edit_options_info ) );
					break;

				case 'edit-styles':
					$edit_options_styles[ $submit_id ][ 'html' ] = Grafik_WriteEncode( $_POST[ 'edit-html' ] );
					$edit_options_styles[ $submit_id ][ 'behavior' ] = (int)$_POST[ 'edit-behavior' ];
					$edit_options_styles[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Styles', json_encode( $edit_options_styles ) );
					break;

				case 'edit-header':
					$edit_options_header[ $submit_id ][ 'tl' ] = Grafik_WriteEncode( $_POST[ 'edit-header-tl-html' ] );
					$edit_options_header[ $submit_id ][ 'tr' ] = Grafik_WriteEncode( $_POST[ 'edit-header-tr-html' ] );
					$edit_options_header[ $submit_id ][ 'ml' ] = Grafik_WriteEncode( $_POST[ 'edit-header-ml-html' ] );
					$edit_options_header[ $submit_id ][ 'mr' ] = Grafik_WriteEncode( $_POST[ 'edit-header-mr-html' ] );
					$edit_options_header[ $submit_id ][ 'bl' ] = Grafik_WriteEncode( $_POST[ 'edit-header-bl-html' ] );
					$edit_options_header[ $submit_id ][ 'br' ] = Grafik_WriteEncode( $_POST[ 'edit-header-br-html' ] );
					$edit_options_header[ $submit_id ][ 'behavior-tl' ] = (int)$_POST[ 'edit-header-tl-behavior' ];
					$edit_options_header[ $submit_id ][ 'behavior-tr' ] = (int)$_POST[ 'edit-header-tr-behavior' ];
					$edit_options_header[ $submit_id ][ 'behavior-ml' ] = (int)$_POST[ 'edit-header-ml-behavior' ];
					$edit_options_header[ $submit_id ][ 'behavior-mr' ] = (int)$_POST[ 'edit-header-mr-behavior' ];
					$edit_options_header[ $submit_id ][ 'behavior-bl' ] = (int)$_POST[ 'edit-header-bl-behavior' ];
					$edit_options_header[ $submit_id ][ 'behavior-br' ] = (int)$_POST[ 'edit-header-br-behavior' ];
					$edit_options_header[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Header', json_encode( $edit_options_header ) );
					break;

				case 'edit-content':
					$edit_options_content[ $submit_id ][ 't' ] = Grafik_WriteEncode( $_POST[ 'edit-content-t-html' ] );
					$edit_options_content[ $submit_id ][ 'l' ] = Grafik_WriteEncode( $_POST[ 'edit-content-l-html' ] );
					$edit_options_content[ $submit_id ][ 'c' ] = Grafik_WriteEncode( $_POST[ 'edit-content-c-html' ] );
					$edit_options_content[ $submit_id ][ 'r' ] = Grafik_WriteEncode( $_POST[ 'edit-content-r-html' ] );
					$edit_options_content[ $submit_id ][ 'b' ] = Grafik_WriteEncode( $_POST[ 'edit-content-b-html' ] );
					$edit_options_content[ $submit_id ][ 'behavior-t' ] = (int)$_POST[ 'edit-content-t-behavior' ];
					$edit_options_content[ $submit_id ][ 'behavior-l' ] = (int)$_POST[ 'edit-content-l-behavior' ];
					$edit_options_content[ $submit_id ][ 'behavior-c' ] = (int)$_POST[ 'edit-content-c-behavior' ];
					$edit_options_content[ $submit_id ][ 'behavior-r' ] = (int)$_POST[ 'edit-content-r-behavior' ];
					$edit_options_content[ $submit_id ][ 'behavior-b' ] = (int)$_POST[ 'edit-content-b-behavior' ];
					$edit_options_content[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Content', json_encode( $edit_options_content ) );
					break;

				case 'edit-footer':
					$edit_options_footer[ $submit_id ][ 'tl' ] = Grafik_WriteEncode( $_POST[ 'edit-footer-tl-html' ] );
					$edit_options_footer[ $submit_id ][ 'tr' ] = Grafik_WriteEncode( $_POST[ 'edit-footer-tr-html' ] );
					$edit_options_footer[ $submit_id ][ 'ml' ] = Grafik_WriteEncode( $_POST[ 'edit-footer-ml-html' ] );
					$edit_options_footer[ $submit_id ][ 'mr' ] = Grafik_WriteEncode( $_POST[ 'edit-footer-mr-html' ] );
					$edit_options_footer[ $submit_id ][ 'bl' ] = Grafik_WriteEncode( $_POST[ 'edit-footer-bl-html' ] );
					$edit_options_footer[ $submit_id ][ 'br' ] = Grafik_WriteEncode( $_POST[ 'edit-footer-br-html' ] );
					$edit_options_footer[ $submit_id ][ 'behavior-tl' ] = (int)$_POST[ 'edit-footer-tl-behavior' ];
					$edit_options_footer[ $submit_id ][ 'behavior-tr' ] = (int)$_POST[ 'edit-footer-tr-behavior' ];
					$edit_options_footer[ $submit_id ][ 'behavior-ml' ] = (int)$_POST[ 'edit-footer-ml-behavior' ];
					$edit_options_footer[ $submit_id ][ 'behavior-mr' ] = (int)$_POST[ 'edit-footer-mr-behavior' ];
					$edit_options_footer[ $submit_id ][ 'behavior-bl' ] = (int)$_POST[ 'edit-footer-bl-behavior' ];
					$edit_options_footer[ $submit_id ][ 'behavior-br' ] = (int)$_POST[ 'edit-footer-br-behavior' ];
					$edit_options_footer[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Footer', json_encode( $edit_options_footer ) );
					break;

				case 'edit-scripts':
					$edit_options_scripts[ $submit_id ][ 'html' ] = Grafik_WriteEncode( $_POST[ 'edit-html' ] );
					$edit_options_scripts[ $submit_id ][ 'behavior' ] = (int)$_POST[ 'edit-behavior' ];
					$edit_options_scripts[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Scripts', json_encode( $edit_options_scripts ) );
					break;

				case 'edit-structure':
					$edit_options_structure[ $submit_id ][ 'html' ] = Grafik_WriteEncode( $_POST[ 'edit-html' ] );
					$edit_options_structure[ $submit_id ][ 'behavior' ] = (int)$_POST[ 'edit-behavior' ];
					$edit_options_structure[ $submit_id ][ 'save' ] = $submit_save;
					update_option( 'Grafik_PostType_Structure', json_encode( $edit_options_structure ) );
					break;

			}
		}
		/*

		88  88 8888o. 88        .o88o. 88  88 888888 8888o. 88  88    888888o. .o88o. 8888o. .o8888
		88  88 88  88 88        88  88 88  88 88     88  88 88  88    88 88 88 88  88 88  88 88    
		88  88 8888Y' 88        88  88 88  88 8888   8888Y' 'Y8888    88 88 88 888888 8888Y' 'Y88o.
		88  88 88  88 88        'Y8888 88  88 88     88  88     88    88 88 88 88  88 88         88
		'Y88Y' 88  88 888888        88 'Y88Y' 888888 88  88 8888Y'    88 88 88 88  88 88     8888Y'

		*/
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
		$mapped_func = ( isset( $_GET[ 'func' ] ) && array_key_exists( $_GET[ 'func' ], $map_func ) ? $_GET[ 'func' ] : null );
		$mapped_edit = ( isset( $_GET[ 'edit' ] ) && array_key_exists( $_GET[ 'edit' ], $map_edit ) ? $_GET[ 'edit' ] : null );
		$mapped_data = ( isset( $_GET[ 'data' ] ) && array_key_exists( $_GET[ 'data' ], $map_data ) ? $_GET[ 'data' ] : null );
		if( !isset( $_GET[ 'func' ] ) ) $mapped_func = 'create';
		if( !isset( $_GET[ 'data' ] ) ) $mapped_data = 'info';
		/*

		8888o. 8888o. 88 888888o. .o88o. 8888o. 88  88    8888o. .o88o. 88  88
		88  88 88  88 88 88 88 88 88  88 88  88 88  88    88  88 88  88 88  88
		8888Y' 8888Y' 88 88 88 88 888888 8888Y' 'Y8888    88  88 888888 88  88
		88     88  88 88 88 88 88 88  88 88  88     88    88  88 88  88 88 .8'
		88     88  88 88 88 88 88 88  88 88  88 8888Y'    88  88 88  88 888'  

		*/
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
		/*

		.o8888 888888 .o8888 .o88o. 8888o. 8888o. .o88o. 8888o. 88  88    8888o. .o88o. 88  88
		88     88     88     88  88 88  88 88  88 88  88 88  88 88  88    88  88 88  88 88  88
		'Y88o. 8888   88     88  88 88  88 88  88 888888 8888Y' 'Y8888    88  88 888888 88  88
		    88 88     88     88  88 88  88 88  88 88  88 88  88     88    88  88 88  88 88 .8'
		8888Y' 888888 'Y8888 'Y88Y' 88  88 8888Y' 88  88 88  88 8888Y'    88  88 88  88 888'  

		*/
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
		/*

		8888o. 8888o. 88 888888o. .o88o. 8888o. 88  88    888888 88 888888 88     888888
		88  88 88  88 88 88 88 88 88  88 88  88 88  88      88   88   88   88     88    
		8888Y' 8888Y' 88 88 88 88 888888 8888Y' 'Y8888      88   88   88   88     8888  
		88     88  88 88 88 88 88 88  88 88  88     88      88   88   88   88     88    
		88     88  88 88 88 88 88 88  88 88  88 8888Y'      88   88   88   888888 888888

		*/
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
		/*

		.o8888 888888 .o8888 .o88o. 8888o. 8888o. .o88o. 8888o. 88  88    888888 88 888888 88     888888
		88     88     88     88  88 88  88 88  88 88  88 88  88 88  88      88   88   88   88     88    
		'Y88o. 8888   88     88  88 88  88 88  88 888888 8888Y' 'Y8888      88   88   88   88     8888  
		    88 88     88     88  88 88  88 88  88 88  88 88  88     88      88   88   88   88     88    
		8888Y' 888888 'Y8888 'Y88Y' 88  88 8888Y' 88  88 88  88 8888Y'      88   88   88   888888 888888

		*/
		$display_subtitle = '';
		if( empty( $mapped_data ) ) {
			$display_subtitle .= 'Error!';
		} else {
			$display_subtitle .= $map_data[ $mapped_data ];
		}
		$display_subtitle = '<h3>'.$display_subtitle.'</h3>';
		/*

		88 8888o. 8888o. 88  88 888888    888888 88 888888 88     8888o. .o8888
		88 88  88 88  88 88  88   88      88     88 88     88     88  88 88    
		88 88  88 8888Y' 88  88   88      8888   88 8888   88     88  88 'Y88o.
		88 88  88 88     88  88   88      88     88 88     88     88  88     88
		88 88  88 88     'Y88Y'   88      88     88 888888 888888 8888Y' 8888Y'

		*/
		$display_form = '';
		if( empty( $mapped_func ) || $mapped_func == 'create' ) {

			$display_form .=
			'<input type="hidden" name="action" value="create">'.
			'<p><strong>Unique Slug:</strong></p>'.
			'<p><input type="text" name="create-slug" placeholder="custom-type" value="'.$mapped_edit.'"></p>'.
			'<p><strong>Single Name:</strong></p>'.
			'<p><input type="text" name="create-single" placeholder="Custom Type" value=""></p>'.
			'<p><strong>Plural Name:</strong></p>'.
			'<p><input type="text" name="create-plural" placeholder="Custom Types" value=""></p>';

		} else {
			if( empty( $mapped_edit ) || empty( $mapped_data ) ) {

				$display_form .= '<p>Requested operation cannot be performed.</p>';

			} else {

				$display_form .=
				'<input type="hidden" name="action" value="edit-'.$mapped_data.'" />'.
				'<input type="hidden" name="edit-id" value="'.$mapped_edit.'" />';

				switch( $mapped_data ) {

					case 'info':

						$display_form .=
						'<p><strong>Unique Slug:</strong></p>'.
						'<p><input type="text" value="'.$mapped_edit.'" disabled="disabled"></p>'.
						'<p><strong>Single Name:</strong></p>'.
						'<p><input type="text" name="edit-single" placeholder="Custom Type" value="'.Grafik_ReadDecode( $edit_options_info[ $mapped_edit ][ 'single' ] ).'"></p>'.
						'<p><strong>Plural Name:</strong></p>'.
						'<p><input type="text" name="edit-plural" placeholder="Custom Types" value="'.Grafik_ReadDecode( $edit_options_info[ $mapped_edit ][ 'plural' ] ).'"></p>'.
						'<!-- '.print_r( $edit_options_info[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_info[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_info[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					case 'styles':

						$display_form .=
						'<p><strong>HTML:</strong></p>'.
						'<p><textarea name="edit-html">'.Grafik_PrefillTextarea( $edit_options_styles[ $mapped_edit ][ 'html' ] ).'</textarea></p>'.
						'<p><select name="edit-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
						'<!-- '.print_r( $edit_options_styles[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_styles[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_styles[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					case 'header':

						$display_form .=
						'<table>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Top Left:</strong></p>'.
									'<p><textarea name="edit-header-tl-html">'.Grafik_PrefillTextarea( $edit_options_header[ $mapped_edit ][ 'tl' ] ).'</textarea></p>'.
									'<p><select name="edit-header-tl-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Top Right:</strong></p>'.
									'<p><textarea name="edit-header-tr-html">'.Grafik_PrefillTextarea( $edit_options_header[ $mapped_edit ][ 'tr' ] ).'</textarea></p>'.
									'<p><select name="edit-header-tr-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Middle Left:</strong></p>'.
									'<p><textarea name="edit-header-ml-html">'.Grafik_PrefillTextarea( $edit_options_header[ $mapped_edit ][ 'ml' ] ).'</textarea></p>'.
									'<p><select name="edit-header-ml-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Middle Right:</strong></p>'.
									'<p><textarea name="edit-header-mr-html">'.Grafik_PrefillTextarea( $edit_options_header[ $mapped_edit ][ 'mr' ] ).'</textarea></p>'.
									'<p><select name="edit-header-mr-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td>'.
									'<p><strong>Bottom Left:</strong></p>'.
									'<p><textarea name="edit-header-bl-html">'.Grafik_PrefillTextarea( $edit_options_header[ $mapped_edit ][ 'bl' ] ).'</textarea></p>'.
									'<p><select name="edit-header-bl-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td>'.
									'<p><strong>Bottom Right:</strong></p>'.
									'<p><textarea name="edit-header-br-html">'.Grafik_PrefillTextarea( $edit_options_header[ $mapped_edit ][ 'br' ] ).'</textarea></p>'.
									'<p><select name="edit-header-br-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
						'</table>'.
						'<!-- '.print_r( $edit_options_header[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_header[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_header[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					case 'content':

						$display_form .=
						'<table>'.
							'<tr>'.
								'<td colspan="3">'.
									'<p><strong>Top:</strong></p>'.
									'<p><textarea name="edit-content-t-html">'.Grafik_PrefillTextarea( $edit_options_content[ $mapped_edit ][ 't' ] ).'</textarea></p>'.
									'<p><select name="edit-content-t-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td style="width:25%">'.
									'<p><strong>Left:</strong></p>'.
									'<p><textarea name="edit-content-l-html">'.Grafik_PrefillTextarea( $edit_options_content[ $mapped_edit ][ 'l' ] ).'</textarea></p>'.
									'<p><select name="edit-content-l-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td style="width:50%">'.
									'<p><strong>Center:</strong></p>'.
									'<p><textarea name="edit-content-c-html">'.Grafik_PrefillTextarea( $edit_options_content[ $mapped_edit ][ 'c' ] ).'</textarea></p>'.
									'<p><select name="edit-content-c-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
								'<td style="width:25%">'.
									'<p><strong>Right:</strong></p>'.
									'<p><textarea name="edit-content-r-html">'.Grafik_PrefillTextarea( $edit_options_content[ $mapped_edit ][ 'r' ] ).'</textarea></p>'.
									'<p><select name="edit-content-r-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td colspan="3">'.
									'<p><strong>Bottom:</strong></p>'.
									'<p><textarea name="edit-content-b-html">'.Grafik_PrefillTextarea( $edit_options_content[ $mapped_edit ][ 'b' ] ).'</textarea></p>'.
									'<p><select name="edit-content-b-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
								'</td>'.
							'</tr>'.
						'</table>'.
						'<!-- '.print_r( $edit_options_content[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_content[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_content[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					case 'footer':

						$display_form .=
						'<table>'.
							'<tbody>'.
								'<tr>'.
									'<td>'.
										'<p><strong>Top Left:</strong></p>'.
										'<p><textarea name="edit-footer-tl-html">'.Grafik_PrefillTextarea( $edit_options_footer[ $mapped_edit ][ 'tl' ] ).'</textarea></p>'.
										'<p><select name="edit-footer-tl-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
									'</td>'.
									'<td>'.
										'<p><strong>Top Right:</strong></p>'.
										'<p><textarea name="edit-footer-tr-html">'.Grafik_PrefillTextarea( $edit_options_footer[ $mapped_edit ][ 'tr' ] ).'</textarea></p>'.
										'<p><select name="edit-footer-tr-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
									'</td>'.
								'</tr>'.
								'<tr>'.
									'<td>'.
										'<p><strong>Middle Left:</strong></p>'.
										'<p><textarea name="edit-footer-ml-html">'.Grafik_PrefillTextarea( $edit_options_footer[ $mapped_edit ][ 'ml' ] ).'</textarea></p>'.
										'<p><select name="edit-footer-ml-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
									'</td>'.
									'<td>'.
										'<p><strong>Middle Right:</strong></p>'.
										'<p><textarea name="edit-footer-mr-html">'.Grafik_PrefillTextarea( $edit_options_footer[ $mapped_edit ][ 'mr' ] ).'</textarea></p>'.
										'<p><select name="edit-footer-mr-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
									'</td>'.
								'</tr>'.
								'<tr>'.
									'<td>'.
										'<p><strong>Bottom Left:</strong></p>'.
										'<p><textarea name="edit-footer-bl-html">'.Grafik_PrefillTextarea( $edit_options_footer[ $mapped_edit ][ 'bl' ] ).'</textarea></p>'.
										'<p><select name="edit-footer-bl-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
									'</td>'.
									'<td>'.
										'<p><strong>Bottom Right:</strong></p>'.
										'<p><textarea name="edit-footer-br-html">'.Grafik_PrefillTextarea( $edit_options_footer[ $mapped_edit ][ 'br' ] ).'</textarea></p>'.
										'<p><select name="edit-footer-br-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
									'</td>'.
								'</tr>'.
							'</tbody>'.
						'</table>'.
						'<!-- '.print_r( $edit_options_footer[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_footer[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_footer[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					case 'scripts':

						$display_form .=
						'<p><strong>HTML:</strong></p>'.
						'<p><textarea name="edit-html">'.Grafik_PrefillTextarea( $edit_options_scripts[ $mapped_edit ][ 'html' ] ).'</textarea></p>'.
						'<p><select name="edit-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
						'<!-- '.print_r( $edit_options_scripts[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_scripts[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_scripts[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					case 'structure':

						$display_form .=
						'<p><strong>HTML:</strong></p>'.
						'<p><textarea name="edit-html">'.Grafik_PrefillTextarea( $edit_options_structure[ $mapped_edit ][ 'html' ] ).'</textarea></p>'.
						'<p><select name="edit-behavior"><option value="0" selected="selected">Enabled</option><option value="1">Disabled</option></select></p>'.
						'<!-- '.print_r( $edit_options_structure[ $mapped_edit ], true ).' -->';

						$blame_user = get_userdata( $edit_options_structure[ $mapped_edit ][ 'save' ][ 'user' ] );
						$blame_time = date("l, F jS, Y @ g:i A", $edit_options_structure[ $mapped_edit ][ 'save' ][ 'time' ] );

						break;

					default:

						$display_form .=
						'<p>Requested operation cannot be performed.</p>';

						break;

				}
			}
		}
		/*

		8888o. 88     .o88o. 888888o. 888888
		88  88 88     88  88 88 88 88 88    
		8888Y' 88     888888 88 88 88 8888  
		88  88 88     88  88 88 88 88 88    
		8888Y' 888888 88  88 88 88 88 888888

		*/
		
		if( !empty( $option_modified[ $mapped_edit ][ 'save' ] ) ) {
			$blame_user = get_userdata( $option_modified[ $mapped_edit ][ 'save' ][ 'user' ] );
			$blame_time = date("l, F jS, Y @ g:i A", $option_modified[ $mapped_edit ][ 'save' ][ 'time' ] );
		}
		/*

		8888o. 888888 888888 88  88 8888o. 8888o.    .o88o. 88  88 888888 8888o. 88  88 888888
		88  88 88       88   88  88 88  88 88  88    88  88 88  88   88   88  88 88  88   88  
		8888Y' 8888     88   88  88 8888Y' 88  88    88  88 88  88   88   8888Y' 88  88   88  
		88  88 88       88   88  88 88  88 88  88    88  88 88  88   88   88     88  88   88  
		88  88 888888   88   'Y88Y' 88  88 88  88    'Y88Y' 'Y88Y'   88   88     'Y88Y'   88  

		*/
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
								( $mapped_func == 'create' ? '' : '<span class="last-update">Last Updated: '.$blame_time.( empty( $blame_user ) ? '' : ' by '.$blame_user->display_name ).'</span>' ).
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

	}

?>