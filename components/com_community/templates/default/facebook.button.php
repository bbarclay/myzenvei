<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
 
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
?>

<!-- begin: COMMUNITY_FREE_VERSION -->
<?php if( !COMMUNITY_FREE_VERSION ) { ?>
	<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		FB_RequireFeatures(["XFBML"], function() {
			FB.Facebook.init( "<?php echo $config->get('fbconnectkey');?>" , "<?php echo CRoute::_('index.php?option=com_community&view=connect&task=receiver&tmpl=component');?>");
		});
	});
	
	function FBLogin()
	{
	    FB.Facebook.get_sessionState().waitUntilReady(
	            function() {
	            	joms.connect.update();
	            });
	}
	</script>
	<div class="community-facebook-button">
		<div class="white">
			<a href="#" onclick="FB.Connect.requireSession();FBLogin(); return false;" class="fbconnect_login_button FBConnectButton FBConnectButton_Large"><span id="RES_ID_fb_login_text" class="FBConnectButton_Text"><?php echo JText::_('CC CONNECT WITH FACEBOOK');?></span></a>
		</div>
	</div>
<?php } ?>
<!-- end: COMMUNITY_FREE_VERSION -->
