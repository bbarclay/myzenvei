{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="admin_header.tpl"}
<input type="hidden" name="limitstart" value="0" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="option" value="com_hwdphotoshare" />
<input type="hidden" name="task" value="import" />
<input type="hidden" name="hidemainmenu" value="0">
</form>	

{$startpane}
    {$starttab1}
        {include file="admin_import_ftp.tpl"}
    {$endtab}
    {$starttab2}
        {include file="admin_import_remote.tpl"}
    {$endtab}
    {$starttab3}
        {include file="admin_import_sql.tpl"}
    {$endtab}
    {$starttab4}
        {include file="admin_import_csv.tpl"}
    {$endtab}
    {$starttab5}
        {include file="admin_import_seyret.tpl"}
    {$endtab}
    {$starttab7}
        {include file="admin_import_achtube.tpl"}
    {$endtab}
    {$starttab6}
        {include file="admin_import_phpmotion.tpl"}
    {$endtab}
{$endpane}

<form action="index.php" method="post">
{include file="admin_footer.tpl"}
