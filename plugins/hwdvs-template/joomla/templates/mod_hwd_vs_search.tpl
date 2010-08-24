<form action={$mosConfig_live_site}/index.php?option=com_hwdvideoshare&Itemid={$hwdvids_params.mod_hwd_itemid}&task=search" method="post" name="hwd_vs_mod_search">
  <div id="mod_hwdvssearchbar" class="mod_hwdvssearchbar">
    {if $showcategories}
    <div style="padding:2px 0;">
      {$category_select}
    </div>
    {/if}
    <div style="padding:2px 0;">
      <input type="text" name="pattern" value="{$input_text}" class="inputbox" onchange="document.adminForm.submit();" onblur="if(this.value=='') this.value='{$input_text}';" onfocus="if(this.value=='{$input_text}') this.value='';" />
    </div>
    {if $showbutton}
    <div style="padding:2px 0;">
      <input type="submit" value="{$input_text}">
    </div>
    {/if}
  </div>
</form>