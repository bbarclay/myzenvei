{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="admin_header.tpl"}

<div id="editcell">
    <table class="adminlist">
	<thead>
	<tr>
            <th width="5" class="title"></th>
	    <th width="5"><input type="checkbox" name="toggle" value="" onClick="checkAll({$totalgroups});" /></th>
	    <th align="left" class="title">{$smarty.const._HWDPS_TITLE}</th>
	    <th align="left" class="title">{$smarty.const._HWDPS_DESC}</th>
	    <th align="left" class="title">{$smarty.const._HWDPS_ACCESS}</th>
	    <th align="left" class="title">{$smarty.const._HWDPS_DATECREA}</th>
	    <th align="left" class="title">{$smarty.const._HWDPS_GRPMEMS}</th>
	    <th align="left" class="title">{$smarty.const._HWDPS_GRPPHOT}</th>
	    <th width="50" align="center" class="title">{$smarty.const._HWDPS_FEATURED}</th>
	    <th width="50" align="center" class="title">{$smarty.const._HWDPS_PUB}</th>
	</tr>
	</thead>
	<tbody>
	    {foreach name=outer item=data key=k from=$list}
            <tr class = "row{$data->k}">
                <td width = "20" align = "right">{$k+1}</td>
                <td>{$data->checked}</td>
                <td>{$data->title}</td>
                <td>{$data->description}</td>
                <td>{$data->access}</td>
                <td>{$data->date}</td>
                <td>{$data->total_members}</td>
                <td>{$data->total_videos}</td>
	    	<td><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->featured_task}')"><img src="images/{$data->featured_img}" width="12" height="12" border="0" alt="" /></a></td>
	    	<td><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->published_task}')"><img src="images/{$data->published_img}" width="12" height="12" border="0" alt="" /></a></td>
	    </tr>
	    {/foreach}
	</tbody>
	<tfoot>
	<tr><td colspan="11" align="center"><div style="float:right;">{$writePagesCounter}</div>{$writePagesLinks}</td></tr>
	</tfoot>
    </table>
</div>

{include file="admin_footer.tpl"}
