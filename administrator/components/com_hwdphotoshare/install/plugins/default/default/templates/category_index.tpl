{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl"}

{include file="navigation_selects.tpl"}
<div style="clear:both;"></div>

<div class="standard">
  {if $print_categories}
    {foreach name=outer item=data from=$list}
      {include file="category_list.tpl"}
    {/foreach}
  {/if}
</div>

{include file="footer.tpl"}


