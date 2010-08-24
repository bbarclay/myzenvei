<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 *
 */
defined('_JEXEC') or die();

$view 			= JRequest::getVar('view', 'frontpage', 'REQUEST');
$groupKey		= $customToolbar->getToolBarGroupKey();
$toolbarClass	= array();
//$toolbarClass = array('frontpage'=> '', 'profile' => '', 'friends'=>'', 'apps'=>'', 'inbox'=>'', 'notify' => '', 'extra' => '' );
//$toolbarClass = array_fill_keys($groupKey, '');

if(! empty($groupKey))
{
	$emptyArr		= array_fill(0, count($groupKey), '');
	$toolbarClass	= array_combine($groupKey, $emptyArr);
}

$uri			= JRequest::getUri();
$activeToolbar	= $customToolbar->getActiveToolBarGroup($uri);

/**
 * If cannot locate the uri string, then we use view to determine.
 */ 
if(empty($activeToolbar))
{	
	$activeToolbar	= $customToolbar->getGroupActiveView($view);
}

$toolbarClass[$activeToolbar] = 'toolbar-active';
if(! empty($toolbarClass[TOOLBAR_PROFILE]))
	$toolbarClass[TOOLBAR_PROFILE] = (!$isMine && $activeToolbar == TOOLBAR_PROFILE) ? '':$toolbarClass[TOOLBAR_PROFILE]; 
?>

<script type="text/javascript" src="<?php echo JURI::root(); ?>components/com_community/templates/blackout/js/script.js"></script>

