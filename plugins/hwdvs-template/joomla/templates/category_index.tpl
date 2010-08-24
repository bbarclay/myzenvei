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
//    This file generates the main category page that lists all the published categories 
//    and displays the number of videos and subcategories in each category.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- None, edit category_list.tpl instead
//////
*}

{include file='header.tpl'}

  {if $print_orderselect}
  <div style="float:right;text-align:right;padding:5px;">
    {literal}
    <script language="javaScript">
      function goto_sort(form) { 
        var index=form.select_order.selectedIndex
        if (form.select_order.options[index].value != "0") {
          location=form.select_order.options[index].value;
        }
      }
    </script>
    {/literal}
    <form name="redirect">
      <select name="select_order" onchange="goto_sort(this.form)" size="1">
        <option value="" selected="selected">{$smarty.const._HWDVIDS_TITLE_ORDERING}</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=orderASC">{$smarty.const._HWDVIDS_SELECT_ORDERING} ASC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=orderDESC">{$smarty.const._HWDVIDS_SELECT_ORDERING} DESC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=nameASC">{$smarty.const._HWDVIDS_SELECT_NAME} ASC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=nameDESC">{$smarty.const._HWDVIDS_SELECT_NAME} DESC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=novidsASC">{$smarty.const._HWDVIDS_SELECT_NOVIDS} ASC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=novidsDESC">{$smarty.const._HWDVIDS_SELECT_NOVIDS} DESC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=nosubsASC">{$smarty.const._HWDVIDS_SELECT_NOSUBS} ASC</option>
        <option value="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$Itemid}&task=categories&hwdcorder=nosubsDESC">{$smarty.const._HWDVIDS_SELECT_NOSUBS} DESC</option>
      </select>
    </form>
  </div>
  {/if}
  <div style="clear:both;"></div>
  
{if $print_categories}
<div class="standard">
  
  {foreach name=outer item=data from=$list}
    
    {if $smarty.foreach.outer.first}
      <div class="categoryBox"><div class="padding">
    {elseif $data->level eq 0}
      </div></div><div class="categoryBox"><div class="padding">      
    {else}
    {/if}

          {include file="category_list.tpl"}
	  
	  {if $smarty.foreach.outer.last}
	   <div style="clear:both;"></div></div></div>
	  {elseif $smarty.foreach.outer.index % $cpr-($cpr-1) == 0}
	   <!--<div style="clear:both;"></div>-->
	  {/if}
    
    {if $data->level eq 0}
    {else}
    {/if}
    
  {/foreach}
  <div style="clear:both;"></div>
  
</div>
{/if}

{include file='footer.tpl'}