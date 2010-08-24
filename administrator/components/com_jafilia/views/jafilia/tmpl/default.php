<?php
defined( '_JEXEC' ) or die( '=;)' );
global $mainframe; 
?>
<div id="main">
	<div id="cpanel" style="width:60%; float: left;">
		<?php echo $this->cpanel_images->config; ?>
		<?php echo $this->cpanel_images->campaigns; ?>		
		<?php echo $this->cpanel_images->links; ?>		
		<br class="clear" style="clear:both;" />
		<?php echo $this->cpanel_images->user; ?>		
		<?php echo $this->cpanel_images->clicks; ?>					
		<?php echo $this->cpanel_images->sales; ?>		
		<br class="clear" style="clear:both;" />
		<?php echo $this->cpanel_images->charts; ?>
		<?php echo $this->cpanel_images->about; ?>
		<?php echo $this->cpanel_images->help; ?>
	</div>
	<div id="jpmodules" style="width:40%; float: left;">
		<?php
			jimport('joomla.html.pane');
			JHTML::_('behavior.mootools');
			$pane =& JPane::getInstance('Sliders');			
			echo $pane->startPane('jpsliders')."\n";			
//////////////
				echo $pane->startPanel(jtext::_('JAF_PAYOUT_REACHED'),'jafpayoutreached')."\n";				
				if(!isset($this->rows))  {
					echo '<p align="center">Payout limit: '. $this->payoutlimit.'<br>'.jtext::_('JAF_NO_PAYOUTS') . '</p>';
				} else {
					foreach($this->rows as $row)  {
					$payoutlnk = 'index.php?option=com_jafilia&controller=user&task=payout&uid='.$row->uid;
						echo '<p align="center">'. $row->firstname . ' ' . $row->lastname . ' :  <a href="'.$payoutlnk.'"><img src="../administrator/components/com_jafilia/images/payout.jpg" height="20" width="20" style="border: none"></a></p>';
					}
				}
				echo $pane->endPanel()."\n";
				/***/
				echo $pane->startPanel(jtext::_('JAF_CHARTS'),'statistics')."\n";
	$db = & JFactory::getDBO();
	/****/
	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_user`'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_user` WHERE published = 1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statu = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statu2 = $db->loadResult(); 

	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="text"'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="text" AND published=1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statb = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statb2 = $db->loadResult(); 

	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="banner"'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_banner` WHERE `version`="banner" AND published=1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statc = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statc2 = $db->loadResult(); 	

	$sql = 'SELECT COUNT(`id`) FROM `#__jafilia_campaigns`'; 
	$sql2 = 'SELECT COUNT(`id`) FROM `#__jafilia_campaigns` WHERE published=1';
	//$sql = 'SELECT `id` FROM `jos_components` WHERE `name` LIKE \'Jafilia\' LIMIT 1 '; 
	$db->setQuery($sql);
	if($db->query()) $statg = $db->loadResult();  
	$db->setQuery($sql2);
	if($db->query()) $statg2 = $db->loadResult();
	
echo'<div style="padding:0px 10px;">
<p>
Users: '.$statu2.' / '.$statu.'<br>
Campaigns: '.$statg2.' / '.$statg.' (to do)<br>
Banners: '.$statc2.' / '.$statc.'<br>
Links: '.$statb2.' / '.$statb.'
</p>
</div>
';

				echo $pane->endPanel()."\n";
				/***/
				echo $pane->startPanel(jtext::_('JAF_TRANSLATION_CREDITS'),'translationcredits')."\n";
		?>		
		<p style="text-align:center;">
		<strong><?php echo JText::_('JAF_TRANSLATION_LANGUAGE') ?></strong><br/>
		<a href="<?php echo JText::_('JAF_TRANSLATION_AUTHOR_URL') ?>" target="_blank"><?php echo JText::_('JAF_TRANSLATION_AUTHOR') ?></a>
		</p>
		<?php 
				echo $pane->endPanel()."\n";	
///////////////			
			echo $pane->endPane()."\n";
		?>
	</div>	
</div>
<div style="clear: both;"></div>
<div style="text-align:center;">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_donations">
	<input type="hidden" name="business" value="yc@bizboost.es">
	<input type="hidden" name="item_name" value="Donate to Jafilia">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="cn" value="Notes">
	<input type="hidden" name="currency_code" value="EUR">
	<input type="hidden" name="tax" value="0">
	<input type="hidden" name="lc" value="US">
	<input type="hidden" name="bn" value="PP-DonationsBF">
	<input type="image" src="https://www.paypal.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>
<br style="clear:both;" />
