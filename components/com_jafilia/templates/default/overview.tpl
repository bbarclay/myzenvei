<!--- NAME: overview.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<div id="jaf_mainpart">
    <table width="50%" border="0" cellspacing="1" cellpadding="1" align="center">
        <tr>
            <th colspan="2" align="center"><h3><?php echo JText::_('JAF_OVERVIEW'); ?></h3></th>
        </tr>
        <tr>
            <td width="75%"><?php echo JText::_('JAF_CLICKS_ALL'); ?></td>
            <td align="center"><?php echo $CLICKS; ?></td>
        </tr>
        <tr>
            <td><?php echo JText::_('JAF_LEADS_ALL'); ?></td>
            <td align="center"><?php echo $LEADS; ?></td>
        </tr>
        <tr>
            <td><?php echo JText::_('JAF_CONVERSION'); ?></td>
            <td align="center"><?php echo $CONV; ?></td>
        </tr>
        <tr>
            <td><?php echo JText::_('JAF_OPEN_AMOUNT'); ?></td>
            <td align="center"><?php echo $OPEN; ?></td>
        </tr>
        <tr>
            <td><?php echo JText::_('JAF_PAYOUTS_ALL'); ?></td>
            <td align="center"><?php echo $AMOUNT; ?></td>
        </tr>
    </table>
    <div class="mpa_graph"><?php echo $GRAPH; ?></div>
    <div class="mpa_graph"><?php echo $FEES; ?></div>
</div>

<!--- END: overview.tpl --->


