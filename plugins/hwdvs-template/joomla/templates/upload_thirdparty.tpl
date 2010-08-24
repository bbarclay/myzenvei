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
//    This file generates the display for adding a third party (external) video.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

{include file='header.tpl'}

<form name="videoadd" action="{$form_tp}" method="post" onsubmit="return chkaddform()">
<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_UPLDADDTP}</h2>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_VURL} <font class="required">*</font></td>
      <td><input name="embeddump" value="" class="inputbox" size="20" style="width: 200px;" /></td>
    </tr>
    <tr>
      <td>{$smarty.const._HWDVIDS_CATEGORY} <font class="required">*</font></td>
      <td>{$categoryselect}</td>
    </tr>
    <tr>
      <td colspan="2"><font class="required">*</font> {$smarty.const._HWDVIDS_INFO_REQUIREDFIELDS}</td>
    </tr>
  </table>
</div>

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_SUPWEB}</h2>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>{$supported_websites}</td>
    </tr>
  </table>
</div>

{include file='sharingoptions.tpl'}

<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150"></td>
      <td><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDVIDS_BUTTON_ADD}" /></td>
    </tr>
  </table>
</div>

<input type="hidden" name="videotype" value="".$videotype."" />
</form>

{include file='footer.tpl'}



