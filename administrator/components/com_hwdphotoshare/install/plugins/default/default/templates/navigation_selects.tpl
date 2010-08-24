{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<div style="float:right;text-align:right;padding:5px;">

    {literal}
    <script language="javaScript">
      function goto_browse(form) { 
        var index=form.select_browse.selectedIndex
        if (form.select_browse.options[index].value != "0") {
          location=form.select_browse.options[index].value;
        }
      }
      function goto_sort(form) { 
        var index=form.select_order.selectedIndex
        if (form.select_order.options[index].value != "0") {
          location=form.select_order.options[index].value;
        }
      }
    </script>
    {/literal}

    <form name="redirect">
        <select name="select_browse" onchange="goto_browse(this.form)" size="1">
            <option value="{$JURL}/index.php?option=com_hwdphotoshare&Itemid=29" selected="selected">Browse by...</option>
            <option value="{$JURL}/index.php?option=com_hwdphotoshare&Itemid=29&task=albums">Albums</option>
            <option value="{$JURL}/index.php?option=com_hwdphotoshare&Itemid=29&task=photos">Photos</option>
            <option value="{$JURL}/index.php?option=com_hwdphotoshare&Itemid=29&task=groups">Groups</option>
            <option value="{$JURL}/index.php?option=com_hwdphotoshare&Itemid=29&task=categories">Categories</option>
        </select>
	{if $print_sortoptions}
        <select name="select_order" onchange="goto_sort(this.form)" size="1">
            <option value="" selected="selected">Sort by...</option>
            {$sort_options}
        </select>
        {/if}
    </form>

</div>



