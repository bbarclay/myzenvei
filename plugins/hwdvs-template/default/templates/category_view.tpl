{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='header.tpl'}

<div class="standard">
  <h2>{$smarty.const._HWDVIDS_TITLE_CATEGORYVIDS} ({$category_name})</h2>
  <!--<div class="padding">{$category_description}</div>-->
  
  {if $print_subcats}
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
  <script type="text/javascript" src="{$link_home}/plugins/hwdvs-template/default/js/tabber.js"></script>
  
  <div class="tabber" id="tab1">
    <div class="tabbertab">
      <h2><a name="tab1">{$smarty.const._HWDVIDS_VIDEOS}</a></h2>
      {if $print_videolist}

        {foreach name=outer item=data from=$list}
          <div style="width: 30%; float:left;">
            {include file="video_list_full.tpl"}
          </div>
          {if $smarty.foreach.outer.last}
            <div style="clear:both;"></div>
          {elseif $smarty.foreach.outer.index % 3-2 == 0}
            <div style="clear:both;"></div>
          {/if}
        {/foreach}

      {else}

        <div class="padding">{$smarty.const._HWDVIDS_INFO_NCV}</div>

      {/if}
      {$pageNavigation}
    </div>
    <div class="tabbertab">
      <h2>{$smarty.const._HWDVIDS_SUBCATS}</h2>
        <div class="categories">
          {foreach name=outer item=data from=$subcatlist}
            {include file='category_list.tpl'}
          {/foreach}
        </div>
      </div>
    </div>
  
  {else}
  
    {if $print_videolist}
      
      {foreach name=outer item=data from=$list}
        <div style="width: 30%; float:left;">
          {include file="video_list_full.tpl"}
        </div>
        {if $smarty.foreach.outer.last}
          <div style="clear:both;"></div>
        {elseif $smarty.foreach.outer.index % 3-2 == 0}
          <div style="clear:both;"></div>
        {/if}
      {/foreach}

    {else}

      <div class="padding">{$smarty.const._HWDVIDS_INFO_NCV}</div>
  
    {/if}
    {$pageNavigation}
    
  {/if}
  
</div>

<script type="text/javascript">
tabberAutomatic(tabberOptions);
</script>

{include file='footer.tpl'}
