{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<form action={$JURL}/index.php?option=com_hwdphotoshare&Itemid={$hwdps_params.mod_hwd_itemid}&task=search" method="post" name="hwd_vs_mod_search">
  <div id="mod_hwdvssearchbar" class="mod_hwdvssearchbar">
    {$category_select}
    <div style="padding:2px 0;">
      <input type="text" name="pattern" value="{$input_text}" class="inputbox" onchange="document.adminForm.submit();" onblur="if(this.value=='') this.value='{$input_text}';" onfocus="if(this.value=='{$input_text}') this.value='';" />
    </div>
  </div>
</form>