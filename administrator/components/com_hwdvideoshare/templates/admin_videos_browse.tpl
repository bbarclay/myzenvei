{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
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
        <th class="title">{$video_sort_header}</a></th>
        <th class="title">{$length_sort_header}</th>
        <th class="title">{$rating_sort_header}</th>
        <th class="title">{$views_sort_header}</th>
        <th class="title">{$access_sort_header}</th>
        <th class="title">{$date_sort_header}</th>
        <th class="title">{$status_sort_header}</th>
        <th class="title">{$featured_sort_header}</th>
        <th class="title">{$published_sort_header}</th>
        <th class="title">{$ordering_sort_header}</th>
        <th class="title" width="40" colspan="2">{$smarty.const._HWDVIDS_REORDER}</th>
      </tr>
    </thead>
    <tbody>
      {foreach name=outer item=data from=$list_all}
      <tr class="row{$data->k}">
        <td>{$data->id}</td>
        <td>{$data->checked}</td>
        <td>{$data->title}</td>
        <td>{$data->length}</td>
        <td>{$data->rating}</td>
        <td>{$data->views}</td>
        <td>{$data->access}</td>
        <td>{$data->date}</td>
        <td>{$data->status}</td>
        <td><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->featured_task}')"><img src="images/{$data->featured_img}" width="12" height="12" border="0" alt="" /></a></td>
        <td><a href="javascript: void(0);" onclick="return listItemTask('cb{$data->i}','{$data->published_task}')"><img src="images/{$data->published_img}" width="12" height="12" border="0" alt="" /></a></td>
        <td>{$data->ordering}</td>
        <td width="20">{$data->reorderup}</td>
        <td width="20">{$data->reorderdown}</td>
      </tr>
      {/foreach}
    </tbody>
    <tfoot>
      <tr>
        <td colspan="14">
        <div style="float:right;">{$writePagesCounter}</div>
        <div style="float:left;">{$writePagesLinks}</div>
        </td>
      </tr>
    </tfoot>
  </table>
</div>