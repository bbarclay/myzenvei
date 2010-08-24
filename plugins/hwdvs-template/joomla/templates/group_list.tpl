{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
//////
//    hwdVideoShare Template System:::This template system uses the Smarty Template Engine. 
//    For full documentation, including syntax usage please refer to http://www.smarty.net 
//    or our website at http://www.hwdmediashare.co.uk   
//////
//    This file generates the display for each group listing
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $thumbwidth..............The width for thumbnail images
//    -- $data->k.................The css identifier                                 
//    -- $data->thumbnail.........The thumbnail for the group (currently last video added)                        
//    -- $data->avatar............The avatar of the uploader                         
//    -- $data->groupmembership...The group membership button (join/leave group)                           
//    -- $data->reportgroup.......The report group button           
//    -- $data->grouptitle........The group title                          
//    -- $data->editgroup.........The edit group button                    
//    -- $data->deletegroup.......The delete group button                           
//    -- $data->groupdescription..The description of the group                            
//    -- $data->totalmembers......The total members in the group                            
//    -- $data->totalvideos.......The total videos in the group                       
//    -- $data->administrator.....The group administrator            
//////
*}

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
  <tr class="sectiontableentry{$data->k+1}">
    <td width="{$thumbwidth}" valign="top" rowspan="2">{$data->thumbnail}</td>
    <td width="*" valign="top">
      <div class="avatar">{$data->avatar}</div>
      <div style="float:right;text-align:right;"> 
        {$data->groupmembership}
        {$data->reportgroup}
      </div>
      <div class="listtitle">{$data->grouptitle} {$data->editgroup} {$data->deletegroup}</div>
      <div class="listdesc">{$data->groupdescription}</div>
      <div class="listgroupdetails">{$smarty.const._HWDVIDS_INFO_TOTMEM}: {$data->totalmembers} |
        {$smarty.const._HWDVIDS_INFO_TOTVID}: {$data->totalvideos} |
        {$smarty.const._HWDVIDS_INFO_CREATEDBY} {$data->administrator}
      </div>
    </td>
  </tr>
</table>