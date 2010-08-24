{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='admin_header.tpl'}
		
{literal}
<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == 'cancelphoto') {
		submitform( pressbutton );
		return;
	}
	if (pressbutton == 'homepage') {
		submitform( pressbutton );
		return;
	}
	
	if (form.title.value == "") {
		alert( "{/literal}{$smarty.const._HWDPS_ALERT_NOTITLE}{literal}" );
		return false;
	}
	if (form.tags.value == "") {
		alert( "{/literal}{$smarty.const._HWDPS_ALERT_NOTAG}{literal}" );
		return false;
	} 
	if (form.album_id.value == "-1") {
		alert( "{/literal}{$smarty.const._HWDPS_ALERT_NOALBUM}{literal}" );
		return false;
	}
	
	submitform( pressbutton );
	return;
}
</script>
{/literal}

{if $print_pending}
<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td width="50%" style="width:50%;" valign="top">
      <div style="margin:5px;border:solid 1px #ff0000;padding:5px;width:100%:">
        <center><b>This photo is <a href="index.php?option=com_hwdphotoshare&task=approvals">pending approval</a>.</b></center>        
      </div>
    </td>
  </tr>
</table>
{/if}

<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td colspan="2">
      <h1>Edit Photo Details</h1>
        <table cellpadding="4" cellspacing="0" border="0" width="100%">
          <tr>
            <td valign="top" align="left" width="60%">
              <table>
                <tr>
                  <td valign="top">{$smarty.const._HWDPS_TITLE}</td>
                  <td><input name="title" value="{$title}" size="55" maxlength="50"></td>
                </tr>
                <tr>
                  <td valign="top">{$smarty.const._HWDPS_ALBUM}</td>
                  <td>{$albumlist}</td>
                </tr>
                <tr>
                  <td valign="top">{$smarty.const._HWDPS_TAGS}</td>
                  <td><input name="tags" value="{$tags}" size="55" maxlength="500"></td>
                </tr>
                <tr>
                  <td valign="top">{$smarty.const._HWDPS_CAPTION}</td>
                  <td>{$caption}</td>
                </tr>
              </table>
            </td>
            <td valign="top" align="right" width="40%">
              {$startpane}
              {$starttab1}
              <table>
                <tr>
                  <td>{$smarty.const._HWDPS_PUB}</td>
                  <td>{$published}</td>
                </tr>
                <tr>
                  <td>{$smarty.const._HWDPS_FEATURED}</td>
                  <td>{$featured}</td>
                </tr>
                <tr>
                  <td>{$smarty.const._HWDPS_DATEUPLD}</td>
                  <td><input name="date_uploaded" value="{$dateuploaded}" size="20" maxlength="50"></td>
                </tr>
            
                
                
{literal}
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxChangeUser(){

	document.getElementById('ajaxChangeUserResponse').innerHTML = "<img src=\"{/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/icons/loading.gif\" border=\"0\" alt=\"\" title=\"\"> Loading...";
	
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			document.getElementById('ajaxChangeUserResponse').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "{/literal}{$mosConfig_live_site}{literal}/administrator/index.php?option=com_hwdphotoshare&task=changePhotoUserSelect&cid={/literal}{$row->id}{literal}", true);
	ajaxRequest.send(null);
}

//-->
</script>
{/literal}
                <tr>
                  <td>{$smarty.const._HWDPS_UPLOADER}</td>
                  <td><div id="ajaxChangeUserResponse">{$user} <span onclick="ajaxChangeUser();" style="cursor:pointer;">[{$smarty.const._HWDPS_CHANGEUSER}]</span></div></td>
                </tr>
              </table>
              {$endtab}
              {$starttab2}
              <table>
                <tr>
                  <td>{$smarty.const._HWDPS_ACCESS}</td>
                  <td>{$privacy}</td>
                </tr>
                <tr>
                  <td>{$smarty.const._HWDPS_ACOMMENTS}</td>
                  <td>{$allow_comments}</td>
                </tr>
                <tr>
                  <td>{$smarty.const._HWDPS_ARATINGS}</td>
                  <td>{$allow_ratings}</td>
                </tr>
              </table>
              {$endtab}
              {$endpane}
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>

{$hidden_inputs}
</form>

<table cellpadding="4" cellspacing="1" border="1" class="adminform">
  <tr>
    <td style="width:50%;padding: 5px;" valign="top">
        <h2>Photo Summary</h2>
        <h2><a href="{$photo_url}" target="_blank">View Photo</a></h2>
        <b>{$smarty.const._HWDPS_ALBUM}:</b> {$album_verified}<br />
        <b>{$smarty.const._HWDPS_TAGS}:</b> {$tags_verified}<br />
        <b>{$smarty.const._HWDPS_APPROVED}:</b> {$status}<br />

        <h2>Photo Statistics</h2>
        {$smarty.const._HWDPS_DATEUPLD}: <b>{$dateuploaded}</b><br />
        {$smarty.const._HWDPS_RATING}: <b>{$rating}</b><br />
        {$smarty.const._HWDPS_ACCESS}: <b>{$access}</b><br />
        {$smarty.const._HWDPS_APPROVED}: <b>{$status}</b><br />
        {$smarty.const._HWDPS_VIEWS}: <b>{$views}</b><br />
        {$smarty.const._HWDPS_UPLOADER}: <b>{$user}</b><br />
        {$smarty.const._HWDPS_FAVOURED}: <b>{$favoured}</b> {$smarty.const._HWDPS_TIMES}<br />

        <h2>Photo Thumbnails</h2>
        <div style="width:30%;padding:5px;float:left;text-align: center;">{$image_tn}</div>
        <div style="width:30%;padding:5px;float:left;text-align: center;">{$image_tn_square}</div>
        <div style="width:30%;padding:5px;float:left;text-align: center;">{$image_tn_square_reflected}</div>
        <div style="clear:both;"></div>
        
    </td>
    <td style="width:50%;padding: 5px;" valign="top">
        <h2>Main Photo Image</h2>
        <div style="padding:5px;text-align: center;">{$image_main}</div>
    </td>
  </tr>
</table>

{include file='admin_footer.tpl'}
