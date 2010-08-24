{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="admin_header.tpl"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
  <thead>
  <tr>
    <td align="left"><h2>Finish hwdPhotoShare Setup</h2></td>
  </tr>
  </thead>
  <tbody>
  <tr align="left">
    <td>
      <input type="checkbox" name="cats" value="1" checked="checked">Install & publish sample categories<br /><br />
      <input type="submit" value="{$smarty.const._HWDPS_BUTTON_FINSET}">
    </td>
  </tr>
  </tbody>
</table>

{include file="admin_footer.tpl"}
