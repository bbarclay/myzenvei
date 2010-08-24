<?php defined('_JEXEC') or die('Restricted access'); 
//$ordering = ($this->lists['order'] == 'ordering');
JHTML::_('behavior.tooltip');
?>

<script language="javascript" type="text/javascript">
function submitform(pressbutton){
var form = document.adminForm;
   if (pressbutton)
    {form.task.value=pressbutton;}
     
	 if ((pressbutton=='add')||(pressbutton=='edit')||(pressbutton=='publish')||(pressbutton=='unpublish')
	 ||(pressbutton=='orderdown')||(pressbutton=='orderup')||(pressbutton=='saveorder')||(pressbutton=='remove') )
	 {
	  form.controller.value="jposition_detail";
	 }
	try {
		form.onsubmit();
		}
	catch(e){}
	
	form.submit();
}


</script>
<style type="text/css">
#editcell{float:left;width:170px; margin:0 10px 10px 0;}
.edocs_ul{list-style-image:none;list-style-position:outside;list-style-type:none;margin:0 0 10px 0;padding:0pt;}
.edocs_li{color:#0B55C4 !important;padding:0px;}
.edocs_li_unpublished{color:#999999 !important;padding:0px;}
.style13_footer{background-color:#F3F3F3;border-top:1px solid #999999;text-align:center;float:left; width:100%;}
.pagination{display:table;margin:0 auto;padding:5px;}
</style>

<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" >
	

<div id="editcell">
		<div class="t">
			<div class="t">
				<div class="t"></div>
			</div>
	 	</div>
		<div class="m">
			
<?php 		
	$jmenutype_names	= $this->jmenutype_names;
	$jmenutype_types	= $this->jmenutype_types;
	$menujdata 			= $this->menujdata;
	
	for ($i=0, $n=count( $jmenutype_names ); $i < $n; $i++)
		{
			echo '<span>'.$jmenutype_names[$i].'</span>';
			echo '<ul class="edocs_ul">';
			
			for ($c=0, $c_n=count( $menujdata ); $c < $c_n; $c++)
			{
				if ($jmenutype_types[$i] === $menujdata[$c]->menutype)
				{
					if ($menujdata[$c]->published == 0){
					$prefix_published = '_unpublished';
					}
					else{ 
						$prefix_published = '';
					}
				$link = JRoute::_( 'index.php?option=com_jposition&controller=jposition_detail&task=edit&cid[0]='.$menujdata[$c]->id );
				echo '<li class="edocs_li'.$prefix_published.'">
						<a href="'.$link.'" class="edocs_li'.$prefix_published.'">'.$menujdata[$c]->name.'</a></li>'; 
				}
			}
			
			/*$k = 1 - $k;*/
			echo '</ul>';
		}
		?>
			<div class="clr"></div>
		</div>
		<div class="b">
			<div class="b">
					<div class="b"></div>
			</div>
		</div>
</div>

<?php

	$position_count = count( $this->positions );
	$positions		= $this->positions;
	$items 			= $this->items;
	for ($i=0, $n = $position_count; $i < $n; $i++)
		{
			$row = &$this->positions[$i];
			$position_count ++; 
		?>
		
<div id="editcell">
		<div class="t">
			<div class="t">
				<div class="t"></div>
			</div>
	 	</div>
		<div class="m">
			<span><?php echo $row; ?></span>
			<ul class="edocs_ul">
<?php 		
	for ($i_items=0, $n_items=count( $items ); $i_items < $n_items; $i_items++)
		{
			if ($items[$i_items]->position === $row)
			{
				if ($items[$i_items]->published == 0){
					$prefix_published = '_unpublished';
				}
				else{ 
					$prefix_published = '';
				}
				$link_module = JRoute::_( 'index.php?option=com_modules&amp;client=0&amp;task=edit&amp;cid[]='.$items[$i_items]->id );	
				echo '<li class="edocs_li'.$prefix_published.'">'
					.'<a href="'.$link_module.'" class="edocs_li'.$prefix_published.'">'.$items[$i_items]->title.'</a>'
					.'</li>'; 
			}
		}
		?>
			</ul>	
			<div class="clr"></div>
		</div>
		<div class="b">
			<div class="b">
					<div class="b"></div>
			</div>
		</div>
</div>
<?php } ?>
<div class="style13_footer">
	<div class="pagination">
		<div class="button2-left">
			<div class="next">
				<span>J!Position 1.0.2</span>
				<a href="http://www.style13.com" title="Powered by Style13">Powered by Style13</a>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="controller" value="jposition" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<?php /* ?>
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<?php */ ?>
</form>
