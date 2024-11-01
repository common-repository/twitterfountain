<?php

$wpconfig = realpath("../../../../wp-config.php");

if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}

require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');

if(!current_user_can('edit_posts')) die;

global $wpdb;

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Twitterfountain</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/twitterfountain/tinymce/tinymce.js"></script>
	<base target="_self" />
</head>
<body style="display: none">

	<form onsubmit="insertMedia();return false;" action="#">
	<div class="tabs">
		<ul>
			<li id="tf_tab" class="current"><span><a href="javascript:mcTabs.displayTab('tf_tab','tf_panel');" onmousedown="return false;"><?php _e("Settings", 'tf'); ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper" style="height: auto;">
		<div id="tf_panel" class="panel current" style="height: auto;">
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="twitter"><?php _e("Show tweets containing:", 'tf'); ?></label></td>
            <td colspan="2"><input id="twitter" name="twitter" style="width: 180px" value="" /></td>
         </tr>
         <tr>
            <td nowrap="nowrap"><label for="flickr"><?php _e("Show Flickr photos of:", 'tf'); ?></label></td>
            <td colspan="2"><input id="flickr" name="flickr" style="width: 180px" value="" /></td>
          </tr>
         <tr>
            <td><label for="bgcolor"><?php _e("Color:", 'tf'); ?></label></td>
            <td width="50"><input id="bgcolor" name="bgcolor" style="width: 50px" value="" onchange="updateColor('bgcolor_pick','bgcolor');" /></td>
				<td id="bgcolor_pickcontainer">&nbsp;</td>
          </tr>
         <tr>
            <td><label for="width"><?php _e("Width:", 'tf'); ?></label></td>
            <td colspan="2"><input id="width" name="width" style="width: 50px" value="" /></td>
          </tr>
         <tr>
            <td><label for="height"><?php _e("Height:", 'tf'); ?></label></td>
            <td colspan="2"><input id="height" name="height" style="width: 50px" value="" /></td>
          </tr>
        </table>
		</div>
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'tf'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'tf'); ?>" onclick="insertMedia();" />
		</div>
	</div>
</form>
</body>
</html>
