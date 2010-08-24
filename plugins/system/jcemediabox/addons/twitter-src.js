/**
 * @version		$Id: twitter.js 489 2010-01-23 07:57:05Z happynoodleboy $
 * @package		JCE MediaBox
 * @copyright	Copyright (C) 2009 - 2010 Ryan Demmer. All rights reserved.
 * @license		GNU/GPL
 * This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
JCEMediaBox.Popup.setAddons('flash', {
	/**
	 * Twitvid - http://www.twitvid.com
	 * @param {String} v URL
	 */
	twitvid: function(v) {
		if (/twitvid(.+)\/(.+)/.test(v)) {
			
			var s = 'http://www.twitvid.com/player/';
			
			return {
				width: 425,
				height: 344,
				type: 'flash',
				'allowFullScreen' : true,
				'allowscriptaccess' : 'always',
				'allowNetworking' : 'all',
				'wmode': 'transparent',
				'src': v.replace(/(.+)twitvid([^\/]+)\/(.+)/, function(a, b, c, d){
					return s + d;
				})
			};
		}
	}
});
JCEMediaBox.Popup.setAddons('image', {
	/**
	 * Twitpic - http://www.twitpic.com
	 * @param {String} v URL
	 */
	twitpic: function(v) {
		if (/twitpic(.+)\/(.+)/.test(v)) {
			return {
				type : 'image'
			};
		}
	}
});