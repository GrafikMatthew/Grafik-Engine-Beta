<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	function Grafik_Functions_Pages_SelectBehavior($name, $selected) {

		#
		# OUTPUT DATA
		#
		return
		'<select name="'.$name.'">'.
			'<option value="0"'.( $selected == 0 ? ' selected="selected"' : '').'>Global &gt; Static &gt; Page</option>'.
			'<option value="1"'.( $selected == 1 ? ' selected="selected"' : '').'>Global &gt; Static</option>'.
			'<option value="2"'.( $selected == 2 ? ' selected="selected"' : '').'>Global &gt; Page &gt; Static</option>'.
			'<option value="3"'.( $selected == 3 ? ' selected="selected"' : '').'>Global &gt; Page</option>'.
			'<option value="4"'.( $selected == 4 ? ' selected="selected"' : '').'>Global</option>'.
			'<option value="100"'.( $selected == 100 ? ' selected="selected"' : '').'>Static &gt; Global &gt; Page</option>'.
			'<option value="101"'.( $selected == 101 ? ' selected="selected"' : '').'>Static &gt; Global</option>'.
			'<option value="102"'.( $selected == 102 ? ' selected="selected"' : '').'>Static &gt; Page &gt; Global</option>'.
			'<option value="103"'.( $selected == 103 ? ' selected="selected"' : '').'>Static &gt; Page</option>'.
			'<option value="104"'.( $selected == 104 ? ' selected="selected"' : '').'>Static</option>'.
			'<option value="200"'.( $selected == 200 ? ' selected="selected"' : '').'>Page &gt; Global &gt; Static</option>'.
			'<option value="201"'.( $selected == 201 ? ' selected="selected"' : '').'>Page &gt; Global</option>'.
			'<option value="202"'.( $selected == 202 ? ' selected="selected"' : '').'>Page &gt; Static &gt; Global</option>'.
			'<option value="203"'.( $selected == 203 ? ' selected="selected"' : '').'>Page &gt; Static</option>'.
			'<option value="204"'.( $selected == 204 ? ' selected="selected"' : '').'>Page</option>'.
			'<option value="300"'.( $selected == 300 ? ' selected="selected"' : '').'>Disabled</option>'.
		'</select>';

	}

	function Grafik_Functions_Pages_Styles() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Pages_Styles', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Pages_Styles_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Pages_Styles_Nonce' ], 'Grafik_Functions_Pages_Styles_Nonce' ) ) {
			$option_modified['html'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Styles_HTML'] );
			$option_modified['behavior-html'] = (int)$_POST['Grafik_Functions_Pages_Styles_BehaviorHTML'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Pages_Styles', json_encode( $option_modified ) );
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
			'<p><textarea name="Grafik_Functions_Pages_Styles_HTML">'.Grafik_PrefillTextarea( $option_modified['html'] ).'</textarea></p>'.
			'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Styles_BehaviorHTML', $option_modified['behavior-html'] ).'</p>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Pages_Styles_Nonce', 'Grafik_Functions_Pages_Styles_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Pages_Header() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Pages_Header', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Pages_Header_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Pages_Header_Nonce' ], 'Grafik_Functions_Pages_Header_Nonce' ) ) {
			$option_modified['tl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Header_TL'] );
			$option_modified['tr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Header_TR'] );
			$option_modified['ml'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Header_ML'] );
			$option_modified['mr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Header_MR'] );
			$option_modified['bl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Header_BL'] );
			$option_modified['br'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Header_BR'] );
			$option_modified['behavior-tl'] = (int)$_POST['Grafik_Functions_Pages_Header_BehaviorTL'];
			$option_modified['behavior-tr'] = (int)$_POST['Grafik_Functions_Pages_Header_BehaviorTR'];
			$option_modified['behavior-ml'] = (int)$_POST['Grafik_Functions_Pages_Header_BehaviorML'];
			$option_modified['behavior-mr'] = (int)$_POST['Grafik_Functions_Pages_Header_BehaviorMR'];
			$option_modified['behavior-bl'] = (int)$_POST['Grafik_Functions_Pages_Header_BehaviorBL'];
			$option_modified['behavior-br'] = (int)$_POST['Grafik_Functions_Pages_Header_BehaviorBR'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Pages_Header', json_encode( $option_modified ) );
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
						'<p><textarea name="Grafik_Functions_Pages_Header_TL">'.Grafik_PrefillTextarea( $option_modified['tl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Header_BehaviorTL', $option_modified['behavior-tl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Top Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Header_TR">'.Grafik_PrefillTextarea( $option_modified['tr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Header_BehaviorTR', $option_modified['behavior-tr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Middle Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Header_ML">'.Grafik_PrefillTextarea( $option_modified['ml'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Header_BehaviorML', $option_modified['behavior-ml'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Middle Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Header_MR">'.Grafik_PrefillTextarea( $option_modified['mr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Header_BehaviorMR', $option_modified['behavior-mr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Bottom Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Header_BL">'.Grafik_PrefillTextarea( $option_modified['bl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Header_BehaviorBL', $option_modified['behavior-bl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Bottom Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Header_BR">'.Grafik_PrefillTextarea( $option_modified['br'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Header_BehaviorBR', $option_modified['behavior-br'] ).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Pages_Header_Nonce', 'Grafik_Functions_Pages_Header_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Pages_Content() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Pages_Content', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Pages_Content_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Pages_Content_Nonce' ], 'Grafik_Functions_Pages_Content_Nonce' ) ) {
			$option_modified['t'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Content_T'] );
			$option_modified['l'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Content_L'] );
			$option_modified['c'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Content_C'] );
			$option_modified['r'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Content_R'] );
			$option_modified['b'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Content_B'] );
			$option_modified['behavior-t'] = (int)$_POST['Grafik_Functions_Pages_Content_BehaviorT'];
			$option_modified['behavior-l'] = (int)$_POST['Grafik_Functions_Pages_Content_BehaviorL'];
			$option_modified['behavior-c'] = (int)$_POST['Grafik_Functions_Pages_Content_BehaviorC'];
			$option_modified['behavior-r'] = (int)$_POST['Grafik_Functions_Pages_Content_BehaviorR'];
			$option_modified['behavior-b'] = (int)$_POST['Grafik_Functions_Pages_Content_BehaviorB'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Pages_Content', json_encode( $option_modified ) );
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
						'<p><textarea name="Grafik_Functions_Pages_Content_T">'.Grafik_PrefillTextarea( $option_modified['t'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Content_BehaviorT', $option_modified['behavior-t'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td style="width:25%">'.
						'<p><strong>Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Content_L">'.Grafik_PrefillTextarea( $option_modified['l'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Content_BehaviorL', $option_modified['behavior-l'] ).'</p>'.
					'</td>'.
					'<td style="width:50%">'.
						'<p><strong>Center:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Content_C">'.Grafik_PrefillTextarea( $option_modified['c'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Content_BehaviorC', $option_modified['behavior-c'] ).'</p>'.
					'</td>'.
					'<td style="width:25%">'.
						'<p><strong>Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Content_R">'.Grafik_PrefillTextarea( $option_modified['r'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Content_BehaviorR', $option_modified['behavior-r'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td colspan="3">'.
						'<p><strong>Bottom:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Content_B">'.Grafik_PrefillTextarea( $option_modified['b'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Content_BehaviorB', $option_modified['behavior-b'] ).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Pages_Content_Nonce', 'Grafik_Functions_Pages_Content_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Pages_Footer() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Pages_Footer', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Pages_Footer_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Pages_Footer_Nonce' ], 'Grafik_Functions_Pages_Footer_Nonce' ) ) {
			$option_modified['tl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Footer_TL'] );
			$option_modified['tr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Footer_TR'] );
			$option_modified['ml'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Footer_ML'] );
			$option_modified['mr'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Footer_MR'] );
			$option_modified['bl'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Footer_BL'] );
			$option_modified['br'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Footer_BR'] );
			$option_modified['behavior-tl'] = (int)$_POST['Grafik_Functions_Pages_Footer_BehaviorTL'];
			$option_modified['behavior-tr'] = (int)$_POST['Grafik_Functions_Pages_Footer_BehaviorTR'];
			$option_modified['behavior-ml'] = (int)$_POST['Grafik_Functions_Pages_Footer_BehaviorML'];
			$option_modified['behavior-mr'] = (int)$_POST['Grafik_Functions_Pages_Footer_BehaviorMR'];
			$option_modified['behavior-bl'] = (int)$_POST['Grafik_Functions_Pages_Footer_BehaviorBL'];
			$option_modified['behavior-br'] = (int)$_POST['Grafik_Functions_Pages_Footer_BehaviorBR'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Pages_Footer', json_encode( $option_modified ) );
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
						'<p><textarea name="Grafik_Functions_Pages_Footer_TL">'.Grafik_PrefillTextarea( $option_modified['tl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Footer_BehaviorTL', $option_modified['behavior-tl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Top Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Footer_TR">'.Grafik_PrefillTextarea( $option_modified['tr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Footer_BehaviorTR', $option_modified['behavior-tr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Middle Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Footer_ML">'.Grafik_PrefillTextarea( $option_modified['ml'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Footer_BehaviorML', $option_modified['behavior-ml'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Middle Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Footer_MR">'.Grafik_PrefillTextarea( $option_modified['mr'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Footer_BehaviorMR', $option_modified['behavior-mr'] ).'</p>'.
					'</td>'.
				'</tr>'.
				'<tr>'.
					'<td>'.
						'<p><strong>Bottom Left:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Footer_BL">'.Grafik_PrefillTextarea( $option_modified['bl'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Footer_BehaviorBL', $option_modified['behavior-bl'] ).'</p>'.
					'</td>'.
					'<td>'.
						'<p><strong>Bottom Right:</strong></p>'.
						'<p><textarea name="Grafik_Functions_Pages_Footer_BR">'.Grafik_PrefillTextarea( $option_modified['br'] ).'</textarea></p>'.
						'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Footer_BehaviorBR', $option_modified['behavior-br'] ).'</p>'.
					'</td>'.
				'</tr>'.
			'</table>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Pages_Footer_Nonce', 'Grafik_Functions_Pages_Footer_Nonce', true, false ).
		'</form>';

	}

	function Grafik_Functions_Pages_Scripts() {

		#
		# STORED OPTION
		#
		$option_stored = json_decode( get_option('Grafik_Functions_Pages_Scripts', '[]'), true );

		#
		# UPDATE OPTION
		#
		$option_modified = $option_stored;
		if( isset( $_POST[ 'Grafik_Functions_Pages_Scripts_Nonce' ] ) && wp_verify_nonce( $_POST[ 'Grafik_Functions_Pages_Scripts_Nonce' ], 'Grafik_Functions_Pages_Scripts_Nonce' ) ) {
			$option_modified['html'] = Grafik_WriteEncode( $_POST['Grafik_Functions_Pages_Scripts_HTML'] );
			$option_modified['behavior-html'] = (int)$_POST['Grafik_Functions_Pages_Scripts_BehaviorHTML'];
			$option_modified['save-time'] = time();
			$option_modified['save-user'] = get_current_user_id();
			update_option( 'Grafik_Functions_Pages_Scripts', json_encode( $option_modified ) );
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
			'<p><textarea name="Grafik_Functions_Pages_Scripts_HTML">'.Grafik_PrefillTextarea( $option_modified['html'] ).'</textarea></p>'.
			'<p>'.Grafik_Functions_Pages_SelectBehavior( 'Grafik_Functions_Pages_Scripts_BehaviorHTML', $option_modified['behavior-html'] ).'</p>'.
			'<hr/>'.
			'<button type="submit" class="button button-primary button-large">Save Changes</button>'.
			'<span class="last-update">Last Updated: '.( empty( $option_modified['save-time'] ) ? 'Never...' : date("l, F jS, Y @ g:i A", $option_modified['save-time'] ).' by '.$option_modified_user->display_name ).'</span>'.
			wp_nonce_field( 'Grafik_Functions_Pages_Scripts_Nonce', 'Grafik_Functions_Pages_Scripts_Nonce', true, false ).
		'</form>';

	}

?>