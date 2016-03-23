<?php

	/*

	888888 888888 888888o. 8888o. 88     .o88o. 888888 888888 .o8888    8888o. 88  88 8888o.
	  88   88     88 88 88 88  88 88     88  88   88   88     88        88  88 88  88 88  88
	  88   8888   88 88 88 8888Y' 88     888888   88   8888   'Y88o.    8888Y' 888888 8888Y'
	  88   88     88 88 88 88     88     88  88   88   88         88    88     88  88 88    
	  88   888888 88 88 88 88     888888 88  88   88   888888 8888Y' 88 88     88  88 88    

	*/

	if( !defined('ABSPATH') ) exit;

	function Grafik_Templates_Init() {

		add_theme_page(
			'GE: Templates',
			'GE: Templates',
			'manage_options',
			'GrafikEngine-Templates',
			'Grafik_Templates_Main'
		);

	}

	function Grafik_Templates_Main() {

		$template_map = Grafik_Templates_GetInherits();
		$template = isset( $_GET[ 'template' ] ) ? $_GET[ 'template' ] : '';
		if( !array_key_exists( $template, $template_map ) ) $template = key( $template_map );

		$section_map = Grafik_Templates_GetFields();
		$section = isset( $_GET[ 'section' ] ) ? $_GET[ 'section' ] : '';
		if( !array_key_exists( $section, $section_map ) ) $section = key( $section_map );

		$output_primary = '';
		foreach( $template_map as $key => $val ) {
			$output_primary .=
			'<li'.( $template == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page='.$_GET[ 'page' ].'&amp;template='.$key.'">'.
					$key.
				'</a>'.
			'</li>';
		}

		$output_secondary = '';
		foreach( $section_map as $key => $val ) {
			$output_secondary .=
			'<li'.( $section == $key ? ' class="active"' : '' ).'>'.
				'<a href="?page='.$_GET[ 'page' ].'&amp;template='.$template.'&amp;section='.$key.'">'.
					$key.
				'</a>'.
			'</li>';
		}

		echo
		'<div class="grafik-functions">'.
			'<h1><span>Templates</span></h1>'.
			'<div class="grafik-functions-display">'.
				'<div class="grafik-functions-primarynav">'.
					'<ul>'.$output_primary.'</ul>'.
				'</div>'.
				'<div class="grafik-functions-primarydisplay">'.
					'<h2>'.$template.'</h2>'.
					'<div class="grafik-functions-secondarynav">'.
						'<ul>'.$output_secondary.'</ul>'.
					'</div>'.
					'<div class="grafik-functions-secondarydisplay">'.
						'<h3>'.$section.'</h3>'.
						Grafik_Templates_GetInterface( $template, $section, $section_map[ $section ] ).
					'</div>'.
				'</div>'.
				'<script src="'.get_template_directory_uri().'/js/functions.js"></script>'.
			'</div>'.
		'</div>'.
		Grafik_ProfileColors();

	}

	function Grafik_Templates_GetInterface( $template, $section, $fields ) {

		Grafik_Templates_PutOptions( $template, $section, $fields );
		return Grafik_Templates_GetEditor( $template, $section, $fields );

	}

	function Grafik_Templates_GetOptions( $template ) {

		return json_decode( get_option( 'Grafik_Templates_'.$template, '[]' ), true );

	}

	function Grafik_Templates_PutOptions( $template, $section, $fields ) {

		if( Grafik_Templates_ValidNonce( $template ) ) {
			$options = Grafik_Templates_GetOptions( $template );
			foreach( $fields as $field ) {
				$options[ $section.'_'.$field.'_HTML' ] = Grafik_WriteEncode( $_POST[ $section.'_'.$field.'_HTML' ] );
				$options[ $section.'_'.$field.'_Mode' ] = (int)$_POST[ $section.'_'.$field.'_Mode' ];
			}
			$options[ $section.'_Save' ] = time().':'.get_current_user_id();
			return update_option( 'Grafik_Templates_'.$template, json_encode( $options ) );
		}
		return false;

	}

	function Grafik_Templates_ValidNonce( $template ) {

		$key = 'Grafik_Templates_'.$template.'_Nonce';
		return ( isset( $_POST[ $key ] ) && wp_verify_nonce( $_POST[ $key ], $key ) );

	}

	function Grafik_Templates_GetFieldset( $section, $field, $options ) {

		$field_html = $section.'_'.$field.'_HTML';
		$field_mode = $section.'_'.$field.'_Mode';

		$textarea_html =
		'<textarea name="'.$field_html.'">'.
			Grafik_PrefillTextarea( $options[ $field_html ] ).
		'</textarea>';

		$select_html = '';
		$select_options = array( 'Disabled', 'Prepend', 'Append', 'Overwrite' );
		$select_active = isset( $options[ $field_mode ] ) ? $options[ $field_mode ] : '2';
		foreach( $select_options as $key => $val ) {
			$select_html .=
			'<option value="'.$key.'"'.( $select_active == $key ? ' selected="selected"' : '' ).'>'.
				$val.
			'</option>';
		}
		$select_html =
		'<label>Behavior:</label>'.
		'<select name="'.$field_mode.'">'.
			$select_html.
		'</select>';

		return
		'<fieldset class="'.$section.'_'.$field.'">'.
			'<legend>'.$field.'</legend>'.
			'<div class="html">'.$textarea_html.'</div>'.
			'<div class="mode">'.$select_html.'</div>'.
		'</fieldset>';

	}

	function Grafik_Templates_GetTimestamp( $data ) {

		if( empty( $data ) ) return 'Never...';
		$data = explode( ':', $data );
		return date( "l, F jS, Y @ g:i A", $data[ 0 ] ).' by '.$data[ 1 ]->display_name;

	}

	function Grafik_Templates_GetEditor( $template, $section, $fields ) {

		$options = Grafik_Templates_GetOptions( $template );

		$form = '';
		foreach( $fields as $field ) {
			$form .= Grafik_Templates_GetFieldset( $section, $field , $options );
		}

		return
		'<form method="POST" id="Grafik_Templates_'.$section.'">'.
			$form.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.Grafik_Templates_GetTimestamp( $options[ $section.'_Save' ] ).'</span>'.
			wp_nonce_field( 'Grafik_Templates_'.$template.'_Nonce', 'Grafik_Templates_'.$template.'_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Templates_GetInherits() {

		return array(
			'Global' => array(),
			'Pages' => array( 'Global' ),
			'NotFound' => array( 'Global', 'Pages' ),
			'SearchResults' => array( 'Global', 'Pages' ),
			'Posts' => array( 'Global' ),
			'PostTypes' => array( 'Global', 'Posts' ),
			'Archives' => array( 'Global' ),
			'ArchiveTypes' => array( 'Global', 'Archives' ),
			'ArchiveAuthors' => array( 'Global', 'Archives' ),
			'ArchiveCategories' => array( 'Global', 'Categories' )
		);

	}

	function Grafik_Templates_GetFields() {

		return array(
			'Styles' => array( 'Head' ),
			'Header' => array( 'TopLeft', 'TopRight', 'MiddleLeft', 'MiddleRight', 'BottomLeft', 'BottomRight' ),
			'Content' => array( 'Top', 'Left', 'Center', 'Right', 'Bottom' ),
			'Footer' => array( 'TopLeft', 'TopRight', 'MiddleLeft', 'MiddleRight', 'BottomLeft', 'BottomRight' ),
			'Scripts' => array( 'Head', 'Intro', 'Outro' )
		);

	}

	function Grafik_Templates_GetHTML( $template, $single_id = false ) {

		$inherits = Grafik_Templates_GetInherits();
		$sections = Grafik_Templates_GetFields();

		$order = $inherits[ $template ];
		$order[] = $template;

		$options = array();
		foreach( $order as $current ) {
			$options[] = Grafik_Templates_GetOptions( $current );
		}
		if( $single_id !== false ) {
			$options[] = get_post_meta( $single_id, 'Grafik_Metaboxes' );
		}

		$html = array();
		foreach( $options as $option ) {
			foreach( $sections as $section => $fields ) {
				foreach( $fields as $field ) {
					$key = $section.'_'.$field;
					if( !is_array( $html[ $key ] ) ) {
						$html[ $key ] = array();
					}
					if( isset( $option[ $key.'_Mode' ] ) ) {
						switch( $option[ $key.'_Mode' ] ) {
							case '0': continue; break;
							case '1': array_unshift( $html[ $key ], $option[ $key.'_HTML' ] ); break;
							case '2': array_push( $html[ $key ], $option[ $key.'_HTML' ] ); break;
							case '3': $html[ $key ] = array( $option[ $key.'_HTML' ] ); break;
						}
					}
				} // foreach( $fields )
			} // foreach ( $sections )
		} // foreach ( $options )

		foreach( $html as $section => $blocks ) {
			$output = '';
			foreach( $blocks as $block ) $output .= Grafik_ReadDecode( $block );
			$html[ $section ] = Grafik_Menus_GetHTML( $section, Grafik_ShortcodeLoop( $output ) );
		}

		return $html;

	}

	add_action( 'admin_menu', 'Grafik_Templates_Init', 103 );
