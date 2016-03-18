<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	function Grafik_Functions_Global_SelectBehavior( $name, $selected ) {
		return
		'<select name="'.$name.'">'.
			'<option value="0"'.( $selected == 0 ? ' selected="selected"' : '').'>Disabled</option>'.
			'<option value="1"'.( $selected == 1 ? ' selected="selected"' : '').'>Enabled</option>'.
		'</select>';
	}

	function Grafik_Functions_Global_InputGroup( $key, $options, $label, $prefix ) {
		return
		'<p><br/><strong>'.$label.':</strong></p>'.
		'<p><textarea name="'.$prefix.'HTML">'.Grafik_PrefillTextarea( $options[ $key.'-html' ] ).'</textarea></p>'.
		'<p>'.Grafik_Functions_Global_SelectBehavior( $prefix.'Mode', $options[ $key.'-mode' ] ).'</p>';
	}

	function Grafik_Functions_Global_GetSave( $key, $options ) {
		if( empty( $options[ $key.'-save' ] ) ) return 'Never...';
		$save = explode( ':', $options[ $key.'-save' ] );
		return date( "l, F jS, Y @ g:i A", $save[ 0 ] ).' by '.$save[ 1 ]->display_name;
	}

	function Grafik_Functions_Global_GetOptions() {
		return json_decode( get_option( 'Grafik_Templates_Global', '[]' ), true );
	}

	function Grafik_Functions_Global_PutOptions( $options ) {
		update_option( 'Grafik_Templates_Global', json_encode( $options ) );
	}

	function Grafik_Functions_Global_Nonce() {
		$key = 'Grafik_Templates_Global_Nonce';
		return ( isset( $_POST[ $key ] ) && wp_verify_nonce( $_POST[ $key ], $key ) );
	}

	function Grafik_Functions_Global_InputFields( $key, $options ) {

		$form = '';
		switch( $key ) {

			case 'styles':
				$form =
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:100%;">'.Grafik_Functions_Global_InputGroup( $key, $options, 'Rules', 'Grafik_Functions_Global_Styles_' ).'</div>'.
				'</div>';
				break;

			case 'header':
				$form =
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-tl', $options, 'Top Left', 'Grafik_Functions_Global_Header_TopLeft' ).'</div>'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-tr', $options, 'Top Right', 'Grafik_Functions_Global_Header_TopRight' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-ml', $options, 'Middle Left', 'Grafik_Functions_Global_Header_MiddleLeft' ).'</div>'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-mr', $options, 'Middle Right', 'Grafik_Functions_Global_Header_MiddleRight' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-bl', $options, 'Bottom Left', 'Grafik_Functions_Global_Header_BottomLeft' ).'</div>'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-br', $options, 'Bottom Right', 'Grafik_Functions_Global_Header_BottomRight' ).'</div>'.
				'</div>';
				break;

			case 'content':
				$form =
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:100%;">'.Grafik_Functions_Global_InputGroup( $key.'-t', $options, 'Top', 'Grafik_Functions_Global_Content_Top' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:33.33333%">'.Grafik_Functions_Global_InputGroup( $key.'-l', $options, 'Left Rail', 'Grafik_Functions_Global_Content_Left' ).'</div>'.
					'<div style="float:left;width:33.33333%">'.Grafik_Functions_Global_InputGroup( $key.'-c', $options, 'Center Rail', 'Grafik_Functions_Global_Content_Center' ).'</div>'.
					'<div style="float:left;width:33.33333%">'.Grafik_Functions_Global_InputGroup( $key.'-r', $options, 'Right Rail', 'Grafik_Functions_Global_Content_Right' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:100%;">'.Grafik_Functions_Global_InputGroup( $key.'-b', $options, 'Bottom', 'Grafik_Functions_Global_Content_Bottom' ).'</div>'.
				'</div>';
				break;

			case 'footer':
				$form =
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-tl', $options, 'Top Left', 'Grafik_Functions_Global_Footer_TopLeft' ).'</div>'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-tr', $options, 'Top Right', 'Grafik_Functions_Global_Footer_TopRight' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-ml', $options, 'Middle Left', 'Grafik_Functions_Global_Footer_MiddleLeft' ).'</div>'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-mr', $options, 'Middle Right', 'Grafik_Functions_Global_Footer_MiddleRight' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-bl', $options, 'Bottom Left', 'Grafik_Functions_Global_Footer_BottomLeft' ).'</div>'.
					'<div style="float:left;width:50%;">'.Grafik_Functions_Global_InputGroup( $key.'-br', $options, 'Bottom Right', 'Grafik_Functions_Global_Footer_BottomRight' ).'</div>'.
				'</div>';
				break;

			case 'scripts':
				$form =
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:100%;">'.Grafik_Functions_Global_InputGroup( $key.'-head', $options, 'Head Tag', 'Grafik_Functions_Global_Scripts_Head' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:100%;">'.Grafik_Functions_Global_InputGroup( $key.'-intro', $options, 'Body Tag (Intro)', 'Grafik_Functions_Global_Scripts_Intro' ).'</div>'.
				'</div>'.
				'<div style="overflow:auto;">'.
					'<div style="float:left;width:100%;">'.Grafik_Functions_Global_InputGroup( $key.'-outro', $options, 'Body Tag (Outro)', 'Grafik_Functions_Global_Scripts_Outro' ).'</div>'.
				'</div>';
				break;

		}

		return
		'<form method="POST">'.
			$form.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.Grafik_Functions_Global_GetSave( $key, $options ).'</span>'.
			wp_nonce_field( 'Grafik_Templates_Global_Nonce', 'Grafik_Templates_Global_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Global_Styles() {

		$key = 'styles';
		$prefix = 'Grafik_Functions_Global_Styles_';
		$options = array_replace(
			Grafik_GetTemplateStructure( array() ),
			Grafik_Functions_Global_GetOptions()
		);

		if( Grafik_Functions_Global_Nonce() ) {
			$options[ $key.'-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'HTML'] );
			$options[ $key.'-mode' ] = (int)$_POST[ $prefix.'Mode' ];
			$options[ $key.'-save' ] = time().':'.get_current_user_id();
			Grafik_Functions_Global_PutOptions( $options );
		}

		return Grafik_Functions_Global_InputFields( $key, $options ).'<!--'.print_r($options,true).'-->';

	}

	function Grafik_Functions_Global_Header() {

		$key = 'header';
		$prefix = 'Grafik_Functions_Global_Header_';
		$options = array_replace(
			Grafik_GetTemplateStructure( array() ),
			Grafik_Functions_Global_GetOptions()
		);

		if( Grafik_Functions_Global_Nonce() ) {
			$options[ $key.'-tl-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'TopLeftHTML' ] );
			$options[ $key.'-tr-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'TopRightHTML' ] );
			$options[ $key.'-ml-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'MiddleLeftHTML' ] );
			$options[ $key.'-mr-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'MiddleRightHTML' ] );
			$options[ $key.'-bl-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'BottomLeftHTML' ] );
			$options[ $key.'-br-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'BottomRightHTML' ] );
			$options[ $key.'-tl-mode' ] = (int)$_POST[ $prefix.'TopLeftMode' ];
			$options[ $key.'-tr-mode' ] = (int)$_POST[ $prefix.'TopRightMode' ];
			$options[ $key.'-ml-mode' ] = (int)$_POST[ $prefix.'MiddleLeftMode' ];
			$options[ $key.'-mr-mode' ] = (int)$_POST[ $prefix.'MiddleRightMode' ];
			$options[ $key.'-bl-mode' ] = (int)$_POST[ $prefix.'BottomLeftMode' ];
			$options[ $key.'-br-mode' ] = (int)$_POST[ $prefix.'BottomRightMode' ];
			$options[ $key.'-save' ] = time().':'.get_current_user_id();
			Grafik_Functions_Global_PutOptions( $options );
		}

		return Grafik_Functions_Global_InputFields( $key, $options ).'<!--'.print_r($options,true).'-->';

	}

	function Grafik_Functions_Global_Content() {

		$key = 'content';
		$prefix = 'Grafik_Functions_Global_Content_';
		$options = array_replace(
			Grafik_GetTemplateStructure( array() ),
			Grafik_Functions_Global_GetOptions()
		);

		if( Grafik_Functions_Global_Nonce() ) {
			$options[ $key.'-t-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'TopHTML' ] );
			$options[ $key.'-l-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'LeftHTML' ] );
			$options[ $key.'-c-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'CenterHTML' ] );
			$options[ $key.'-r-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'RightHTML' ] );
			$options[ $key.'-b-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'BottomHTML' ] );
			$options[ $key.'-t-mode' ] = (int)$_POST[ $prefix.'TopMode' ];
			$options[ $key.'-l-mode' ] = (int)$_POST[ $prefix.'LeftMode' ];
			$options[ $key.'-c-mode' ] = (int)$_POST[ $prefix.'CenterMode' ];
			$options[ $key.'-r-mode' ] = (int)$_POST[ $prefix.'RightMode' ];
			$options[ $key.'-b-mode' ] = (int)$_POST[ $prefix.'BottomMode' ];
			$options[ $key.'-save' ] = time().':'.get_current_user_id();
			Grafik_Functions_Global_PutOptions( $options );
		}

		return Grafik_Functions_Global_InputFields( $key, $options ).'<!--'.print_r($options,true).'-->';

	}

	function Grafik_Functions_Global_Footer() {

		$key = 'footer';
		$prefix = 'Grafik_Functions_Global_Footer_';
		$options = array_replace(
			Grafik_GetTemplateStructure( array() ),
			Grafik_Functions_Global_GetOptions()
		);

		if( Grafik_Functions_Global_Nonce() ) {
			$options[ $key.'-tl-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'TopLeftHTML' ] );
			$options[ $key.'-tr-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'TopRightHTML' ] );
			$options[ $key.'-ml-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'MiddleLeftHTML' ] );
			$options[ $key.'-mr-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'MiddleRightHTML' ] );
			$options[ $key.'-bl-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'BottomLeftHTML' ] );
			$options[ $key.'-br-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'BottomRightHTML' ] );
			$options[ $key.'-tl-mode' ] = (int)$_POST[ $prefix.'TopLeftMode' ];
			$options[ $key.'-tr-mode' ] = (int)$_POST[ $prefix.'TopRightMode' ];
			$options[ $key.'-ml-mode' ] = (int)$_POST[ $prefix.'MiddleLeftMode' ];
			$options[ $key.'-mr-mode' ] = (int)$_POST[ $prefix.'MiddleRightMode' ];
			$options[ $key.'-bl-mode' ] = (int)$_POST[ $prefix.'BottomLeftMode' ];
			$options[ $key.'-br-mode' ] = (int)$_POST[ $prefix.'BottomRightMode' ];
			$options[ $key.'-save' ] = time().':'.get_current_user_id();
			Grafik_Functions_Global_PutOptions( $options );
		}

		return Grafik_Functions_Global_InputFields( $key, $options ).'<!--'.print_r($options,true).'-->';

	}

	function Grafik_Functions_Global_Scripts() {

		$key = 'scripts';
		$prefix = 'Grafik_Functions_Global_Scripts_';
		$options = array_replace(
			Grafik_GetTemplateStructure( array() ),
			Grafik_Functions_Global_GetOptions()
		);

		if( Grafik_Functions_Global_Nonce() ) {
			$options[ $key.'-head-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'HeadHTML' ] );
			$options[ $key.'-intro-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'IntroHTML' ] );
			$options[ $key.'-outro-html' ] = Grafik_WriteEncode( $_POST[ $prefix.'OutroHTML' ] );
			$options[ $key.'-head-mode' ] = (int)$_POST[ $prefix.'HeadMode' ];
			$options[ $key.'-intro-mode' ] = (int)$_POST[ $prefix.'IntroMode' ];
			$options[ $key.'-outro-mode' ] = (int)$_POST[ $prefix.'OutroMode' ];
			$options[ $key.'-save' ] = time().':'.get_current_user_id();
			Grafik_Functions_Global_PutOptions( $options );
		}

		return Grafik_Functions_Global_InputFields( $key, $options ).'<!--'.print_r($options,true).'-->';

	}

?>