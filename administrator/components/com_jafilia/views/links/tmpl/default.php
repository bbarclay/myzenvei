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
            <?php echo JText::_( 'Title' ); ?>
         </th>
         <th>
            <?php echo JText::_( 'Text' ); ?>
         </th>
         <th>
            <?php echo JText::_( 'Banner' ); ?>
         </th>
         <th>
            <?php echo JText::_( 'Published' ); ?>
         </th>               
      </tr>       
   </thead>
<?php   
   $k = 0;
   for ($i=0, $n=count( $this->items ); $i < $n; $i++) {
		$row = &$this->items[$i];
		$checked    = JHTML::_('grid.id', $i, $row->id); 
		$published  = JHTML::_('grid.published', $row, $i); 
		$link = JRoute::_( 'index.php?option=com_jafilia&controller=links&task=edit&cid[]='. $row->id );
?>
      <tr class="<?php echo "row$k"; ?>">
         <td>
            <?php echo $row->id; ?>
         </td>
         <td>
            <?php echo $checked; ?>
         </td>
         <td>
            <a href="<?php echo $link; ?>"><?php echo $row->title; ?></a>
         </td>
         <td>
            <?php echo $row->text; ?>
         </td>
         <td>
            <?php echo $row->image; ?>
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
      <td colspan="6">
         <?php echo $this->pagination->getListFooter(); ?>
      </td>
    </tr>
  </tfoot>
   </table>
</div>

<input type="hidden" name="option" value="com_jafilia" />
<input type="hidden" name="task" value="links" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="links" />
</form>
