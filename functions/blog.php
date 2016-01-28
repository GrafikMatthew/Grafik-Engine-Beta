<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	function Grafik_Functions_Blog_Styles() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Blog_Styles', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Blog_Styles_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Blog_Styles_Nonce' ], 'Grafik_Functions_Blog_Styles_Nonce' ) ) {
			$option_modified['html'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Styles_HTML'] );
			$option_modified['behavior-html'] = (int)$_POST['Grafik_Functions_Blog_Styles_BehaviorHTML'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Blog_Styles', json_encode( $option_modified ) );
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
			'<p><textarea name="Grafik_Functions_Blog_Styles_HTML">'.Grafik_PrefillTextarea( $option_modified['html'] ).'</textarea></p>'.
			'<p>'.
				'<select name="Grafik_Functions_Blog_Styles_BehaviorHTML">'.
					'<option value="0"'.( $option_modified['behavior-html'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
					'<option value="1"'.( $option_modified['behavior-html'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
					'<option value="2"'.( $option_modified['behavior-html'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
				'</select>'.
			'</p>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Blog_Styles_Nonce', 'Grafik_Functions_Blog_Styles_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Blog_Header() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Blog_Header', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Blog_Header_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Blog_Header_Nonce' ], 'Grafik_Functions_Blog_Header_Nonce' ) ) {
			$option_modified['tl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Header_TL'] );
			$option_modified['tr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Header_TR'] );
			$option_modified['ml'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Header_ML'] );
			$option_modified['mr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Header_MR'] );
			$option_modified['bl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Header_BL'] );
			$option_modified['br'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Header_BR'] );
			$option_modified['behavior-tl'] = (int)$_POST['Grafik_Functions_Blog_Header_BehaviorTL'];
			$option_modified['behavior-tr'] = (int)$_POST['Grafik_Functions_Blog_Header_BehaviorTR'];
			$option_modified['behavior-ml'] = (int)$_POST['Grafik_Functions_Blog_Header_BehaviorML'];
			$option_modified['behavior-mr'] = (int)$_POST['Grafik_Functions_Blog_Header_BehaviorMR'];
			$option_modified['behavior-bl'] = (int)$_POST['Grafik_Functions_Blog_Header_BehaviorBL'];
			$option_modified['behavior-br'] = (int)$_POST['Grafik_Functions_Blog_Header_BehaviorBR'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Blog_Header', json_encode( $option_modified ) );
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
						'<p><textarea name="Grafik_Functions_Blog_Header_TL">'.Grafik_PrefillTextarea( $option_modified['tl'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Header_BehaviorTL">'.
								'<option value="0"'.( $option_modified['behavior-tl'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-tl'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-tl'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Top Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Header_TR">'.Grafik_PrefillTextarea( $option_modified['tr'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Header_BehaviorTR">'.
								'<option value="0"'.( $option_modified['behavior-tr'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-tr'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-tr'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Middle Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Header_ML">'.Grafik_PrefillTextarea( $option_modified['ml'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Header_BehaviorML">'.
								'<option value="0"'.( $option_modified['behavior-ml'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-ml'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-ml'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Middle Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Header_MR">'.Grafik_PrefillTextarea( $option_modified['mr'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Header_BehaviorMR">'.
								'<option value="0"'.( $option_modified['behavior-mr'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-mr'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-mr'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Bottom Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Header_BL">'.Grafik_PrefillTextarea( $option_modified['bl'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Header_BehaviorBL">'.
								'<option value="0"'.( $option_modified['behavior-bl'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-bl'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-bl'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Bottom Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Header_BR">'.Grafik_PrefillTextarea( $option_modified['br'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Header_BehaviorBR">'.
								'<option value="0"'.( $option_modified['behavior-br'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-br'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-br'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Blog_Header_Nonce', 'Grafik_Functions_Blog_Header_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Blog_Content() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Blog_Content', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Blog_Content_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Blog_Content_Nonce' ], 'Grafik_Functions_Blog_Content_Nonce' ) ) {
			$option_modified['t'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Content_T'] );
			$option_modified['l'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Content_L'] );
			$option_modified['c'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Content_C'] );
			$option_modified['r'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Content_R'] );
			$option_modified['b'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Content_B'] );
			$option_modified['behavior-t'] = (int)$_POST['Grafik_Functions_Blog_Content_BehaviorT'];
			$option_modified['behavior-l'] = (int)$_POST['Grafik_Functions_Blog_Content_BehaviorL'];
			$option_modified['behavior-c'] = (int)$_POST['Grafik_Functions_Blog_Content_BehaviorC'];
			$option_modified['behavior-r'] = (int)$_POST['Grafik_Functions_Blog_Content_BehaviorR'];
			$option_modified['behavior-b'] = (int)$_POST['Grafik_Functions_Blog_Content_BehaviorB'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Blog_Content', json_encode( $option_modified ) );
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
						'<p><textarea name="Grafik_Functions_Blog_Content_T">'.Grafik_PrefillTextarea( $option_modified['t'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Content_BehaviorT">'.
								'<option value="0"'.( $option_modified['behavior-t'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-t'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-t'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td style="width:25%">'.
						'<p><strong>Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Content_L">'.Grafik_PrefillTextarea( $option_modified['l'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Content_BehaviorL">'.
								'<option value="0"'.( $option_modified['behavior-l'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-l'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-l'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td style="width:50%">'.
						'<p><strong>Center:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Content_C">'.Grafik_PrefillTextarea( $option_modified['c'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Content_BehaviorC">'.
								'<option value="0"'.( $option_modified['behavior-c'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-c'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-c'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td style="width:25%">'.
						'<p><strong>Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Content_R">'.Grafik_PrefillTextarea( $option_modified['r'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Content_BehaviorR">'.
								'<option value="0"'.( $option_modified['behavior-r'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-r'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-r'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td colspan="3">'.
						'<p><strong>Bottom:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Content_B">'.Grafik_PrefillTextarea( $option_modified['b'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Content_BehaviorB">'.
								'<option value="0"'.( $option_modified['behavior-b'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-b'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-b'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Blog_Content_Nonce', 'Grafik_Functions_Blog_Content_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Blog_Footer() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Blog_Footer', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Blog_Footer_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Blog_Footer_Nonce' ], 'Grafik_Functions_Blog_Footer_Nonce' ) ) {
			$option_modified['tl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Footer_TL'] );
			$option_modified['tr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Footer_TR'] );
			$option_modified['ml'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Footer_ML'] );
			$option_modified['mr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Footer_MR'] );
			$option_modified['bl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Footer_BL'] );
			$option_modified['br'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Footer_BR'] );
			$option_modified['behavior-tl'] = (int)$_POST['Grafik_Functions_Blog_Footer_BehaviorTL'];
			$option_modified['behavior-tr'] = (int)$_POST['Grafik_Functions_Blog_Footer_BehaviorTR'];
			$option_modified['behavior-ml'] = (int)$_POST['Grafik_Functions_Blog_Footer_BehaviorML'];
			$option_modified['behavior-mr'] = (int)$_POST['Grafik_Functions_Blog_Footer_BehaviorMR'];
			$option_modified['behavior-bl'] = (int)$_POST['Grafik_Functions_Blog_Footer_BehaviorBL'];
			$option_modified['behavior-br'] = (int)$_POST['Grafik_Functions_Blog_Footer_BehaviorBR'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Blog_Footer', json_encode( $option_modified ) );
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
						'<p><textarea name="Grafik_Functions_Blog_Footer_TL">'.Grafik_PrefillTextarea( $option_modified['tl'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Footer_BehaviorTL">'.
								'<option value="0"'.( $option_modified['behavior-tl'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-tl'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-tl'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Top Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Footer_TR">'.Grafik_PrefillTextarea( $option_modified['tr'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Footer_BehaviorTR">'.
								'<option value="0"'.( $option_modified['behavior-tr'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-tr'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-tr'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Middle Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Footer_ML">'.Grafik_PrefillTextarea( $option_modified['ml'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Footer_BehaviorML">'.
								'<option value="0"'.( $option_modified['behavior-ml'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-ml'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-ml'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Middle Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Footer_MR">'.Grafik_PrefillTextarea( $option_modified['mr'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Footer_BehaviorMR">'.
								'<option value="0"'.( $option_modified['behavior-mr'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-mr'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-mr'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Bottom Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Footer_BL">'.Grafik_PrefillTextarea( $option_modified['bl'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Footer_BehaviorBL">'.
								'<option value="0"'.( $option_modified['behavior-bl'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-bl'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-bl'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Bottom Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Footer_BR">'.Grafik_PrefillTextarea( $option_modified['br'] ).'</textarea></p>'.
						'<p>'.
							'<select name="Grafik_Functions_Blog_Footer_BehaviorBR">'.
								'<option value="0"'.( $option_modified['behavior-br'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
								'<option value="1"'.( $option_modified['behavior-br'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
								'<option value="2"'.( $option_modified['behavior-br'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
							'</select>'.
						'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Blog_Footer_Nonce', 'Grafik_Functions_Blog_Footer_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Blog_Scripts() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Blog_Scripts', '[]' ), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Blog_Scripts_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Blog_Scripts_Nonce' ], 'Grafik_Functions_Blog_Scripts_Nonce' ) ) {
			$option_modified['html'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Blog_Scripts_HTML'] );
			$option_modified['behavior-html'] = (int)$_POST['Grafik_Functions_Blog_Scripts_BehaviorHTML'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Blog_Scripts', json_encode( $option_modified ) );
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
			'<p><textarea name="Grafik_Functions_Blog_Scripts_HTML">'.Grafik_PrefillTextarea( $option_modified['html'] ).'</textarea></p>'.
			'<p>'.
				'<select name="Grafik_Functions_Blog_Scripts_BehaviorHTML">'.
					'<option value="0"'.( $option_modified['behavior-html'] == 0 ? ' selected="selected"' : '').'>Global First</option>'.
					'<option value="1"'.( $option_modified['behavior-html'] == 1 ? ' selected="selected"' : '').'>Global Last</option>'.
					'<option value="2"'.( $option_modified['behavior-html'] == 2 ? ' selected="selected"' : '').'>Global Disabled</option>'.
				'</select>'.
			'</p>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Blog_Scripts_Nonce', 'Grafik_Functions_Blog_Scripts_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Blog_Structure() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option( 'Grafik_Functions_Blog_Structure', '[]' ), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Blog_Structure_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Blog_Structure_Nonce' ], 'Grafik_Functions_Blog_Structure_Nonce' ) ) {
			$option_modified[ 'html' ] = Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Blog_Structure_HTML' ] );
			$option_modified[ 'save-time' ] = time();
			$option_modified[ 'save-user' ] = get_current_user_id();
			update_option( 'Grafik_Functions_Blog_Structure', json_encode( $option_modified ) );
		}

		#
		# OPTION USER
		#
		$option_modified_user = isset( $option_modified[ 'save-user' ] ) ? get_userdata( $option_modified[ 'save-user' ] ) : array();

		#
		# OUTPUT DATA
		#
		return
		'<form method="POST">'.
			'<table>'.
				'<tr>'.
					'<td>'.
						'<p><strong>HTML:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Blog_Structure_HTML">'.Grafik_PrefillTextarea( $option_modified[ 'html' ] ).'</textarea></p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<div class="cheat-sheet">'.
							'<p><strong>Cheat Sheet</strong></p>'.
							'<table class="showable">'.
								'<tr><td colspan="3"><hr/></td></tr>'.
								'<tr>'.
									'<td style="width:33.33333%">'.
										'<table>'.
											'<tr><th style="width:33.33333%">Post ID:</th><td>{{ ID }}</td></tr>'.
											'<tr><th style="width:33.33333%">Parent ID:</th><td>{{ PARENT_ID }}</td></tr>'.
											'<tr><th style="width:33.33333%">Author ID:</th><td>{{ AUTHOR_ID }}</td></tr>'.
											'<tr><th style="width:33.33333%">Author Slug:</th><td>{{ AUTHOR_SLUG }}</td></tr>'.
											'<tr><th style="width:33.33333%">Author Name:</th><td>{{ AUTHOR_NAME }}</td></tr>'.
											'<tr><th style="width:33.33333%">Category Names:</th><td>{{ CATEGORY_NAMES }}</td></tr>'.
											'<tr><th style="width:33.33333%">Category Links:</th><td>{{ CATEGORY_LINKS }}</td></tr>'.
											'<tr><th style="width:33.33333%">Featured Image:</th><td>{{ FEATURED_IMAGE }}</td></tr>'.
											'<tr><th style="width:33.33333%">Content:</th><td>{{ CONTENT }}</td></tr>'.
											'<tr><th style="width:33.33333%">Title:</th><td>{{ TITLE }}</td></tr>'.
											'<tr><th style="width:33.33333%">Title Slug:</th><td>{{ TITLE_SLUG }}</td></tr>'.
											'<tr><th style="width:33.33333%">Excerpt:</th><td>{{ EXCERPT }}</td></tr>'.
										'</table>'.
									'</td>'.
									'<td style="width:33.33333%">'.
										'<table>'.
											'<tr><th style="width:33.33333%">Day:</th><td>{{ DATE_DAY }}</td></tr>'.
											'<tr><th style="width:33.33333%">Day (Padded):</th><td>{{ DATE_DAY_PADDED }}</td></tr>'.
											'<tr><th style="width:33.33333%">Day Suffix:</th><td>{{ DATE_DAY_SUFFIX }}</td></tr>'.
											'<tr><th style="width:33.33333%">Weekday:</th><td>{{ DATE_WEEKDAY }}</td></tr>'.
											'<tr><th style="width:33.33333%">Weekday (Abbr):</th><td>{{ DATE_WEEKDAY_ABBR }}</td></tr>'.
											'<tr><th style="width:33.33333%">Month:</th><td>{{ DATE_MONTH }}</td></tr>'.
											'<tr><th style="width:33.33333%">Month (Padded):</th><td>{{ DATE_MONTH_PADDED }}</td></tr>'.
											'<tr><th style="width:33.33333%">Month (Full):</th><td>{{ DATE_MONTH_FULL }}</td></tr>'.
											'<tr><th style="width:33.33333%">Month (Abbr):</th><td>{{ DATE_MONTH_ABBR }}</td></tr>'.
											'<tr><th style="width:33.33333%">Year:</th><td>{{ DATE_YEAR }}</td></tr>'.
											'<tr><th style="width:33.33333%">Year (Abbr):</th><td>{{ DATE_YEAR_ABBR }}</td></tr>'.
										'</table>'.
									'</td>'.
									'<td style="width:33.33333%">'.
										'<table>'.
											'<tr><th style="width:33.33333%">24H Hour:</th><td>{{ TIME_24H }}</td></tr>'.
											'<tr><th style="width:33.33333%">24H Hour (Padded):</th><td>{{ TIME_24H_PADDED }}</td></tr>'.
											'<tr><th style="width:33.33333%">12H Hour:</th><td>{{ TIME_12H }}</td></tr>'.
											'<tr><th style="width:33.33333%">12H Hour (Padded):</th><td>{{ TIME_12H_PADDED }}</td></tr>'.
											'<tr><th style="width:33.33333%">12H Suffix:</th><td>{{ TIME_12H_SUFFIX }}</td></tr>'.
											'<tr><th style="width:33.33333%">Minutes:</th><td>{{ TIME_MINUTES }}</td></tr>'.
											'<tr><th style="width:33.33333%">Seconds:</th><td>{{ TIME_SECONDS }}</td></tr>'.
											'<tr><th style="width:33.33333%">Timezone:</th><td>{{ TIME_ZONE }}</td></tr>'.
											'<tr><th style="width:33.33333%">ISO8601:</th><td>{{ TIME_ISO8601 }}</td></tr>'.
											'<tr><th style="width:33.33333%">RFC2822:</th><td>{{ TIME_RFC2822 }}</td></tr>'.
											'<tr><th style="width:33.33333%">&nbsp;</th><td>&nbsp;</td></tr>'.
											'<tr><th style="width:33.33333%">GUID:</th><td>{{ GUID }}</td></tr>'.
											'<tr><th style="width:33.33333%">Permalink:</th><td>{{ PERMALINK }}</td></tr>'.
										'</table>'.
									'</td>'.
								'</tr>'.
							'</table>'.
						'</div>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified[ 'save-time' ] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified[ 'save-time' ] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Blog_Structure_Nonce', 'Grafik_Functions_Blog_Structure_Nonce', true, false ).
		'</form>';

	}

?>