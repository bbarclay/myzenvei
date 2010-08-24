{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright 2008 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
//    hwdVideoShare Template System:::This template system uses the Smarty Template Engine. 
//    For full documentation, including syntax usage please refer to http://www.smarty.net 
//    or our website at http://www.hwdmediashare.co.uk   
//////
*}

<div id="editcell">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5" class="title">ID</th>
        <th width="5"></th>
        <th class="title">{$smarty.const._HWDVIDS_TITLE}</th>
        <th class="title">{$smarty.const._HWDVIDS_LENGTH}</th>
        <th class="title">{$smarty.const._HWDVIDS_RATING}</th>
        <th class="title">{$smarty.const._HWDVIDS_VIEWS}</th>
        <th class="title">{$smarty.const._HWDVIDS_ACCESS}</th>
        <th class="title">{$smarty.const._HWDVIDS_DATEUPLD}</th>
        <th class="title">{$smarty.const._HWDVIDS_APPROVED}</th>
        <th class="title" width="50">{$smarty.const._HWDVIDS_FEATURED}</th>
        <th class="title" width="50">{$smarty.const._HWDVIDS_PUB}</th>
        <th class="title" width="30">{$smarty.const._HWDVIDS_ORDER}</th>
        <th class="title" width="40" colspan="2">{$smarty.const._HWDVIDS_REORDER}</th>
      </tr>
    </thead>
    <tbody>
      {foreach name=outer item=data from=$list_feat}
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
  </table>
</div>