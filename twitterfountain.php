<?php

/*
Plugin Name: Twitterfountain
Plugin URI: http://www.twitterfountain.nl/
Description: Twitterfountain mashes up <a href="http://www.twitter.com/">tweets</a> and <a href="http://www.flickr.com/">Flickr</a>-images that share the same tags into a spectacular visual. This plugin allows you to easily embed a Twitterfountain in a post or page through your visual editor or add a Twitterfountain widget to your sidebar.
Author: 4rn0
Version: 1.0
Author URI: http://www.4rn0.nl/
*/

function tf_widget() {
	
	$options = get_option('widget_tf');

	if (!is_array($options)) {

		$options = array(
			'twitter'	=>		'twitterfountain',
			'flickr'		=>		'wordpress',
			'color'		=>		'#ff99cc',
			'width'		=>		'400',
			'height'		=>		'300'
		);
		
	}
	
	$options['color'] = ltrim($options['color'], '#');
	
	echo '<li class="widget widget_tf">' . "\n";
	echo "\t" . '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-4445535100%00" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="' . $options['width'] . '" height="' . $options['height'] . '" align="middle">' . "\n";
	echo "\t\t" . '<param name="allowScriptAccess" value="always" />' . "\n";
	echo "\t\t" . '<param name="allowFullScreen" value="true" />' . "\n";
	echo "\t\t" . '<param name="menu" value="false" />' . "\n";
	echo "\t\t" . '<param name="quality" value="high" />' . "\n";
	echo "\t\t" . '<param name="scale" value="noscale" />' . "\n";
	echo "\t\t" . '<param name="salign" value="lt" />' . "\n";
	echo "\t\t" . '<param name="bgcolor" value="#DC1689" />' . "\n";
	echo "\t\t" . '<param name="movie" value="http://www.twitterfountain.nl/twitterfountain.swf?fv_event=' . $options['twitter'] . '&fv_flickr=' . $options['flickr'] . '&fv_kleur=' . $options['color'] . '" />' . "\n";
	echo "\t\t" . '<embed src="http://www.twitterfountain.nl/twitterfountain.swf?fv_event=' . $options['twitter'] . '&fv_flickr=' . $options['flickr'] . '&fv_kleur=' . $options['color'] . '" menu="false" quality="high" scale="noscale" salign="lt" bgcolor="#DC1689" width="' . $options['width'] . '" height="' . $options['height'] . '" align="middle" allowScriptAccess="always" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>' . "\n";
	echo "\t" . '</object>' . "\n";
	echo '</li>' . "\n";
	
}

function tf_widget_control() {

	$options = get_option('widget_tf');
		
	if (!is_array($options)) {

		$options = array(
			'twitter'	=>		'twitterfountain',
			'flickr'		=>		'wordpress',
			'color'		=>		'#ff99cc',
			'width'		=>		'400',
			'height'		=>		'300'
		);
		
	}
	
	if ($_POST['tf_widget_submit']) {
		
		$options = array(
			'twitter'	=>		htmlentities($_POST['widget_tf_twitter'], ENT_NOQUOTES, 'UTF-8'),
			'flickr'		=>		htmlentities($_POST['widget_tf_flickr'], ENT_NOQUOTES, 'UTF-8'),
			'color'		=>		htmlentities($_POST['widget_tf_color'], ENT_NOQUOTES, 'UTF-8'),
			'width'		=>		htmlentities($_POST['widget_tf_width'], ENT_NOQUOTES, 'UTF-8'),
			'height'		=>		htmlentities($_POST['widget_tf_height'], ENT_NOQUOTES, 'UTF-8'),
		);
		
		update_option('widget_tf', $options);

	}

	echo '<p>' . "\n";
	echo "\t" . '<label for="widget_tf_twitter">Show tweets containing:</label>' . "\n";
	echo "\t" . '<input type="text" class="widefat" id="widget_tf_twitter" name="widget_tf_twitter" value="' . $options['twitter'] . '" />' . "\n";
	echo '</p>' . "\n";
	echo '<p>' . "\n";
	echo "\t" . '<label for="widget_tf_flickr">Show Flickr photos of:</label>' . "\n";
	echo "\t" . '<input type="text" class="widefat" id="widget_tf_flickr" name="widget_tf_flickr" value="' . $options['flickr'] . '" />' . "\n";
	echo '</p>' . "\n";
	echo '<p>' . "\n";
	echo "\t" . '<label for="widget_tf_color" style="float: left; margin-top: 7px; width: 50px;">Color:</label>' . "\n";
	echo "\t" . '<input type="text" id="widget_tf_color" name="widget_tf_color" value="' . $options['color'] . '" style="width: 50px;" />' . "\n";
	echo '</p>' . "\n";
	echo '<p>' . "\n";
	echo "\t" . '<label for="widget_tf_width" style="float: left; margin-top: 7px; width: 50px;">Width:</label>' . "\n";
	echo "\t" . '<input type="text" id="widget_tf_width" name="widget_tf_width" value="' . $options['width'] . '" style="width: 50px;" />' . "\n";
	echo '</p>' . "\n";
	echo '<p>' . "\n";
	echo "\t" . '<label for="widget_tf_height" style="float: left; margin-top: 7px; width: 50px;">Height:</label>' . "\n";
	echo "\t" . '<input type="text" id="widget_tf_height" name="widget_tf_height" value="' . $options['height'] . '" style="width: 50px;" />' . "\n";
	echo '</p>' . "\n";
	
	echo "\t" . '<input type="hidden" id="tf_widget_submit" name="tf_widget_submit" value="1" />' . "\n";

}

function init_tf() {
	
	include_once(dirname(__FILE__) . '/tinymce/tinymce.php');
	
	register_sidebar_widget('Twitterfountain', 'tf_widget');
	register_widget_control('Twitterfountain', 'tf_widget_control');
	
}

add_action('plugins_loaded', 'init_tf');

?>