<?php

	#
	# SECURE THEME
	#
	if( !defined('ABSPATH') ) exit;

	#
	# EVENT HOOKS
	#
	add_action( 'save_post', 'Grafik_Functions_Metabox_Save' );

	#
	# SUBMIT HANDLER
	#
	function Grafik_Functions_Metabox_Save( $post_id ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_verified = wp_verify_nonce( $_POST[ 'Grafik_Functions_Metabox_Nonce' ], 'Grafik_Functions_Metabox_Nonce' );
		if( $is_autosave || $is_revision || !$is_verified ) return;

		$meta = array(
			'styles' => array(
				'html' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Styles_HTML' ] ),
				'behavior-html-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Global' ],
				'behavior-html-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Blog' ],
				'behavior-html-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Posts' ],
				'behavior-html-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Pages' ],
				'behavior-html-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Self' ]
			),
			'header' => array(
				'tl' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Header_TL' ] ),
				'behavior-tl-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTL_Global' ],
				'behavior-tl-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTL_Blog' ],
				'behavior-tl-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTL_Posts' ],
				'behavior-tl-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTL_Pages' ],
				'behavior-tl-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTL_Self' ],
				'tr' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Header_TR' ] ),
				'behavior-tr-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTR_Global' ],
				'behavior-tr-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTR_Blog' ],
				'behavior-tr-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTR_Posts' ],
				'behavior-tr-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTR_Pages' ],
				'behavior-tr-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorTR_Self' ],
				'ml' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Header_ML' ] ),
				'behavior-ml-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorML_Global' ],
				'behavior-ml-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorML_Blog' ],
				'behavior-ml-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorML_Posts' ],
				'behavior-ml-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorML_Pages' ],
				'behavior-ml-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorML_Self' ],
				'mr' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Header_MR' ] ),
				'behavior-mr-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorMR_Global' ],
				'behavior-mr-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorMR_Blog' ],
				'behavior-mr-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorMR_Posts' ],
				'behavior-mr-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorMR_Pages' ],
				'behavior-mr-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorMR_Self' ],
				'bl' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Header_BL' ] ),
				'behavior-bl-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBL_Global' ],
				'behavior-bl-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBL_Blog' ],
				'behavior-bl-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBL_Posts' ],
				'behavior-bl-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBL_Pages' ],
				'behavior-bl-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBL_Self' ],
				'br' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Header_BR' ] ),
				'behavior-br-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBR_Global' ],
				'behavior-br-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBR_Blog' ],
				'behavior-br-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBR_Posts' ],
				'behavior-br-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBR_Pages' ],
				'behavior-br-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Header_BehaviorBR_Self' ]
			),
			'content' => array(
				't' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Content_T' ] ),
				'behavior-t-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorT_Global' ],
				'behavior-t-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorT_Blog' ],
				'behavior-t-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorT_Posts' ],
				'behavior-t-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorT_Pages' ],
				'behavior-t-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorT_Self' ],
				'l' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Content_L' ] ),
				'behavior-l-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorL_Global' ],
				'behavior-l-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorL_Blog' ],
				'behavior-l-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorL_Posts' ],
				'behavior-l-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorL_Pages' ],
				'behavior-l-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorL_Self' ],
				'c' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Content_C' ] ),
				'behavior-c-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorC_Global' ],
				'behavior-c-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorC_Blog' ],
				'behavior-c-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorC_Posts' ],
				'behavior-c-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorC_Pages' ],
				'behavior-c-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorC_Self' ],
				'r' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Content_R' ] ),
				'behavior-r-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorR_Global' ],
				'behavior-r-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorR_Blog' ],
				'behavior-r-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorR_Posts' ],
				'behavior-r-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorR_Pages' ],
				'behavior-r-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorR_Self' ],
				'b' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Content_B' ] ),
				'behavior-b-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorB_Global' ],
				'behavior-b-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorB_Blog' ],
				'behavior-b-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorB_Posts' ],
				'behavior-b-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorB_Pages' ],
				'behavior-b-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Content_BehaviorB_Self' ]
			),
			'footer' => array(
				'tl' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Footer_TL' ] ),
				'behavior-tl-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTL_Global' ],
				'behavior-tl-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTL_Blog' ],
				'behavior-tl-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTL_Posts' ],
				'behavior-tl-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTL_Pages' ],
				'behavior-tl-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTL_Self' ],
				'tr' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Footer_TR' ] ),
				'behavior-tr-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTR_Global' ],
				'behavior-tr-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTR_Blog' ],
				'behavior-tr-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTR_Posts' ],
				'behavior-tr-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTR_Pages' ],
				'behavior-tr-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorTR_Self' ],
				'ml' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Footer_ML' ] ),
				'behavior-ml-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorML_Global' ],
				'behavior-ml-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorML_Blog' ],
				'behavior-ml-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorML_Posts' ],
				'behavior-ml-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorML_Pages' ],
				'behavior-ml-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorML_Self' ],
				'mr' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Footer_MR' ] ),
				'behavior-mr-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorMR_Global' ],
				'behavior-mr-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorMR_Blog' ],
				'behavior-mr-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorMR_Posts' ],
				'behavior-mr-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorMR_Pages' ],
				'behavior-mr-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorMR_Self' ],
				'bl' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Footer_BL' ] ),
				'behavior-bl-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBL_Global' ],
				'behavior-bl-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBL_Blog' ],
				'behavior-bl-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBL_Posts' ],
				'behavior-bl-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBL_Pages' ],
				'behavior-bl-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBL_Self' ],
				'br' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Footer_BR' ] ),
				'behavior-br-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBR_Global' ],
				'behavior-br-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBR_Blog' ],
				'behavior-br-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBR_Posts' ],
				'behavior-br-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBR_Pages' ],
				'behavior-br-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Footer_BehaviorBR_Self' ]
			),
			'scripts' => array(
				'html' => Grafik_WriteEncode( $_POST[ 'Grafik_Functions_Metabox_Scripts_HTML' ] ),
				'behavior-html-global' => (int)$_POST[ 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Global' ],
				'behavior-html-blog' => (int)$_POST[ 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Blog' ],
				'behavior-html-posts' => (int)$_POST[ 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Posts' ],
				'behavior-html-pages' => (int)$_POST[ 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Pages' ],
				'behavior-html-self' => (int)$_POST[ 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Self' ]
			)
		);

		update_post_meta( $post_id, 'Grafik_Functions', json_encode( $meta ) );

	}



	#
	# EVENT HOOKS
	#
	add_action( 'add_meta_boxes', function() {

		// Core Support...
		add_meta_box( 'Grafik_Functions_Metabox_Fields', 'Grafik Functions', 'Grafik_Functions_Metabox_Fields', 'page' );
		add_meta_box( 'Grafik_Functions_Metabox_Fields', 'Grafik Functions', 'Grafik_Functions_Metabox_Fields', 'post' );

		// Custom Types Support...
		$Grafik_CustomTypes = json_decode( get_option('Grafik_CustomTypes', '[]'), true );
		foreach( $Grafik_CustomTypes as $key => $val ) {
			if( $key == 'save-time' || $key == 'save-user' ) continue;
			add_meta_box( 'Grafik_Functions_Metabox_Fields', 'Grafik Functions', 'Grafik_Functions_Metabox_Fields', $key );
		}

	});

	function Grafik_Functions_Metabox_Fields( $entry ) {

		$meta = json_decode( get_post_meta( $entry->ID, 'Grafik_Functions', true ), true );
		$is_home = (int)get_option('page_for_posts') == (int)$entry->ID;
		$is_post = $entry->post_type == 'post';
		$is_page = $entry->post_type == 'page';
		$default_val = 1;

		// STUB

		$html = array(
			'styles' => array( 'html' => '' ),
			'header' => array( 'tl' => '', 'tr' => '', 'ml' => '', 'mr' => '', 'bl' => '', 'br' => '' ),
			'content' => array( 't' => '', 'l' => '', 'c' => '', 'r' => '', 'b' => '' ),
			'footer' => array( 'tl' => '', 'tr' => '', 'ml' => '', 'mr' => '', 'bl' => '', 'br' => '' ),
			'styles' => array( 'html' => '' )
		);

		// GLOBAL

		$html[ 'styles' ][ 'html' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Global', strlen( $meta[ 'styles' ][ 'behavior-html-global' ] ) > 0 ? $meta[ 'styles' ][ 'behavior-html-global' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'tl' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTL_Global', strlen( $meta[ 'header' ][ 'behavior-tl-global' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tl-global' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'tr' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTR_Global', strlen( $meta[ 'header' ][ 'behavior-tr-global' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tr-global' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'ml' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorML_Global', strlen( $meta[ 'header' ][ 'behavior-ml-global' ] ) > 0 ? $meta[ 'header' ][ 'behavior-ml-global' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'mr' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorMR_Global', strlen( $meta[ 'header' ][ 'behavior-mr-global' ] ) > 0 ? $meta[ 'header' ][ 'behavior-mr-global' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'bl' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBL_Global', strlen( $meta[ 'header' ][ 'behavior-bl-global' ] ) > 0 ? $meta[ 'header' ][ 'behavior-bl-global' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'br' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBR_Global', strlen( $meta[ 'header' ][ 'behavior-br-global' ] ) > 0 ? $meta[ 'header' ][ 'behavior-br-global' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 't' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorT_Global', strlen( $meta[ 'content' ][ 'behavior-t-global' ] ) > 0 ? $meta[ 'content' ][ 'behavior-t-global' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'l' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorL_Global', strlen( $meta[ 'content' ][ 'behavior-l-global' ] ) > 0 ? $meta[ 'content' ][ 'behavior-l-global' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'c' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorC_Global', strlen( $meta[ 'content' ][ 'behavior-c-global' ] ) > 0 ? $meta[ 'content' ][ 'behavior-c-global' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'r' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorR_Global', strlen( $meta[ 'content' ][ 'behavior-r-global' ] ) > 0 ? $meta[ 'content' ][ 'behavior-r-global' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'b' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorB_Global', strlen( $meta[ 'content' ][ 'behavior-b-global' ] ) > 0 ? $meta[ 'content' ][ 'behavior-b-global' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'tl' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTL_Global', strlen( $meta[ 'footer' ][ 'behavior-tl-global' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tl-global' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'tr' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTR_Global', strlen( $meta[ 'footer' ][ 'behavior-tr-global' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tr-global' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'ml' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorML_Global', strlen( $meta[ 'footer' ][ 'behavior-ml-global' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-ml-global' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'mr' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorMR_Global', strlen( $meta[ 'footer' ][ 'behavior-mr-global' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-mr-global' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'bl' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBL_Global', strlen( $meta[ 'footer' ][ 'behavior-bl-global' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-bl-global' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'br' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBR_Global', strlen( $meta[ 'footer' ][ 'behavior-br-global' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-br-global' ] : $default_val ).'</td></tr>';
		$html[ 'scripts' ][ 'html' ] .= '<tr><th><strong>Global:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Global', strlen( $meta[ 'scripts' ][ 'behavior-html-global' ] ) > 0 ? $meta[ 'scripts' ][ 'behavior-html-global' ] : $default_val ).'</td></tr>';
		$default_val ++;

		// PAGES

		if( $is_page ) {
			$html[ 'styles' ][ 'html' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Pages', strlen( $meta[ 'styles' ][ 'behavior-html-pages' ] ) > 0 ? $meta[ 'styles' ][ 'behavior-html-pages' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'tl' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTL_Pages', strlen( $meta[ 'header' ][ 'behavior-tl-pages' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tl-pages' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'tr' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTR_Pages', strlen( $meta[ 'header' ][ 'behavior-tr-pages' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tr-pages' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'ml' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorML_Pages', strlen( $meta[ 'header' ][ 'behavior-ml-pages' ] ) > 0 ? $meta[ 'header' ][ 'behavior-ml-pages' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'mr' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorMR_Pages', strlen( $meta[ 'header' ][ 'behavior-mr-pages' ] ) > 0 ? $meta[ 'header' ][ 'behavior-mr-pages' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'bl' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBL_Pages', strlen( $meta[ 'header' ][ 'behavior-bl-pages' ] ) > 0 ? $meta[ 'header' ][ 'behavior-bl-pages' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'br' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBR_Pages', strlen( $meta[ 'header' ][ 'behavior-br-pages' ] ) > 0 ? $meta[ 'header' ][ 'behavior-br-pages' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 't' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorT_Pages', strlen( $meta[ 'content' ][ 'behavior-t-pages' ] ) > 0 ? $meta[ 'content' ][ 'behavior-t-pages' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'l' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorL_Pages', strlen( $meta[ 'content' ][ 'behavior-l-pages' ] ) > 0 ? $meta[ 'content' ][ 'behavior-l-pages' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'c' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorC_Pages', strlen( $meta[ 'content' ][ 'behavior-c-pages' ] ) > 0 ? $meta[ 'content' ][ 'behavior-c-pages' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'r' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorR_Pages', strlen( $meta[ 'content' ][ 'behavior-r-pages' ] ) > 0 ? $meta[ 'content' ][ 'behavior-r-pages' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'b' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorB_Pages', strlen( $meta[ 'content' ][ 'behavior-b-pages' ] ) > 0 ? $meta[ 'content' ][ 'behavior-b-pages' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'tl' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTL_Pages', strlen( $meta[ 'footer' ][ 'behavior-tl-pages' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tl-pages' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'tr' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTR_Pages', strlen( $meta[ 'footer' ][ 'behavior-tr-pages' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tr-pages' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'ml' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorML_Pages', strlen( $meta[ 'footer' ][ 'behavior-ml-pages' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-ml-pages' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'mr' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorMR_Pages', strlen( $meta[ 'footer' ][ 'behavior-mr-pages' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-mr-pages' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'bl' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBL_Pages', strlen( $meta[ 'footer' ][ 'behavior-bl-pages' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-bl-pages' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'br' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBR_Pages', strlen( $meta[ 'footer' ][ 'behavior-br-pages' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-br-pages' ] : $default_val ).'</td></tr>';
			$html[ 'scripts' ][ 'html' ] .= '<tr><th><strong>Pages:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Pages', strlen( $meta[ 'scripts' ][ 'behavior-html-pages' ] ) > 0 ? $meta[ 'scripts' ][ 'behavior-html-pages' ] : $default_val ).'</td></tr>';
			$default_val ++;
		}

		// BLOG PAGE, POSTS

		if( $is_home || $is_post ) {
			$html[ 'styles' ][ 'html' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Blog', strlen( $meta[ 'styles' ][ 'behavior-html-blog' ] ) > 0 ? $meta[ 'styles' ][ 'behavior-html-blog' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'tl' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTL_Blog', strlen( $meta[ 'header' ][ 'behavior-tl-blog' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tl-blog' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'tr' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTR_Blog', strlen( $meta[ 'header' ][ 'behavior-tr-blog' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tr-blog' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'ml' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorML_Blog', strlen( $meta[ 'header' ][ 'behavior-ml-blog' ] ) > 0 ? $meta[ 'header' ][ 'behavior-ml-blog' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'mr' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorMR_Blog', strlen( $meta[ 'header' ][ 'behavior-mr-blog' ] ) > 0 ? $meta[ 'header' ][ 'behavior-mr-blog' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'bl' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBL_Blog', strlen( $meta[ 'header' ][ 'behavior-bl-blog' ] ) > 0 ? $meta[ 'header' ][ 'behavior-bl-blog' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'br' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBR_Blog', strlen( $meta[ 'header' ][ 'behavior-br-blog' ] ) > 0 ? $meta[ 'header' ][ 'behavior-br-blog' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 't' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorT_Blog', strlen( $meta[ 'content' ][ 'behavior-t-blog' ] ) > 0 ? $meta[ 'content' ][ 'behavior-t-blog' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'l' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorL_Blog', strlen( $meta[ 'content' ][ 'behavior-l-blog' ] ) > 0 ? $meta[ 'content' ][ 'behavior-l-blog' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'c' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorC_Blog', strlen( $meta[ 'content' ][ 'behavior-c-blog' ] ) > 0 ? $meta[ 'content' ][ 'behavior-c-blog' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'r' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorR_Blog', strlen( $meta[ 'content' ][ 'behavior-r-blog' ] ) > 0 ? $meta[ 'content' ][ 'behavior-r-blog' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'b' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorB_Blog', strlen( $meta[ 'content' ][ 'behavior-b-blog' ] ) > 0 ? $meta[ 'content' ][ 'behavior-b-blog' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'tl' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTL_Blog', strlen( $meta[ 'footer' ][ 'behavior-tl-blog' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tl-blog' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'tr' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTR_Blog', strlen( $meta[ 'footer' ][ 'behavior-tr-blog' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tr-blog' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'ml' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorML_Blog', strlen( $meta[ 'footer' ][ 'behavior-ml-blog' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-ml-blog' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'mr' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorMR_Blog', strlen( $meta[ 'footer' ][ 'behavior-mr-blog' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-mr-blog' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'bl' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBL_Blog', strlen( $meta[ 'footer' ][ 'behavior-bl-blog' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-bl-blog' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'br' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBR_Blog', strlen( $meta[ 'footer' ][ 'behavior-br-blog' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-br-blog' ] : $default_val ).'</td></tr>';
			$html[ 'scripts' ][ 'html' ] .= '<tr><th><strong>Blog:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Blog', strlen( $meta[ 'scripts' ][ 'behavior-html-blog' ] ) > 0 ? $meta[ 'scripts' ][ 'behavior-html-blog' ] : $default_val ).'</td></tr>';
			$default_val ++;
		}

		// POSTS

		if( $is_post ) {

			$html[ 'styles' ][ 'html' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Posts', strlen( $meta[ 'styles' ][ 'behavior-html-posts' ] ) > 0 ? $meta[ 'styles' ][ 'behavior-html-posts' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'tl' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTL_Posts', strlen( $meta[ 'header' ][ 'behavior-tl-posts' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tl-posts' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'tr' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTR_Posts', strlen( $meta[ 'header' ][ 'behavior-tr-posts' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tr-posts' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'ml' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorML_Posts', strlen( $meta[ 'header' ][ 'behavior-ml-posts' ] ) > 0 ? $meta[ 'header' ][ 'behavior-ml-posts' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'mr' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorMR_Posts', strlen( $meta[ 'header' ][ 'behavior-mr-posts' ] ) > 0 ? $meta[ 'header' ][ 'behavior-mr-posts' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'bl' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBL_Posts', strlen( $meta[ 'header' ][ 'behavior-bl-posts' ] ) > 0 ? $meta[ 'header' ][ 'behavior-bl-posts' ] : $default_val ).'</td></tr>';
			$html[ 'header' ][ 'br' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBR_Posts', strlen( $meta[ 'header' ][ 'behavior-br-posts' ] ) > 0 ? $meta[ 'header' ][ 'behavior-br-posts' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 't' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorT_Posts', strlen( $meta[ 'content' ][ 'behavior-t-posts' ] ) > 0 ? $meta[ 'content' ][ 'behavior-t-posts' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'l' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorL_Posts', strlen( $meta[ 'content' ][ 'behavior-l-posts' ] ) > 0 ? $meta[ 'content' ][ 'behavior-l-posts' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'c' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorC_Posts', strlen( $meta[ 'content' ][ 'behavior-c-posts' ] ) > 0 ? $meta[ 'content' ][ 'behavior-c-posts' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'r' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorR_Posts', strlen( $meta[ 'content' ][ 'behavior-r-posts' ] ) > 0 ? $meta[ 'content' ][ 'behavior-r-posts' ] : $default_val ).'</td></tr>';
			$html[ 'content' ][ 'b' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorB_Posts', strlen( $meta[ 'content' ][ 'behavior-b-posts' ] ) > 0 ? $meta[ 'content' ][ 'behavior-b-posts' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'tl' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTL_Posts', strlen( $meta[ 'footer' ][ 'behavior-tl-posts' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tl-posts' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'tr' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTR_Posts', strlen( $meta[ 'footer' ][ 'behavior-tr-posts' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tr-posts' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'ml' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorML_Posts', strlen( $meta[ 'footer' ][ 'behavior-ml-posts' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-ml-posts' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'mr' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorMR_Posts', strlen( $meta[ 'footer' ][ 'behavior-mr-posts' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-mr-posts' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'bl' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBL_Posts', strlen( $meta[ 'footer' ][ 'behavior-bl-posts' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-bl-posts' ] : $default_val ).'</td></tr>';
			$html[ 'footer' ][ 'br' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBR_Posts', strlen( $meta[ 'footer' ][ 'behavior-br-posts' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-br-posts' ] : $default_val ).'</td></tr>';
			$html[ 'scripts' ][ 'html' ] .= '<tr><th><strong>Posts:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Posts', strlen( $meta[ 'scripts' ][ 'behavior-html-posts' ] ) > 0 ? $meta[ 'scripts' ][ 'behavior-html-posts' ] : $default_val ).'</td></tr>';
			$default_val ++;
		}

		// SELF

		$html[ 'styles' ][ 'html' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Styles_BehaviorHTML_Self', strlen( $meta[ 'styles' ][ 'behavior-html-self' ] ) > 0 ? $meta[ 'styles' ][ 'behavior-html-self' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'tl' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTL_Self', strlen( $meta[ 'header' ][ 'behavior-tl-self' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tl-self' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'tr' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorTR_Self', strlen( $meta[ 'header' ][ 'behavior-tr-self' ] ) > 0 ? $meta[ 'header' ][ 'behavior-tr-self' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'ml' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorML_Self', strlen( $meta[ 'header' ][ 'behavior-ml-self' ] ) > 0 ? $meta[ 'header' ][ 'behavior-ml-self' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'mr' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorMR_Self', strlen( $meta[ 'header' ][ 'behavior-mr-self' ] ) > 0 ? $meta[ 'header' ][ 'behavior-mr-self' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'bl' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBL_Self', strlen( $meta[ 'header' ][ 'behavior-bl-self' ] ) > 0 ? $meta[ 'header' ][ 'behavior-bl-self' ] : $default_val ).'</td></tr>';
		$html[ 'header' ][ 'br' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Header_BehaviorBR_Self', strlen( $meta[ 'header' ][ 'behavior-br-self' ] ) > 0 ? $meta[ 'header' ][ 'behavior-br-self' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 't' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorT_Self', strlen( $meta[ 'content' ][ 'behavior-t-self' ] ) > 0 ? $meta[ 'content' ][ 'behavior-t-self' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'l' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorL_Self', strlen( $meta[ 'content' ][ 'behavior-l-self' ] ) > 0 ? $meta[ 'content' ][ 'behavior-l-self' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'c' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorC_Self', strlen( $meta[ 'content' ][ 'behavior-c-self' ] ) > 0 ? $meta[ 'content' ][ 'behavior-c-self' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'r' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorR_Self', strlen( $meta[ 'content' ][ 'behavior-r-self' ] ) > 0 ? $meta[ 'content' ][ 'behavior-r-self' ] : $default_val ).'</td></tr>';
		$html[ 'content' ][ 'b' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Content_BehaviorB_Self', strlen( $meta[ 'content' ][ 'behavior-b-self' ] ) > 0 ? $meta[ 'content' ][ 'behavior-b-self' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'tl' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTL_Self', strlen( $meta[ 'footer' ][ 'behavior-tl-self' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tl-self' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'tr' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorTR_Self', strlen( $meta[ 'footer' ][ 'behavior-tr-self' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-tr-self' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'ml' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorML_Self', strlen( $meta[ 'footer' ][ 'behavior-ml-self' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-ml-self' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'mr' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorMR_Self', strlen( $meta[ 'footer' ][ 'behavior-mr-self' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-mr-self' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'bl' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBL_Self', strlen( $meta[ 'footer' ][ 'behavior-bl-self' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-bl-self' ] : $default_val ).'</td></tr>';
		$html[ 'footer' ][ 'br' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Footer_BehaviorBR_Self', strlen( $meta[ 'footer' ][ 'behavior-br-self' ] ) > 0 ? $meta[ 'footer' ][ 'behavior-br-self' ] : $default_val ).'</td></tr>';
		$html[ 'scripts' ][ 'html' ] .= '<tr><th><strong>Self:</strong></th><td>'.Grafik_MetaboxBehavior( 'Grafik_Functions_Metabox_Scripts_BehaviorHTML_Self', strlen( $meta[ 'scripts' ][ 'behavior-html-self' ] ) > 0 ? $meta[ 'scripts' ][ 'behavior-html-self' ] : $default_val ).'</td></tr>';
		$default_val ++;

		echo
		'<div class="grafik-metabox">'.
			'<h3>Styles</h3>'.
			'<table>'.
				'<tr>'.
					'<td><strong>HTML:</strong><textarea name="Grafik_Functions_Metabox_Styles_HTML">'.Grafik_PrefillTextarea( $meta[ 'styles' ][ 'html' ] ).'</textarea><table>'.$html[ 'styles' ][ 'html' ].'</table></td>'.
				'</tr>'.
			'</table>'.
			'<h3>Header</h3>'.
			'<table>'.
				'<tr>'.
					'<td><strong>Top Left:</strong><textarea name="Grafik_Functions_Metabox_Header_TL">'.Grafik_PrefillTextarea( $meta[ 'header' ][ 'tl' ] ).'</textarea><table>'.$html[ 'header' ][ 'tl' ].'</table></td>'.
					'<td><strong>Top Right:</strong><textarea name="Grafik_Functions_Metabox_Header_TR">'.Grafik_PrefillTextarea( $meta[ 'header' ][ 'tr' ] ).'</textarea><table>'.$html[ 'header' ][ 'tr' ].'</table></td>'.
				'</tr>'.
				'<tr>'.
					'<td><strong>Middle Left:</strong><textarea name="Grafik_Functions_Metabox_Header_ML">'.Grafik_PrefillTextarea( $meta[ 'header' ][ 'ml' ] ).'</textarea><table>'.$html[ 'header' ][ 'ml' ].'</table></td>'.
					'<td><strong>Middle Right:</strong><textarea name="Grafik_Functions_Metabox_Header_MR">'.Grafik_PrefillTextarea( $meta[ 'header' ][ 'mr' ] ).'</textarea><table>'.$html[ 'header' ][ 'mr' ].'</table></td>'.
				'</tr>'.
				'<tr>'.
					'<td><strong>Bottom Left:</strong><textarea name="Grafik_Functions_Metabox_Header_BL">'.Grafik_PrefillTextarea( $meta[ 'header' ][ 'bl' ] ).'</textarea><table>'.$html[ 'header' ][ 'bl' ].'</table></td>'.
					'<td><strong>Bottom Right:</strong><textarea name="Grafik_Functions_Metabox_Header_BR">'.Grafik_PrefillTextarea( $meta[ 'header' ][ 'br' ] ).'</textarea><table>'.$html[ 'header' ][ 'br' ].'</table></td>'.
				'</tr>'.
			'</table>'.
			'<h3>Content</h3>'.
			'<table>'.
				'<tr>'.
					'<td colspan="3"><strong>Top:</strong><textarea name="Grafik_Functions_Metabox_Content_T">'.Grafik_PrefillTextarea( $meta[ 'content' ][ 't' ] ).'</textarea><table>'.$html[ 'content' ][ 't' ].'</table></td>'.
				'</tr>'.
				'<tr>'.
					'<td style="width:25%"><strong>Left:</strong><textarea name="Grafik_Functions_Metabox_Content_L">'.Grafik_PrefillTextarea( $meta[ 'content' ][ 'l' ] ).'</textarea><table>'.$html[ 'content' ][ 'l' ].'</table></td>'.
					'<td style="width:50%"><strong>Center:</strong><textarea name="Grafik_Functions_Metabox_Content_C">'.Grafik_PrefillTextarea( $meta[ 'content' ][ 'c' ] ).'</textarea><table>'.$html[ 'content' ][ 'c' ].'</table></td>'.
					'<td style="width:25%"><strong>Right:</strong><textarea name="Grafik_Functions_Metabox_Content_R">'.Grafik_PrefillTextarea( $meta[ 'content' ][ 'r' ] ).'</textarea><table>'.$html[ 'content' ][ 'r' ].'</table></td>'.
				'</tr>'.
				'<tr>'.
					'<td colspan="3"><strong>Bottom:</strong><textarea name="Grafik_Functions_Metabox_Content_B">'.Grafik_PrefillTextarea( $meta[ 'content' ][ 'b' ] ).'</textarea><table>'.$html[ 'content' ][ 'b' ].'</table></td>'.
				'</tr>'.
			'</table>'.
			'<h3>Footer</h3>'.
			'<table>'.
				'<tr>'.
					'<td><strong>Top Left:</strong><textarea name="Grafik_Functions_Metabox_Footer_TL">'.Grafik_PrefillTextarea( $meta[ 'footer' ][ 'tl' ] ).'</textarea><table>'.$html[ 'footer' ][ 'tl' ].'</table></td>'.
					'<td><strong>Top Right:</strong><textarea name="Grafik_Functions_Metabox_Footer_TR">'.Grafik_PrefillTextarea( $meta[ 'footer' ][ 'tr' ] ).'</textarea><table>'.$html[ 'footer' ][ 'tr' ].'</table></td>'.
				'</tr>'.
				'<tr>'.
					'<td><strong>Middle Left:</strong><textarea name="Grafik_Functions_Metabox_Footer_ML">'.Grafik_PrefillTextarea( $meta[ 'footer' ][ 'ml' ] ).'</textarea><table>'.$html[ 'footer' ][ 'ml' ].'</table></td>'.
					'<td><strong>Middle Right:</strong><textarea name="Grafik_Functions_Metabox_Footer_MR">'.Grafik_PrefillTextarea( $meta[ 'footer' ][ 'mr' ] ).'</textarea><table>'.$html[ 'footer' ][ 'mr' ].'</table></td>'.
				'</tr>'.
				'<tr>'.
					'<td><strong>Bottom Left:</strong><textarea name="Grafik_Functions_Metabox_Footer_BL">'.Grafik_PrefillTextarea( $meta[ 'footer' ][ 'bl' ] ).'</textarea><table>'.$html[ 'footer' ][ 'bl' ].'</table></td>'.
					'<td><strong>Bottom Right:</strong><textarea name="Grafik_Functions_Metabox_Footer_BR">'.Grafik_PrefillTextarea( $meta[ 'footer' ][ 'br' ] ).'</textarea><table>'.$html[ 'footer' ][ 'br' ].'</table></td>'.
				'</tr>'.
			'</table>'.
			'<h3>Scripts</h3>'.
			'<table>'.
				'<tr>'.
					'<td><strong>HTML:</strong><textarea name="Grafik_Functions_Metabox_Scripts_HTML">'.Grafik_PrefillTextarea( $meta[ 'scripts' ][ 'html' ] ).'</textarea><table>'.$html[ 'scripts' ][ 'html' ].'</table></td>'.
				'</tr>'.
			'</table>'.
			wp_nonce_field( 'Grafik_Functions_Metabox_Nonce', 'Grafik_Functions_Metabox_Nonce', true, false ).
		'</div>';

	}

?>