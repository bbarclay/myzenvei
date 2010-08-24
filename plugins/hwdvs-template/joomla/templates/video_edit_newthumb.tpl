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
//    This file generates the section of the video edit page that allows the user to upload a new thumbnail.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_NEWTHUMB}</h2>
<div class="standard">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td width="150">{$smarty.const._HWDVIDS_DETAILS_NEWTHUMB}</td>
      <td><input type="file" name="thumbnail_file" value="" size="30"></td>
    </tr>
    <tr>
      <td width="150"></td>
      <td>{$smarty.const._HWDVIDS_DETAILS_NEWTHUMB_DESC}</td>
    </tr>
  </table>
</div>
