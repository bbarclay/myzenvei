{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='admin_header.tpl'}
		
{$startpane}
    {$starttab1}
        {include file='admin_reported_videos.tpl'}
    {$endtab}
    {$starttab2}
        {include file='admin_reported_groups.tpl'}
    {$endtab}
{$endpane}

{include file='admin_footer.tpl'}
