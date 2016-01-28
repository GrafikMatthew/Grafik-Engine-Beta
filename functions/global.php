<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	function Grafik_Functions_Global_SelectBehavior($name, $selected) {

		return
		'<select name="'.$name.'">'.
			'<option value="0"'.( $selected == 0 ? ' selected="selected"' : '').'>Enabled</option>'.
			'<option value="1"'.( $selected == 1 ? ' selected="selected"' : '').'>Disabled</option>'.
		'</select>';

	}

	function Grafik_Functions_Global_Styles() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option( 'Grafik_Functions_Global_Styles', '[]' ), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Global_Styles_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Global_Styles_Nonce' ], 'Grafik_Functions_Global_Styles_Nonce' ) ) {
			$option_modified['html'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Styles_HTML'] );
			$option_modified['behavior-html'] = (int)$_POST['Grafik_Functions_Global_Styles_BehaviorHTML'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Global_Styles', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# OUTPUT DATA
		#
		return
		'<form method="POST">'.
			'<p><textarea name="Grafik_Functions_Global_Styles_HTML">'.Grafik_PrefillTextarea( $option_modified['html'] ).'</textarea></p>'.
			'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Styles_BehaviorHTML', $option_modified['behavior-html'] ).'</p>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Global_Styles_Nonce', 'Grafik_Functions_Global_Styles_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Global_Header() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Global_Header', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Global_Header_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Global_Header_Nonce' ], 'Grafik_Functions_Global_Header_Nonce' ) ) {
			$option_modified['tl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Header_TL'] );
			$option_modified['tr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Header_TR'] );
			$option_modified['ml'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Header_ML'] );
			$option_modified['mr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Header_MR'] );
			$option_modified['bl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Header_BL'] );
			$option_modified['br'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Header_BR'] );
			$option_modified['behavior-tl'] = (int)$_POST['Grafik_Functions_Global_Header_BehaviorTL'];
			$option_modified['behavior-tr'] = (int)$_POST['Grafik_Functions_Global_Header_BehaviorTR'];
			$option_modified['behavior-ml'] = (int)$_POST['Grafik_Functions_Global_Header_BehaviorML'];
			$option_modified['behavior-mr'] = (int)$_POST['Grafik_Functions_Global_Header_BehaviorMR'];
			$option_modified['behavior-bl'] = (int)$_POST['Grafik_Functions_Global_Header_BehaviorBL'];
			$option_modified['behavior-br'] = (int)$_POST['Grafik_Functions_Global_Header_BehaviorBR'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Global_Header', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# OUTPUT DATA
		#
		return
		'<form method="POST">'.
			'<table>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Top Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Header_TL">'.Grafik_PrefillTextarea( $option_modified['tl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Header_BehaviorTL', $option_modified['behavior-tl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Top Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Header_TR">'.Grafik_PrefillTextarea( $option_modified['tr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Header_BehaviorTR', $option_modified['behavior-tr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Middle Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Header_ML">'.Grafik_PrefillTextarea( $option_modified['ml'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Header_BehaviorML', $option_modified['behavior-ml'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Middle Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Header_MR">'.Grafik_PrefillTextarea( $option_modified['mr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Header_BehaviorMR', $option_modified['behavior-mr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Bottom Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Header_BL">'.Grafik_PrefillTextarea( $option_modified['bl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Header_BehaviorBL', $option_modified['behavior-bl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Bottom Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Header_BR">'.Grafik_PrefillTextarea( $option_modified['br'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Header_BehaviorBR', $option_modified['behavior-br'] ).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Global_Header_Nonce', 'Grafik_Functions_Global_Header_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Global_Content() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Global_Content', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Global_Content_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Global_Content_Nonce' ], 'Grafik_Functions_Global_Content_Nonce' ) ) {
			$option_modified['t'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Content_T'] );
			$option_modified['l'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Content_L'] );
			$option_modified['c'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Content_C'] );
			$option_modified['r'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Content_R'] );
			$option_modified['b'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Content_B'] );
			$option_modified['behavior-t'] = (int)$_POST['Grafik_Functions_Global_Content_BehaviorT'];
			$option_modified['behavior-l'] = (int)$_POST['Grafik_Functions_Global_Content_BehaviorL'];
			$option_modified['behavior-c'] = (int)$_POST['Grafik_Functions_Global_Content_BehaviorC'];
			$option_modified['behavior-r'] = (int)$_POST['Grafik_Functions_Global_Content_BehaviorR'];
			$option_modified['behavior-b'] = (int)$_POST['Grafik_Functions_Global_Content_BehaviorB'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Global_Content', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# OUTPUT DATA
		#
		return
		'<form method="POST">'.
			'<table>'.
				'<tr>'.
					'<td colspan="3">'.
						'<p><strong>Top:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Content_T">'.Grafik_PrefillTextarea( $option_modified['t'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Content_BehaviorT', $option_modified['behavior-t'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td style="width:25%">'.
						'<p><strong>Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Content_L">'.Grafik_PrefillTextarea( $option_modified['l'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Content_BehaviorL', $option_modified['behavior-l'] ).'</p>'.
					'</td>'.
					'<td style="width:50%">'.
						'<p><strong>Center:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Content_C">'.Grafik_PrefillTextarea( $option_modified['c'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Content_BehaviorC', $option_modified['behavior-c'] ).'</p>'.
					'</td>'.
					'<td style="width:25%">'.
						'<p><strong>Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Content_R">'.Grafik_PrefillTextarea( $option_modified['r'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Content_BehaviorR', $option_modified['behavior-r'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td colspan="3">'.
						'<p><strong>Bottom:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Content_B">'.Grafik_PrefillTextarea( $option_modified['b'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Content_BehaviorB', $option_modified['behavior-b'] ).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Global_Content_Nonce', 'Grafik_Functions_Global_Content_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Global_Footer() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Global_Footer', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Global_Footer_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Global_Footer_Nonce' ], 'Grafik_Functions_Global_Footer_Nonce' ) ) {
			$option_modified['tl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Footer_TL'] );
			$option_modified['tr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Footer_TR'] );
			$option_modified['ml'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Footer_ML'] );
			$option_modified['mr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Footer_MR'] );
			$option_modified['bl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Footer_BL'] );
			$option_modified['br'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Footer_BR'] );
			$option_modified['behavior-tl'] = (int)$_POST['Grafik_Functions_Global_Footer_BehaviorTL'];
			$option_modified['behavior-tr'] = (int)$_POST['Grafik_Functions_Global_Footer_BehaviorTR'];
			$option_modified['behavior-ml'] = (int)$_POST['Grafik_Functions_Global_Footer_BehaviorML'];
			$option_modified['behavior-mr'] = (int)$_POST['Grafik_Functions_Global_Footer_BehaviorMR'];
			$option_modified['behavior-bl'] = (int)$_POST['Grafik_Functions_Global_Footer_BehaviorBL'];
			$option_modified['behavior-br'] = (int)$_POST['Grafik_Functions_Global_Footer_BehaviorBR'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Global_Footer', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# OUTPUT DATA
		#
		return
		'<form method="POST">'.
			'<table>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Top Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Footer_TL">'.Grafik_PrefillTextarea( $option_modified['tl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Footer_BehaviorTL', $option_modified['behavior-tl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Top Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Footer_TR">'.Grafik_PrefillTextarea( $option_modified['tr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Footer_BehaviorTR', $option_modified['behavior-tr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Middle Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Footer_ML">'.Grafik_PrefillTextarea( $option_modified['ml'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Footer_BehaviorML', $option_modified['behavior-ml'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Middle Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Footer_MR">'.Grafik_PrefillTextarea( $option_modified['mr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Footer_BehaviorMR', $option_modified['behavior-mr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Bottom Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Footer_BL">'.Grafik_PrefillTextarea( $option_modified['bl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Footer_BehaviorBL', $option_modified['behavior-bl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Bottom Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Global_Footer_BR">'.Grafik_PrefillTextarea( $option_modified['br'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Footer_BehaviorBR', $option_modified['behavior-br'] ).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Global_Footer_Nonce', 'Grafik_Functions_Global_Footer_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Global_Scripts() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Global_Scripts', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Global_Scripts_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Global_Scripts_Nonce' ], 'Grafik_Functions_Global_Scripts_Nonce' ) ) {
			$option_modified['html'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Global_Scripts_HTML'] );
			$option_modified['behavior-html'] = (int)$_POST['Grafik_Functions_Global_Scripts_BehaviorHTML'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Global_Scripts', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified['save-user'] ) ? get_userdata( $option_modified['save-user'] ) : array();

		#
		# OUTPUT DATA
		#
		return
		'<form method="POST">'.
			'<p><textarea name="Grafik_Functions_Global_Scripts_HTML">'.Grafik_PrefillTextarea( $option_modified['html'] ).'</textarea></p>'.
			'<p>'.Grafik_Functions_Global_SelectBehavior( 'Grafik_Functions_Global_Scripts_BehaviorHTML', $option_modified['behavior-html'] ).'</p>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Global_Scripts_Nonce', 'Grafik_Functions_Global_Scripts_Nonce', true, false ).
		'</form>';

	}

?>