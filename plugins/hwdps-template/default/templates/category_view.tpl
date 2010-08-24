{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='header.tpl'}

{literal}
<script type="text/javascript">

document.write('<style type="text/css">.tabber{display:none;}<\/style>');

var tabberOptions = {

  'manualStartup':true,

  'onLoad': function(argsObj) {
    if (argsObj.tabber.id == 'tab2') {
      alert('Finished loading tab2!');
    }
  },

  'onClick': function(argsObj) {

    var t = argsObj.tabber; 
    var id = t.id; 
    var i = argsObj.index; 
    var e = argsObj.event;

    if (id == 'tab2') {
      return confirm('Swtich');
    }
  },

  'addLinkId': true

};
</script>
{/literal}
<script type="text/javascript" src="{$link_home}/plugins/hwdps-template/default/js/tabber.js"></script>

{include file="navigation_selects.tpl"}
<div class="standard">
    <h2>{$smarty.const._HWDPS_TITLE_CATEGORYA} ({$category_name})</h2>
        {if $print_subcategories}

        <div class="tabber" id="tab1">
            <div class="tabbertab">
                <h2><a name="tab1">Albums</a></h2>
                {if $print_albumlist}
                    {foreach name=outer item=data from=$list}
                        <div class="albumBox">
                            {include file="album_list.tpl"}
                        </div>
                        {if $smarty.foreach.outer.last}
                            <div style="clear:both;"></div>
                        {elseif $smarty.foreach.outer.index % $apr-($apr-1) == 0}
                            <div style="clear:both;"></div>
                        {/if}
                    {/foreach}
                {else}
                    <div class="padding">{$smarty.const._HWDPS_INFO_NCA}</div>
                {/if}
                {$pageNavigation}
            </div>
            <div class="tabbertab">
                <h2>Subcategories</h2>
                <div class="padding">
                    {foreach name=outer item=data from=$subcatlist}
                        {include file="category_list.tpl"}
                    {/foreach}
                </div>
            </div>
        </div>

        {else}

        {if $print_albumlist}
            {foreach name=outer item=data from=$list}
                <div class="albumBox">
                    {include file="album_list.tpl"}
                </div>
                {if $smarty.foreach.outer.last}
                    <div style="clear:both;"></div>
                {elseif $smarty.foreach.outer.index % $apr-($apr-1) == 0}
                    <div style="clear:both;"></div>
                {/if}
            {/foreach}
        {else}
            <div class="padding">{$smarty.const._HWDPS_INFO_NCA}</div>
        {/if}
        {$pageNavigation}

        {/if}
</div>
	
<script type="text/javascript">
tabberAutomatic(tabberOptions);
</script>

{include file='footer.tpl'}

	

