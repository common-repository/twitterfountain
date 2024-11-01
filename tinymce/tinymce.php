<?php

function tf_addbuttons() {

	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
	 
	if ( get_user_option('rich_editing') == 'true') {
	 
		add_filter("mce_external_plugins", "add_tf_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_tf_button', 5);
	}
	
}

function register_tf_button($buttons) {

	array_push($buttons, "separator", "tf");
	return $buttons;
	
}

function add_tf_tinymce_plugin($plugin_array) {    

	$plugin_array['tf'] = get_option('siteurl') . '/wp-content/plugins/twitterfountain/tinymce/editor_plugin.js';
	return $plugin_array;
	
}

function tf_change_tinymce_version($version) {
	return ++$version;
}

add_filter('tiny_mce_version', 'tf_change_tinymce_version');
add_action('init', 'tf_addbuttons');

?>