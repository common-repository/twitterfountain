(function() {
	
	tinymce.create('tinymce.plugins.tf', {

		init : function(ed, url) {

         function isMediaElm(n) {
             return /^(mceItemFlash)$/.test(n.className);
         };

			ed.addCommand('mcetf', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 400 + ed.getLang('tf.delta_width', 0),
					height : 300 + ed.getLang('tf.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addButton('tf', {
				title : 'Insert a Twitterfountain',
				cmd 	: 'mcetf',
				image : url + '/twitterfountain.png'
			});

			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('tf', n.nodeName == 'IMG' && isMediaElm(n));
			});
			
		},

		createControl : function(n, cm) {
			return null;
		},

		getInfo : function() {
			return {
					longname  : 'Twitterfountain',
					author 	 : '4rn0',
					authorurl : 'http://www.4rn0.nl/',
					infourl   : 'http://www.twitterfountain.nl/',
					version   : "1.0"
			};
		},
		
      _parse: function(s) {
          return tinymce.util.JSON.parse('{' + s + '}');
      }

	});

	tinymce.PluginManager.add('tf', tinymce.plugins.tf);
	
})();