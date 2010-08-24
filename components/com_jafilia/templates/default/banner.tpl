<!--- NAME: banner.tpl --->
<?php defined( '_JEXEC' ) or die( '=;)' ); ?>
<div id="jaf_mainpart">
<table width="99%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th scope="col" align="left"><h3><?php echo JText::_('JAF_LINKS'); ?></h3></th>
    <th scope="col" align="right"><?php echo $BOX; ?></th>
  </tr>
    <?php 
	$url = JUri::base();
	foreach($rows as $row)  {
		if($row->version == "text")  {
			$code = '&lt;!--- Beginn Linkcode ---&gt;<br>&lt;a href="'.$url.'index.php?affiliate='.$my->id.'" title="'.$row->title.'" &gt;'.$row->text.'&lt;/a&gt;<br>&lt;!--- End Linkcode ---&gt;';
			//$display = $row->text;
			$display = '<a href="'.$url.'index.php?affiliate='.$my->id.'" title="'.$row->title.'" >'.$row->text.'</a>';
		} elseif($row->version == "banner") {
			$code = '&lt;!--- Beginn Linkcode ---&gt;<br>&lt;a href="'.$url.'index.php?affiliate='.$my->id.'" title="'.$row->title.'"&gt;&lt;img src="'.$url.'components/com_jafilia/images/'.$row->image.'" alt="'.$row->title.'" &gt;&lt;/a&gt;<br>&lt;!--- End Linkcode ---&gt;';
			//$display = '<img src="'.$url.'components/com_jafilia/images/'.$row->image.'">';
			$display = '<a href="'.$url.'index.php?affiliate='.$my->id.'" title="'.$row->title.'"><img src="'.$url.'components/com_jafilia/images/'.$row->image.'" alt="'.$row->title.'" ></a>';
		} 
		//$TITLE=$row->title;
		$DISPLAY=$display;
		$CODE=$code;
	?>  
	<tr>
		<td colspan="2" align="center"><?php echo JText::_('JAF_PREVIEW').' ('.$row->version.'): '.$DISPLAY; ?></td>
	</tr>
	<tr>
		<td colspan="2" align="center" class="codeline"><code><?php echo $CODE; ?></code></td>
	</tr>	
    <?php 
	}
	?>
</table>
<?php echo $PAGENAV; ?>
</div>

<!--- END: banner.tpl --->
