<?php
/**
 * @package		JomSocial
 * @subpackage 	Template 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 * 
 * 
 */
defined('_JEXEC') or die();
?>


<a href="<?php echo $params['flv'] ?>" style="display: block; width:<?php echo $video->getWidth() ?>px; height:<?php echo $video->getHeight() ?>px; position: relative;" id="player">
</a>


<script type="text/javascript">
	flowplayer("player", {src: "<?php echo $params['swf'] ?>", wmode:'opaque' }, 
		{
		    key: '<?php echo $params['key'] ?>',
			
		    playlist: [
				{
					url: '<?php echo $video->getThumbnail(); ?>', 
                	scaling: 'scale'
				},
				{
					url: '<?php echo $params['flv'] ?>',
			    	title: '<?php echo JString::str_ireplace("'", "", $video->title); ?>',
			        autoPlay: false,
			        autoBuffering: true,
			        provider: 'lighttpd',
			        scaling: "scale",
				} 
			],
	
		    plugins: {
		        lighttpd: {
		            url: '<?php echo $params['plugin'] ?>',
		            queryString: escape('?start=${start}')
		        }
		    }
		    
		}
	);
</script>
