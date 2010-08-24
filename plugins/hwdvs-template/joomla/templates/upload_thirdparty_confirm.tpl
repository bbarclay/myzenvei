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
//    This file generates the confirmation page after a third party (external) video has been added.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $uploadname...........The name of the uploaded video
//    -- $waitmessage..........The text to say either "the video has been added" or "the video is waiting approval"                      
//    -- $url_upld_another.....The url to upload another video              
//    -- $failures.............Details of any failures when getting the video information            

//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$smarty.const._HWDVIDS_TITLE_UPLOADSUCCESS}</h2>
<div class="standard">
  <p>{$smarty.const._HWDVIDS_INFO_SUCUPLD} <a href="{$videolink}"><b><i>{$uploadname}</i></b></a></p>
  <p>{$waitmessage}</p>
  <p><a href="{$url_upld_another}">{$smarty.const._HWDVIDS_INFO_UPLDANOTHER}</a></p>
  <p><b>{$failures}</b></p>
</div>

{if $showEditForm}
{include file='video_edit_form.tpl'}
{/if}

{include file='footer.tpl'}



