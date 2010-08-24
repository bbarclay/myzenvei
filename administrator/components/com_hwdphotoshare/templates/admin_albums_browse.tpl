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
	    <th width="5" class="title">ID</th>
	    <th width="5"><input type="checkbox" name="toggle" value="" onClick="checkAll({$totalvideos});" /></th>
	    <th class="title">{$smarty.const._HWDPS_TITLE}</th>
	    <th class="title">{$smarty.const._HWDPS_NOP}</th>
	    <th class="title">{$smarty.const._HWDPS_ACCESS}</th>
	    <th class="title">{$smarty.const._HWDPS_DATECREA}</th>
	    <th class="title">{$smarty.const._HWDPS_DATEMODI}</th>
	    <th class="title">{$smarty.const._HWDPS_APPROVED}</th>
	    <th class="title" width="50">{$smarty.const._HWDPS_FEATURED}</th>
	    <th class="title" width="50">{$smarty.const._HWDPS_PUB}</th>
	</tr>
	</thead>
	<tbody>
	{foreach name=outer item=data from=$list_all}
	<tr class="row{$data->k}">
	    <td>{$data->id}</td>
	    <td>{$data->checked}</td>
	    <td>{$data->title}</td>
	    <td>{$data->numphotos}</td>
	    <td>{$data->access}</td>
	    <td>{$data->date_created}</td>
	    <td>{$data->date_modified}</td>
	    <td>{$data->status}</td>
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