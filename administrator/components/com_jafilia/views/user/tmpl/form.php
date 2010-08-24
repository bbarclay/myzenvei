<?php
defined( '_JEXEC' ) or die( '=;)' );

	$path = JPATH_COMPONENT.DS.'helpers'.DS.'jafilia.class.php';
	include($path);
	$url = JUri::base(true);
	JHTML::_('behavior.tooltip');
	drawGraphFees($this->User->uid);
	drawGraphClickSale($this->User->uid);
	$user = new cluserdata($this->User->uid);	
	$clicks = $user->countClicks($this->User->uid);
	$leads = $user->countLeads($this->User->uid);	
	$conversion='';
	$payout='';
	if($clicks && $leads) {
		$conversion = round((100/$clicks)*$leads,2);
	}
	$currency = $user->getCurrency();
	$openAmount = $user->countOpenAmount($this->User->uid);
	$payings = $user->countAmountAll($this->User->uid);
	$user->getPayouts($this->User->uid);
	$payouts = $user->payouts;
	$id = $this->User->uid;
	if($openAmount >= $this->jafpayout) {	
		$paylink = "<img src='../administrator/components/com_jafilia/images/payout.jpg' height='20' width='20' onClick=\"location.href='index.php?option=com_jafilia&controller=user&task=payout&uid=".$id."'\">";
	} else {
		$paylink = null;
	}
?>
<form action="index.php" method="post" name="adminForm">		
        <table  class="adminlist">
          <tr>
            <th colspan="2"><h1><?php echo JText::_( 'JAF_USER_OVERVIEW'); ?></h1></th>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_NAME'); ?>:</td>
            <td><?php echo $this->User->firstname. " " .$this->User->lastname; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_HOMEPAGE'); ?>:</td>
            <td><?php echo $this->User->url; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_PAYPAL'); ?>:</td>
            <td><?php echo $this->User->paypal; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_BANK'); ?>:</td>
            <td><?php echo $this->User->bank; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_BLZ'); ?>:</td>
            <td><?php echo $this->User->blz; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_KONTO'); ?>:</td>
            <td><?php echo $this->User->konto; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_CONVERSION'); ?>:</td>
            <td><?php echo $conversion; ?>%</td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_OPEN_AMOUNT'); ?>: <?php
			echo JHTML::_('tooltip', JText::_( 'JAF_TOOL_AMOUNT'), JText::_( 'JAF_INFO'), 'tooltip.png');
			?></td>
            <td><?php
			if ($openAmount!='')
			echo $openAmount . " " . $currency . "&nbsp;&nbsp;&nbsp;" . $paylink . "&nbsp;&nbsp;&nbsp;" . $payout; 
			else echo '0 '.$currency;
			?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_AMOUNT_ALL'); ?>: <?php 
			echo JHTML::_('tooltip', JText::_('JAF_TOOL_PAYINGS'), JText::_( 'JAF_INFO'), 'tooltip.png');
			?></td>
            <td><?php echo $payings . " " . $currency; ?></td>
          </tr>
          <tr>
            <td><?php echo JText::_( 'JAF_PAYOUTS'); ?>:</td>
            <td><?php 
			foreach($payouts as $pay)  {		
				echo "No." . $pay->id . " - " . JHTML::_('date', $pay->date, JText::_('DATE_FORMAT_LC1')) . " <a href='index.php?option=com_jafilia&controller=user&id=".$pay->id."&format=pdf' target='_blank' ><img src='../images/M_images/pdf_button.png' ></a><br>"; 						
			}?>
            </td>
          </tr>
          <tr>
          	<td colspan="2" align="center"><img src="../components/com_jafilia/images/clicksales_<?php echo $id; ?>.png" />
            </td>
          </tr>
          <tr>
          	<td colspan="2" align="center"><img src="../components/com_jafilia/images/fees_<?php echo $id; ?>.png" />
            </td>
          </tr>
        </table>
<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="user" />
</form>