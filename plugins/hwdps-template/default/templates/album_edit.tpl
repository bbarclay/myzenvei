{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl"}

<div class="standard">
  <h2>{$smarty.const._HWDPS_EDITALBUM} {$album_delete} {$album_edit} {$album_addphotos}</h2>

  <div style="text-align:right;padding:5px;">
    <a href="{$link_addphotos}" title="{$smarty.const._HWDPS_UPLOADPHOTOS}">{$smarty.const._HWDPS_UPLOADPHOTOS}</a> | 
    <a href="{$link_createalbum}" title="{$smarty.const._HWDPS_CREATENEWALBUM}">{$smarty.const._HWDPS_CREATENEWALBUM}</a> | 
    <a href="{$link_viewalbums}" title="{$smarty.const._HWDPS_VIEWYOURALBUMS}">{$smarty.const._HWDPS_VIEWYOURALBUMS}</a> | 
    <a href="{$link_albumprivacy}" title="{$smarty.const._HWDPS_ALBUMPRIVACY}">{$smarty.const._HWDPS_ALBUMPRIVACY}</a> 
  </div>

  <div class="padding">
  {$startpane}
    {if $print_phototab}
    {$starttab0}
        {include file="album_edit_editphotos.tpl"}
    {$endtab}
    {/if}
    {$starttab2}
        {include file="album_edit_editinfo.tpl"}
    {$endtab}
    {if $print_phototab}
    {$starttab4}
        {include file="album_edit_organise.tpl"}
    {$endtab}
    {/if}
    {$starttab3}
        {include file="album_edit_delete.tpl"}
    {$endtab}
  {$endpane}
  </div>

</div>

<div style="clear:both;"></div>

{include file="footer.tpl"}
