<!--- START: navigation.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<div>
<table class="navi" width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th scope="col" colspan="2"><a href="<?php echo $tpl['L-OV']; ?>"><?php echo JText::_('JAF_OVERVIEW'); ?></a></th>
    <th scope="col" colspan="2"><a href="<?php echo $tpl['L-DETAILS']; ?>"><?php echo JText::_('JAF_USER'); ?></a></th>
  </tr>
  <tr>
    <th scope="col"><a href="<?php echo $tpl['L-REFERES']; ?>"><?php echo JText::_('JAF_REFERER'); ?></a></th>
    <th scope="col"><a href="<?php echo $tpl['L-LEADS']; ?>"><?php echo JText::_('JAF_AMOUNTS'); ?></a></th>
    <th scope="col"><a href="<?php echo $tpl['L-PAYOUT']; ?>"><?php echo JText::_('JAF_PAYOUTS'); ?></a></th>
    <th scope="col"><a href="<?php echo $tpl['L-BANNER']; ?>"><?php echo JText::_('JAF_LINKS'); ?></a></th>
  </tr>
</table>
</div>
<!--- END: navigation.tpl --->
