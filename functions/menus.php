<?php

	/*

	888888o. 888888 8888o. 88  88 .o8888    8888o. 88  88 8888o.
	88 88 88 88     88  88 88  88 88        88  88 88  88 88  88
	88 88 88 8888   88  88 88  88 'Y88o.    8888Y' 888888 8888Y'
	88 88 88 88     88  88 88  88     88    88     88  88 88    
	88 88 88 888888 88  88 'Y88Y' 8888Y' 88 88     88  88 88    

	*/

	if( !defined('ABSPATH') ) exit;

	function Grafik_Menus_GetHTML( $key, $html = '{{ MENU }}' ) {
		$menu = str_replace("\n", "", wp_nav_menu( array(
			'theme_location' => $key,
			'menu_id' => 'Menu_'.$key,
			'menu_class' => 'GE-Theme-Menu',
			'container' => false,
			'fallback_cb' => null,
			'echo' => false
		) ) );
		return str_replace( '{{ MENU }}', $menu, $html );
	}
