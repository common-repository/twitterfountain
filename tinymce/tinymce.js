function init() {

	tinyMCEPopup.resizeToInnerSize();
	
	ed = tinyMCEPopup.editor;
	fe = ed.selection.getNode();
	
	document.getElementById('bgcolor_pickcontainer').innerHTML = getColorPickerHTML('bgcolor_pick','bgcolor');
	
	if (/mceItem(Flash)/.test(ed.dom.getAttrib(fe, 'class'))) {

		pl = tinyMCEPopup.editor.plugins.tf._parse(fe.title);
		qs = parseStr(pl.src);
		
		document.getElementById('twitter').value = qs.fv_event;
		document.getElementById('flickr').value = qs.fv_flickr;
		document.getElementById('bgcolor').value = '#' + qs.fv_kleur;
		document.getElementById('width').value = ed.dom.getAttrib(fe, 'width');
		document.getElementById('height').value = ed.dom.getAttrib(fe, 'height');
				
	}
	
	updateColor('bgcolor_pick', 'bgcolor');
	
}

function insertMedia() {
	
	var tf = document.getElementById('tf_panel');
	
	if (tf.className.indexOf('current') != -1) {
		
		var twitter = document.getElementById('twitter').value;
		var flickr = document.getElementById('flickr').value;
		var color = document.getElementById('bgcolor').value;
		var width = document.getElementById('width').value;
		var height = document.getElementById('height').value;
		
		if ((twitter != '') && (flickr != '') && (color != '') && (width != '') && (height != '')) {
			
			color = color.replace(/^#+/,"");
			
			var tagText = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-4445535100%00" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="' + width + '" height="' + height + '" align="middle">';
			tagText += '<param name="allowScriptAccess" value="always" />';
			tagText += '<param name="allowFullScreen" value="true" />';
			tagText += '<param name="menu" value="false" />';
			tagText += '<param name="quality" value="high" />';
			tagText += '<param name="scale" value="noscale" />';
			tagText += '<param name="salign" value="lt" />';
			tagText += '<param name="bgcolor" value="#DC1689" />';
			tagText += '<param name="movie" value="http://www.twitterfountain.nl/twitterfountain.swf?fv_event=' + twitter + '&fv_flickr=' + flickr + '&fv_kleur=' + color + '" />';
			tagText += '<embed src="http://www.twitterfountain.nl/twitterfountain.swf?fv_event=' + twitter + '&fv_flickr=' + flickr + '&fv_kleur=' + color + '" menu="false" quality="high" scale="noscale" salign="lt" bgcolor="#DC1689" width="' + width + '" height="' + height + '" align="middle" allowScriptAccess="always" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
			tagText += '</object>';

		}
		
		else {
			tinyMCEPopup.close();
		}
		
	}
	
	if (window.tinyMCE) {
		
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagText);
		tinyMCEPopup.editor.execCommand('mceCleanup');
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
		
	}
	
	return;	

}

function parseStr(str) {

	var qArray = new Object();
	var q = str.substring((str.indexOf('?') + 1));
	var params = q.split('&');

	for (var i = 0; i < params.length; i++) {
		var tempArray = params[i].split('=');
		qArray[tempArray[0]] = tempArray[1];
	}
	
	return qArray;

}

tinyMCEPopup.onInit.add(init);