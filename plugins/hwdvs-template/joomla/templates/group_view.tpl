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
//    This file generates the display for the 'view group' page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $group->deletegroup.......The delete group button  
//    -- $group->editgroup.........The edit group button   
//    -- $group->totalmembers......The total number of members in the group
//    -- $group->totalvideos.......The total number of videos in the group
//    -- $group->administrator.....The group administrator
//    -- $group->groupmembership...The group membership button (join/leave group)
//    -- $group->reportgroup.......The report group button   
//    -- $group->comments..........The group comments 
//    -- $group_name...............The name of the group
//    -- $group_description........The description of the group
//    -- $print_memberslist........Only set if group has any members
//    -- $memberslist..............Array containing the details of group members
//    -- $print_videolist..........Only set if group has any videos
//    -- $list.....................Array containing the details of group videos 
//////
*}

{include file='header.tpl'}

<div style="padding:5px;float:right;">
  {$group->deletegroup}<br />
  {$group->editgroup}
</div>

<h2 class="contentheading">{$group_name}</h2>
<p>{$group_description}</p>

<div class="standard">
  <div style="padding:5px;text-align:center;">
    {$smarty.const._HWDVIDS_INFO_TOTMEM}: {$group->totalmembers} |
    {$smarty.const._HWDVIDS_INFO_TOTVID}: {$group->totalvideos} |
    {$smarty.const._HWDVIDS_INFO_CREATEDBY} {$group->administrator}
    <div style="clear:both;margin:3px;"></div>
    {$group->groupmembership}
    {$group->reportgroup}
  </div>
  <div style="clear:both;"></div>
</div>

<h2 class="contentheading">{$smarty.const._HWDVIDS_DETAILS_MEMBERSG}</h2>

<div class="standard">
  <div style="padding:5px;text-align:center;">
    {if $print_memberslist}
      {foreach name=outer item=data from=$memberslist}
        {$data->username}{if $smarty.foreach.outer.last}{else},{/if}
      {/foreach}
    {else}
      <div class="padding">{$fpempty}</div>
    {/if}
  </div>
</div>

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_GRPVIDS}</h2>
<div class="standard">
  {if $print_videolist}
    {foreach name=outer item=data from=$list}
      {include file='video_list.tpl'}
    {/foreach}
  {else}
    <div class="padding">{$smarty.const._HWDVIDS_INFO_NGV}</div>
  {/if}
  {$pageNavigation}
</div>

{if $print_comments}
  <h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_GROUPCOMMS}</h2>
  <div class="standard">{$group->comments}</div>
{/if}  
		
{include file='footer.tpl'}










