
 
  <link rel="stylesheet" href="/plugins/system/jcemediabox/css/jcemediabox.css?v=105" type="text/css" /> 
  <link rel="stylesheet" href="/plugins/system/jcemediabox/themes/light/css/style.css?version=105" type="text/css" /> 
  <link rel="stylesheet" href="/media/system/css/modal.css" type="text/css" /> 
  <link rel="stylesheet" href="http://www.myzenvei.com/components/com_k2/css/k2.css" type="text/css" /> 
  <link rel="stylesheet" href="/plugins/system/rokbox/themes/light/rokbox-style.css" type="text/css" /> 
  <script type="text/javascript" src="/plugins/system/jcemediabox/js/mediaobject.js?v=105"></script> 
  <script type="text/javascript" src="/plugins/system/jcemediabox/js/jcemediabox.js?v=105"></script> 
  <script type="text/javascript" src="/plugins/system/jcemediabox/addons/default.js?v=105"></script> 
  <script type="text/javascript" src="/plugins/system/jcemediabox/addons/twitter.js?v=105"></script> 
   
  
  <script type="text/javascript" src="/plugins/system/rokbox/rokbox.js"></script> 
  <script type="text/javascript" src="/plugins/content/avreloaded/silverlight.js"></script> 
  <script type="text/javascript" src="/plugins/content/avreloaded/wmvplayer.js"></script> 
  <script type="text/javascript" src="/plugins/content/avreloaded/swfobject.js"></script> 
  <script type="text/javascript" src="/plugins/content/avreloaded/avreloaded.js"></script> 
  <script type="text/javascript"> 
	JCEMediaObject.init('/', {flash:"10,0,22,87",windowmedia:"5,1,52,701",quicktime:"6,0,2,0",realmedia:"7,0,0,0",shockwave:"8,5,1,0"});JCEMediaBox.init({popup:{width:"",height:"",legacy:0,resize:1,icons:1,overlay:1,overlayopacity:0.8,overlaycolor:"#000000",fadespeed:500,scalespeed:500,hideobjects:0,scrolling:"fixed",labels:{'close':'Close','next':'Next','previous':'Previous','cancel':'Cancel','numbers':'{$current} of {$total}'}},tooltip:{className:"tooltip",opacity:0.8,speed:150,position:"br",offsets:{x: 16, y: 16}},base:"/",imgpath:"plugins/system/jcemediabox/img",theme:"light",themecustom:"",themepath:"plugins/system/jcemediabox/themes"});
 
		window.addEvent('domready', function() {
 
			SqueezeBox.initialize({});
 
			$$('a.modal').each(function(el) {
				el.addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox.fromElement(el);
				});
			});
		});
var K2RatingURL = 'http://www.zenvei.com/';
var rokboxPath = '/plugins/system/rokbox/';
 
		if (typeof(RokBox) !== 'undefined') {
			window.addEvent('domready', function() {
				var rokbox = new RokBox({
					'className': 'rokbox',
					'theme': 'light',
					'transition': Fx.Transitions.Quad.easeOut,
					'duration': 200,
					'chase': 40,
					'frame-border': 20,
					'content-padding': 0,
					'arrows-height': 35,
					'effect': 'quicksilver',
					'captions': 1,
					'captionsDelay': 800,
					'scrolling': 0,
					'keyEvents': 1,
					'overlay': {
						'background': '#000000',
						'opacity': 0.85,
						'duration': 200,
						'transition': Fx.Transitions.Quad.easeInOut
					},
					'defaultSize': {
						'width': 640,
						'height': 460
					},
					'autoplay': '1',
					'controller': 'true',
					'bgcolor': '#f3f3f3',
					'youtubeAutoplay': 0,
					'youtubeHighQuality': 0,
					'vimeoColor': '00adef',
					'vimeoPortrait': 0,
					'vimeoTitle': 0,
					'vimeoFullScreen': 1,
					'vimeoByline': 0
				});
			});
		};
  </script> 
