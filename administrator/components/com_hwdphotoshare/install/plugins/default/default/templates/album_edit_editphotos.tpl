{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{foreach name=outer item=data from=$albumphotoslist}
    <div class="standard">
        {include file="photo_list_edit.tpl"}
    </div>
{/foreach}

