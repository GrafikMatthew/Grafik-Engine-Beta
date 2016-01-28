<?php

	function Grafik_Shortcode_NavList_Callback( $atts ) {

		global $GRAFIK_ID;

		$a = shortcode_atts( array(
			'authors' => '',
			'child_of' => 0,
			'date_format' => get_option( 'date_format' ),
			'depth' => 1,
			'echo' => 0,
			'exclude' => '',
			'include' => '',
			'link_after' => '',
			'link_before' => '',
			'post_type' => 'page',
			'post_status' => 'publish',
			'show_date' => '',
			'sort_column' => 'menu_order, post_title',
			'sort_order' => '',
			'title_li' => '',
			'walker' => new Walker_Page,
			'external' => '',
			'external_target' => '_blank',
			'class' => '',
			'id' => ''
		), $atts );

		$class = $a['class'];
		$id = $a['id'];
		unset( $a['class'], $a['id'] );

		switch( $a['child_of'] ) {

			case 'home':
				$a['child_of'] = get_option( 'page_on_front' );
				break;

			case 'current':
				$a['child_of'] = $GRAFIK_ID;
				break;

			case 'parent':
				$a['child_of'] = wp_get_post_parent_id( $GRAFIK_ID );
				break;

			case 'primary':
				$ancestors = get_post_ancestors( $GRAFIK_ID );
				if( empty( $ancestors ) || count( $ancestors ) < 1 ) {
					$a['child_of'] = $GRAFIK_ID;
				} else {
					$a['child_of'] = $ancestors[count( $ancestors ) - 1];
				}
				break;

			case 'secondary':
				$ancestors = get_post_ancestors( $GRAFIK_ID );
				if( empty( $ancestors ) || count( $ancestors ) < 2 ) {
					$a['child_of'] = $GRAFIK_ID;
				} else {
					$a['child_of'] = $ancestors[count( $ancestors ) - 2];
				}
				break;

			case 'tertiary':
				$ancestors = get_post_ancestors( $GRAFIK_ID );
				if( empty( $ancestors ) || count( $ancestors ) < 3 ) {
					$a['child_of'] = $GRAFIK_ID;
				} else {
					$a['child_of'] = $ancestors[count( $ancestors ) - 3];
				}
				break;

			case 'quaternary':
				$ancestors = get_post_ancestors( $GRAFIK_ID );
				if( empty( $ancestors ) || count( $ancestors ) < 4 ) {
					$a['child_of'] = $GRAFIK_ID;
				} else {
					$a['child_of'] = $ancestors[count( $ancestors ) - 4];
				}
				break;

			case 'quinary':
				$ancestors = get_post_ancestors( $GRAFIK_ID );
				if( empty( $ancestors ) || count( $ancestors ) < 5 ) {
					$a['child_of'] = $GRAFIK_ID;
				} else {
					$a['child_of'] = $ancestors[count( $ancestors ) - 5];
				}
				break;

		}

		$external_links = array();
		if( !empty( $a['external'] ) ) {
			$external = explode( '|', $a['external'] );
			foreach( $external as $link ) {

				$link_array = explode( ' ', $link );

				$link_url = array_shift( $link_array );
				$link_text = implode( ' ', $link_array );

				$external_links[] =
				'<li>'.
					'<a href="'.$link_url.'"'.( empty( $a['external_target'] ) ? null : ' target="'.$a['external_target'].'"' ).'>'.$link_text.'</a>'.
				'</li>';

			}
		}

		return
		// '<!-- '.print_r($a, true).' -->'.
		'<div class="theme-navlist'.( empty( $class ) ? null : ' '.$class ).'"'.( empty( $id ) ? null : ' id="'.$id.'"' ).'>'.
			'<ul>'.
				implode( '', explode( "\n", wp_list_pages( $a ) ) ).
				( empty( $external_links ) ? null : implode( '', $external_links ) ).
			'</ul>'.
		'</div>';

	}
	add_shortcode( "NavList", "Grafik_Shortcode_NavList_Callback" );

?>