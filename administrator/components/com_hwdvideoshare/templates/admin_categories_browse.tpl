{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='admin_header.tpl'}

<div id="editcell">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5" class="title">ID</th>
        <th width="5" class="title"><input type="checkbox" name="toggle" value="" onClick="checkAll({$totalcategories});" /></th>
        <th align="left" class="title">{$smarty.const._HWDVIDS_TITLE}</th>
        <th align="left" class="title">{$smarty.const._HWDVIDS_CVACCESS}</th>
        <th align="left" class="title">{$smarty.const._HWDVIDS_CUACCESS}</th>
        <th align="left" width="50" class="title">{$smarty.const._HWDVIDS_PUB}</th>
        <th align="left" width="30" class="title">{$smarty.const._HWDVIDS_ORDER}</th>
        <th align="left" width="40" class="title" colspan="2">{$smarty.const._HWDVIDS_REORDER}</th>
      </tr>
    </thead>
    <tbody>
      {foreach name=outer key=k item=data from=$list}
      {if $data->isparent}
        <tr bgcolor = "#f1f3f0">
      {else}
        <tr class = "row{$data->k}">
      {/if}
        <td width="20">{$data->id}</td>
        <td>{$data->checked}</td>
        <td>{$data->title}</td>
        <td>{$data->view_access}</td>
        <td>{$data->upld_access}</td>
        <td><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->published_task}')"><img src="images/{$data->published_img}" width="12" height="12" border="0" alt="" /></a></td>
        <td>{$data->order}</td>
        <td width="20">{$data->reorderup}</td>
        <td width="20">{$data->reorderdown}</td>
      </tr>
      {/foreach}
    </tbody>
    <tfoot>
      <tr><td colspan="9" align="center">{$writePagesLinks}<br />{$writePagesCounter}</td></tr>
    </tfoot>
  </table>
</div>

{include file='admin_footer.tpl'}
