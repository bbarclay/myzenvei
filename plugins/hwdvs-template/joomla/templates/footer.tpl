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
//    This file generates the footer of hwdVideoShare and closes any <div> tags that were originally
//    opened in the header.tpl file. 
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $print_ads.........Only set if hwdRevenueManager is installed
//    -- $sc................Only set if hwdVideoShare is configured to display a credit link                            
//    -- $cl................"Powered by" message                               
//    -- $sr................Only set if the rounded corners option is enabled
//////
*}

{if $print_ads}{if $advert5}<div id="hwdadverts-padding">{$advert5}</div>{/if}{/if}

<div class="hwdvsfooter"><a href="{$rss_recent}" style="float:right;"><img src="{$URL_HWDVS_IMAGES}rss.png" border="0" alt="RSS" title="RSS" /></a>{if $sc}{$cl}{/if}<div style="clear:both;"></div></div>

</div>