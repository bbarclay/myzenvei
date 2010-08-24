{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div id="editcell">
    <table class="adminlist">
	<thead>
	<tr>
	    <th width="5" class="title" valign="top">ID</th>
	    <th width="5" valign="top"><input type="checkbox" name="toggle" value="" onClick="checkAll({$totalvideos});" /></th>
	    <th width="5" class="title" valign="top"></th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_TITLE}</th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_CAPTION}</th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_RATING}</th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_VIEWS}</th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_ACCESS}</th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_DATEUPLD}</th>
	    <th class="title" valign="top">{$smarty.const._HWDPS_APPROVED}</th>
	    <th class="title" width="50" valign="top">{$smarty.const._HWDPS_FEATURED}</th>
	    <th class="title" width="50" valign="top">{$smarty.const._HWDPS_PUB}</th>
	</tr>
	</thead>
	<tbody>
	{foreach name=outer item=data from=$list_all}
	<tr class="row{$data->k}">
	    <td valign="top">{$data->id}</td>
	    <td valign="top">{$data->checked}</td>
	    <td valign="top">{$data->thumbnail}</td>
	    <td valign="top">{$data->title}</td>
	    <td valign="top">{$data->caption}</td>
	    <td valign="top">{$data->rating}</td>
	    <td valign="top">{$data->views}</td>
	    <td valign="top">{$data->access}</td>
	    <td valign="top">{$data->date}</td>
	    <td valign="top">{$data->status}</td>
	    <td valign="top"><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->featured_task}')"><img src="images/{$data->featured_img}" width="12" height="12" border="0" alt="" /></a></td>
	    <td valign="top"><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->published_task}')"><img src="images/{$data->published_img}" width="12" height="12" border="0" alt="" /></a></td>
	</tr>
	{/foreach}
	</tbody>
	<tfoot>
	<tr><td colspan="12" align="center"><div style="float:right;">{$writePagesCounter}</div>{$writePagesLinks}</td></tr>
	</tfoot>
    </table>
</div>