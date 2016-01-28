<?php

	#
	# YOAST INTEGRATION
	#
	if(is_admin()) {
		add_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast');
		function add_custom_to_yoast($content) {
			global $post;
			$pid = $post->ID;
			$custom = get_post_custom($pid);
			unset($custom['_yoast_wpseo_focuskw']);
			foreach($custom as $key => $value) {
				if(substr($key,0,1) != '_' && substr($value[0],-1) != '}' && !is_array($value[0]) && !empty($value[0])) {
					$custom_content .= $value[0].' ';
				}
			}
			$content = $content.' '.$custom_content;
			return $content;
			remove_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast');
		}
	}

?>