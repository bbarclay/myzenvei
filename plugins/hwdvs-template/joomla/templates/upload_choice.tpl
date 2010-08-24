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
//    This file generates the first upload page that allows the user to upload from their local computer or
//    from third party website.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

{include file='header.tpl'}

<form name="videoupload" action="{$form_upload}" method="post">
<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_UPLOADTYPE}</h2>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_DETAILS_VIDTYPE}</td>
      <td>
        <select name="videotype">
          <option value="00">{$smarty.const._HWDVIDS_SELECT_UPLDMETH01}</option>
          <option value="thirdparty" {$tpselect}>{$smarty.const._HWDVIDS_SELECT_UPLDADDTP}</option>
        </select>
      </td>
    </tr>
  </table>
</div>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150"></td>
      <td><input type="submit" name="send" class="inputbox" value="{$smarty.const._HWDVIDS_BUTTON_CONTINUE}" onClick="videoupload.send.disabled=true;document.videoupload.submit();" /></td>
    </tr>
  </table>
</div>
</form>
<!--{$supported_websites}-->

{include file='footer.tpl'}



