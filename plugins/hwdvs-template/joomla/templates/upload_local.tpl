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
//    This file generates the display when a user uploads a video from their local computer.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

{include file='header.tpl'}
	
<form name="videoupload" action="{$form_upload}" method="post" onsubmit="return chkform()">
<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_UPLOAD}</h2>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_TITLE} <font class="required">*</font></td>
      <td><input name="title" value="" class="inputbox" size="20" maxlength="50" style="width: 200px;" /></td>
    </tr>
    <tr>
      <td valign="top">{$smarty.const._HWDVIDS_DESC} <font class="required">*</font></td>
      <td valign="top"><textarea rows="4" cols="20" name="description" class="inputbox" style="width: 200px;"></textarea></td>
    </tr>
    <tr>
      <td>{$smarty.const._HWDVIDS_CATEGORY} <font class="required">*</font></td>
      <td>{$categoryselect}</td>
    </tr>
    <tr>
      <td>{$smarty.const._HWDVIDS_TAGS} <font class="required">*</font></td>
      <td>{$smarty.const._HWDVIDS_INFO_TAGS}</td>
    </tr>
    <tr>
      <td></td>
      <td><input name="tags" value="" class="inputbox" size="20" maxlength="500" style="width: 200px;" /></td>
    </tr>
    <tr>
      <td colspan="2"><font class="required">*</font> {$smarty.const._HWDVIDS_INFO_REQUIREDFIELDS}</td>
    </tr>
  </table>
</div>

{include file='sharingoptions.tpl'}

<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    {if $print_captcha}
    <tr>
      <td width="150"></td>
      <td>{$captcha}</td>
    </tr>
    <tr>
      <td>{$smarty.const._HWDVIDS_INFO_SECURECODE} <font class="required">*</font></td>
      <td><input id="security_code" name="security_code" type="text" /></td>
    </tr>
    {/if}
    <tr>
      <td width="150"></td>
      <td><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDVIDS_BUTTON_ADD}" /></td>
    </tr>
  </table>
</div>

<input type="hidden" name="videotype" value="local" />
</form>

{include file='footer.tpl'}



