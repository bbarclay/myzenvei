{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<script type="text/javascript" src="{$JURL}/components/com_hwdphotoshare/assets/js/swfobject.js"></script>
{literal}
<style type="text/css">	
	/* hide from ie on mac \*/
	html {
		height: 100%;
		overflow: hidden;
	}	
	#flashcontent {
		height: 100%;
	}
	/* end hide */
	body {
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #181818;
		color:#ffffff;
		font-family:sans-serif;
		font-size:40;
	}	
	a {	
		color:#cccccc;
	}
</style>
{/literal}
</head>
<body>
	<div id="flashcontent">AutoViewer requires JavaScript and the Flash Player. <a href="http://www.macromedia.com/go/getflashplayer/">Get Flash here.</a> </div>	
	<script type="text/javascript">
		var fo = new SWFObject("{$JURL}/plugins/hwdps-slideshow/autoviewer.swf", "autoviewer", "100%", "100%", "8", "#181818");		
				
		//Optional Configuration
		//fo.addVariable("langOpenImage", "Open Image in New Window");
		//fo.addVariable("langAbout", "About");	
		fo.addVariable("xmlURL", "{$JURL}/components/com_hwdphotoshare/xml/albums/{$slideshow_folder}/{$album_id}.xml");					
		
		fo.write("flashcontent");	
		
	</script>	
</body>
</html>