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
//    This file generates the frontend group edit page.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $form_add_group.......The URL topost the 'edit group' form
//    -- $title................The original title of the group                               
//    -- $description..........The original description of the group                                  
//////
*}

{include file='header.tpl'}

<form name="editGroup" action="{$form_edit_group}" method="post">
<h3 class="componentheading">{$smarty.const._HWDVIDS_DETAILS_EDITG}</h3>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="4" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_TITLE} <font class="required">*</font></td>
      <td><input name="group_name" value="{$title}" class="inputbox" size="20" maxlength="100" style="width: 200px;" /></td>
    </tr>
    <tr>
      <td valign="top">{$smarty.const._HWDVIDS_DESC} <font class="required">*</font></td>
      <td valign="top"><textarea rows="4" cols="20" name="group_description" class="inputbox" style="width: 200px;">{$description}</textarea><br /></td></tr>
    <tr>
      <td colspan="2"><font class="required">*</font> {$smarty.const._HWDVIDS_INFO_REQUIREDFIELDS}</td>
    </tr>
  </table>
</div>
<h3 class="componentheading">{$smarty.const._HWDVIDS_TITLE_OPTIONS}</h3>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="4" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_ACCESS}</td>
      <td>
        <select name="public_private">
          <option value="public" selected>{$smarty.const._HWDVIDS_SELECT_PUBLIC}</option>
          <option value="registered">{$smarty.const._HWDVIDS_SELECT_REG}</option>
        </select>
      </td>
    </tr>
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_ACOMMENTS}</td>
      <td>
        <select name="allow_comments">
          <option value="1" selected>{$smarty.const._HWDVIDS_SELECT_ALLOWCOMMS}</option>
          <option value="0">{$smarty.const._HWDVIDS_SELECT_DONTALLOWCOMMS}</option>
        </select>
      </td>
    </tr>
  </table>
</div>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="4" border="0">
    <tr>
      <td width="150"></td>
      <td><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDVIDS_BUTTON_UPDT}" onClick="videoupload.send.disabled=true;" />&#160;<input type="button" class="inputbox" value="{$smarty.const._HWDVIDS_BUTTON_CANX}" onClick="javascript:history.go(-1)"/></td>
    </tr>
  </table>
</div>
<input type="hidden" name="id" value="{$rowid}" />
<input type="hidden" name="require_approval" value="0"/>
</form>

<!-- UNDER DEVELOPMENT
<div style="width:50%;float:left;">
<form name="creategroup" action="{$form_add_group}" method="post" onsubmit="return chkform()">
<h5 class="hwdheader">{$smarty.const._HWDVIDS_TITLE_GRPMEMS}</h5>
<div class="uploadform">
<table width="100%" cellpadding="0" cellspacing="4" border="0">
<tr>
<td width="150">Under Development</td>
</r>
</table>
</div>
</form>
</div>
<div style="width:50%;float:right;">
<form name="creategroup" action="{$form_add_group}" method="post" onsubmit="return chkform()">
<h5 class="hwdheader">{$smarty.const._HWDVIDS_TITLE_GRPVIDS}</h5>
<div class="uploadform">
{if $print_grp_members}
{foreach name=outer item=data from=$grp_memberlist}
{$data->member_id}
{$data->member_username}
{/foreach}
{else}
Under Development
{/if}
</div>
</form>
</div>
<div style="clear:both;" />
-->

{include file='footer.tpl'}
