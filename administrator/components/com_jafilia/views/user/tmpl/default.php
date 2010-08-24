<?php
defined( '_JEXEC' ) or die( '=;) linki ' );
?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
   <table class="adminlist">
   <thead>
      <tr>
         <th width="5">
            <?php echo JText::_( 'ID' ); ?>
         </th>
         <th width="20">
            <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
         </th>       
         <th>
            <?php echo JText::_( 'JAF_NAME' ); ?>
         </th>
         <th>
            <?php echo JText::_( 'JAF_HOMEPAGE' ); ?>
         </th>
         <th>
            <?php echo JText::_( 'JAF_CLICKS' ); ?>
         </th>
         <th>
            <?php echo JText::_( 'JAF_SALES' ); ?>
         </th>		 
         <th>
            <?php echo JText::_( 'Published' ); ?>
         </th>               
      </tr>       
   </thead>
<?php
	require_once(JPATH_ADMINISTRATOR.DS."components".DS."com_jafilia".DS."helpers".DS."jafilia.class.php");   
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		$checked    = JHTML::_('grid.id', $i, $row->id); 
		$published  = JHTML::_('grid.published', $row, $i); 
		$link = JRoute::_( 'index.php?option=com_jafilia&controller=user&task=edit&cid[]='. $row->uid );
		$link2 = JRoute::_( 'index.php?option=com_jafilia&controller=user&task=userClicks&cid[]='. $row->uid );
		$link3 = JRoute::_( 'index.php?option=com_jafilia&controller=user&task=userLeads&cid[]='. $row->uid );
		$user = new cluserdata($row->uid);	
		$clicks = $user->countClicks($row->uid);
		$leads = $user->countLeads($row->uid);
?>
      <tr class="<?php echo "row$k"; ?>">
         <td>
            <?php echo $row->id; ?>
         </td>
         <td>
            <?php echo $checked; ?>
         </td>
         <td>
            <a href="<?php echo $link; ?>"><?php echo $row->firstname." ".$row->lastname; ?></a>
         </td>
         <td>
            <?php echo $row->url; ?>
         </td>
         <td>
			<a href="<?php echo $link2; ?>"><?php echo $clicks; ?></a>
         </td> 
         <td>
            <a href="<?php echo $link3; ?>"><?php echo $leads; ?></a>
         </td> 		 
         <td>
            <?php echo $published; ?>
         </td>              
      </tr>
<?php
	$k = 1 - $k;
}
?>
    <tfoot>
    <tr>
      <td colspan="7">
         <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </tfoot>
   </table>
</div>

<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="task" value="user" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="user" />
</form>