<div id="cToolbar">
	<ul class="toolbar-items">
		<?php if( $config->get('displayhome') )	{ 
				if(isset($customToolbar) && !empty($customToolbar)){
					if($customToolbar->hasToolBarGroup(TOOLBAR_HOME)){
						$homeItem	= $customToolbar->getToolbarItems(TOOLBAR_HOME);		
		?>
	    <li id="toolbar-item-frontpage" class="<?php echo $toolbarClass[TOOLBAR_HOME]; ?> toolbar-item">
			<a href="<?php echo $homeItem->link; ?>" onmouseover="joms.toolbar.open('m0')" onmouseout="joms.toolbar.closetime()">
				<span><?php echo $homeItem->caption; ?></span>
			</a>			
        	<?php
				if(!empty($homeItem) && (!empty($homeItem->child['append']) || !empty($homeItem->child['prepend'])))
				{
					echo '<div id="m0" onmouseover="joms.toolbar.cancelclosetime()" onmouseout="joms.toolbar.closetime()">';
					echo $customToolbar->getMenuItems(TOOLBAR_HOME, 'all');
					echo '</div>';		
				}
        	?>			
		</li>
		<?php 
				}
			}
		}
		?>
		<?php
			if(isset($customToolbar) && !empty($customToolbar)){
				if($customToolbar->hasToolBarGroup(TOOLBAR_PROFILE)){
					$profileItem	= $customToolbar->getToolbarItems(TOOLBAR_PROFILE);
		?>				
	    <li id="toolbar-item-profile" class="<?php echo $toolbarClass[TOOLBAR_PROFILE]; ?> toolbar-item">
			<a href="<?php echo $profileItem->link; ?>" onmouseover="joms.toolbar.open('m1')" onmouseout="joms.toolbar.closetime()" class="has-submenu">
				<span><?php echo $profileItem->caption; ?></span>
			</a>
	        <div id="m1" onmouseover="joms.toolbar.cancelclosetime()" onmouseout="joms.toolbar.closetime()" style="visibility: hidden;" class="toolbar-subitems <?php echo $toolbarClass[TOOLBAR_PROFILE]; ?>">
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_PROFILE, 'prepend'); ?>
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_PROFILE, 'append'); ?>
	        </div>
	    </li>
	    <?php
    			}
    		}	
	    ?>

		<?php
			if(isset($customToolbar) && !empty($customToolbar)){
				if($customToolbar->hasToolBarGroup(TOOLBAR_FRIEND)){
					$frenItem	= $customToolbar->getToolbarItems(TOOLBAR_FRIEND);
		?>			    
	    <li id="toolbar-item-friends" class="<?php echo $toolbarClass[TOOLBAR_FRIEND];?> toolbar-item">			
			<a href="<?php echo $frenItem->link; ?>" onmouseover="joms.toolbar.open('m2')" onmouseout="joms.toolbar.closetime()" class="has-submenu">
				<span><?php echo $frenItem->caption; ?></span>
			</a>
	        <div id="m2" onmouseover="joms.toolbar.cancelclosetime()" onmouseout="joms.toolbar.closetime()" style="visibility: hidden;" class="toolbar-subitems <?php echo $toolbarClass[TOOLBAR_FRIEND];?>">
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_FRIEND, 'prepend');?>
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_FRIEND, 'append');?>				
	        </div>
	    </li>
	    <?php
    			}
    		}	
	    ?>

		<?php
			if(isset($customToolbar) && !empty($customToolbar)){
				if($customToolbar->hasToolBarGroup(TOOLBAR_APP)){
					$appItem	= $customToolbar->getToolbarItems(TOOLBAR_APP);
		?>			    
  		<li id="toolbar-item-apps" class="<?php echo $toolbarClass[TOOLBAR_APP];?> toolbar-item">			
			<a href="<?php echo $appItem->link; ?>" onmouseover="joms.toolbar.open('m3')" onmouseout="joms.toolbar.closetime()" class="has-submenu">
				<span><?php echo $appItem->caption; ?></span>
			</a>
	        <div id="m3" onmouseover="joms.toolbar.cancelclosetime()" onmouseout="joms.toolbar.closetime()" style="visibility: hidden; overflow: hidden;" class="toolbar-subitems <?php echo $toolbarClass[TOOLBAR_APP];?>">
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_APP, 'prepend'); ?>
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_APP, 'append'); ?>
	        </div>
		</li>
	    <?php
    			}
    		}	
	    ?>		
		
		<?php
		if( $config->get('enablepm') )
		{
			if(isset($customToolbar) && !empty($customToolbar)){
				if($customToolbar->hasToolBarGroup(TOOLBAR_INBOX)){
					$inboxItem	= $customToolbar->getToolbarItems(TOOLBAR_INBOX);		
		?>
  		<li id="toolbar-item-inbox" class="<?php echo $toolbarClass[TOOLBAR_INBOX];?> toolbar-item">
			<a href="<?php echo $inboxItem->link; ?>" onmouseover="joms.toolbar.open('m4')" onmouseout="joms.toolbar.closetime()" class="has-submenu">
				<span><?php echo $inboxItem->caption; ?></span>
			</a>
	        <div id="m4" onmouseover="joms.toolbar.cancelclosetime()" onmouseout="joms.toolbar.closetime()" style="visibility: hidden;" class="toolbar-subitems <?php echo $toolbarClass[TOOLBAR_INBOX];?>">
	        	<?php echo $customToolbar->getMenuItems(TOOLBAR_INBOX, 'prepend'); ?>
				<?php echo $customToolbar->getMenuItems(TOOLBAR_INBOX, 'append'); ?>				
	        </div>
		</li>
		<?php
    			}
    		}		
		}
		?>
		<?php
			if(isset($customToolbar) && !empty($customToolbar)){
				$myExtraToolbar	=& $customToolbar->getExtraToolbars();
				if(! empty($myExtraToolbar)) 				
				{
					$startCnt	= 5; //this counter used for javascript and div id.
					foreach($myExtraToolbar as $key	=> $item)
					{
						echo '<li id="toolbar-item-'.$startCnt.'" class="'.$toolbarClass[$key].' toolbar-item">';
						echo '	<a href="'.$item->link.'" onmouseover="joms.toolbar.open(\'m'.$startCnt.'\')" onmouseout="joms.toolbar.closetime()" class="has-submenu"><span>'.$item->caption.'</span></a>';
						echo '	<div class="toolbar-subitems" id="m'.$startCnt.'" onmouseover="joms.toolbar.cancelclosetime()" onmouseout="joms.toolbar.closetime()" style="visibility: hidden;">';
						echo $customToolbar->getMenuItems($key, 'all');							
						echo '	</div>';
						echo '</li>';
						$startCnt++;
					}//end foreach
				}//end if
			}
		?>		
		
		<?php if ( (!empty($notiAlert)) && ($notiAlert > 0) ) { ?>
		<li id="toolbar-item-notify" class="toolbar-item">
			<a href="javascript:joms.notifications.showWindow();">
				<span id="toolbar-item-notify-count"><?php echo $notiAlert; ?></span>
			</a>
		</li>
		<?php }//end if?>
	</ul>
	
	<div class="toolbar-myname">
		<?php
			if( $config->get('fbconnectkey') && $config->get('fbconnectsecret') && $isFacebookUser )
			{
		?>
			<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
			<script type="text/javascript">
			jQuery(document).ready(function(){
				FB_RequireFeatures(["XFBML"], function() {
					FB.Facebook.init( "<?php echo $config->get('fbconnectkey');?>" , "<?php echo CRoute::_('index.php?option=com_community&view=connect&task=receiver&tmpl=component');?>");
				});
			});
			</script>
			<form action="index.php" method="post" name="communitylogout" id="communitylogout">
				<a href="#" onclick="FB.Connect.logout(function() { document.communitylogout.submit(); }); return false;" ><img id="fb_logout_image" src="<?php echo JURI::root();?>components/com_community/assets/fblogout_small.gif" alt="Connect"/></a>
				<input type="hidden" name="option" value="com_user" />
				<input type="hidden" name="task" value="logout" />
				<input type="hidden" name="return" value="<?php echo $logoutLink; ?>" />
			</form>			
		<?php
			}
			else
			{
		?>
			<form action="index.php" method="post" name="communitylogout" id="communitylogout">
				<a href="javascript:void(0);" onclick="document.communitylogout.submit();"><?php echo JText::_('CC LOGOUT');?></a>
				<input type="hidden" name="option" value="com_user" />
				<input type="hidden" name="task" value="logout" />
				<input type="hidden" name="return" value="<?php echo $logoutLink; ?>" />
			</form>
		<?php
			}
		?>	
	</div>

</div>

<?php if ( $miniheader ) : ?>
	<?php echo @$miniheader; ?>
<?php endif; ?>
