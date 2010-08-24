{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="admin_header.tpl"}

{literal}
<script language="javascript" type="text/javascript">
<!--

function toggleCheckboxes(m, n) {

	for (i = m; i < n; i++) {

		var id = 'cb' + i;
		var inputbox = document.getElementById(id);
		if (inputbox.checked) inputbox.checked = false
		else inputbox.checked = true;

	}

}

// -->
</script>
{/literal}

{$startpane}
    {$starttab1}

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
		    <th class="title" width="140">{$smarty.const._HWDPS_APPROVEP}</th>
		</tr>
		</thead>
		<tbody>
		{foreach name=outer item=data from=$list_photos}
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
		    <td valign="top"><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->approve_task}')"><img src="images/{$data->approve_img}" width="12" height="12" border="0" alt="" /></a></td>
		</tr>
		{/foreach}
		</tbody>
		<tfoot>
		<tr><td colspan="11" align="center">{$writePagesLinks}<br />{$writePagesCounter}</td></tr>
		</tfoot>
	    </table>
	</div>

    {$endtab}
    {$starttab2}

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
		    <th class="title" width="150">{$smarty.const._HWDPS_APPROVEA}</th>
		</tr>
		</tr>
		</thead>
		<tbody>
		{foreach name=outer item=data from=$list_albums}
		<tr class="row{$data->k}">
		    <td>{$data->id}</td>
		    <td>{$data->checked}</td>
		    <td>{$data->title}</td>
		    <td>{$data->numphotos}</td>
		    <td>{$data->access}</td>
		    <td>{$data->date_created}</td>
		    <td>{$data->date_modified}</td>
		    <td>{$data->status}</td>
		    <td><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->approve_task}')"><img src="images/{$data->approve_img}" width="12" height="12" border="0" alt="" /></a></td>
		</tr>
		{/foreach}
		</tbody>
		<tfoot>
		<tr><td colspan="11" align="center">{$writePagesLinks}<br />{$writePagesCounter}</td></tr>
		</tfoot>
	    </table>
	</div>

    {$endtab}
{$endpane}

{include file="admin_footer.tpl"}



