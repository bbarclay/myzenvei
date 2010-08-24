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
//    This file generates the confirmation page after uploading a video.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- TO BE ADDED
//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_UPLOADSUCCESS}</h2>
<div class="standard">
  <p>{$smarty.const._HWDVIDS_INFO_SUCUPLD} <a href="{$videolink}"><b><i>{$uploadname}</i></b></a></p>
  <p>{$video_wait_message}</p>
  <p><a href="{$url_upld_another}">{$smarty.const._HWDVIDS_INFO_UPLDANOTHER}</a></p>
</div>

{include file='footer.tpl'}



