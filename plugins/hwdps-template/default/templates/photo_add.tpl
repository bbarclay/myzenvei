{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl" title=foo}


{literal}
<style>
/* DEFINITION LIST PROGRESS BAR */

#pb dl, dt, dd{margin:0;padding:0;}

#pb dd{
	width:116px;
	height:22px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/assets/images/capacity/bg_bar.gif) no-repeat 0 0;
	position:relative;
}
#pb dd span{
	position:absolute;
	display:block;
	width:100px;
	height:13px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/assets/images/capacity/bar.gif) no-repeat 0 0;
	top:4px;
	left:4px;
	overflow:hidden;
	text-indent:-8000px;
}
#pb dd em{
	position:absolute;
	display:block;
	width:100px;
	height:13px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/assets/images/capacity/bg_cover.gif) repeat-x;
	top:0;
}

/* SINGLE PROGRESS BAR */

#pb .progressBar{
	width:116px;
	height:22px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/assets/images/capacity/bg_bar.gif) no-repeat 0 0;
	position:relative;
}
#pb .progressBar span{
	position:absolute;
	display:block;
	width:100px;
	height:13px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/assets/images/capacity/bar.gif) no-repeat 0 0;
	top:4px;
	left:4px;
	overflow:hidden;
	text-indent:-8000px;
}
#pb .progressBar em{
	position:absolute;
	display:block;
	width:100px;
	height:13px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/assets/images/capacity/bg_cover.gif) repeat-x 0 0;
	top:0;
}
</style>
<script language="javascript">
    
    function ShowBasicPane(){

	document.getElementById("basicuploader").style.visibility="visible";
	document.getElementById("basicuploader").style.height="auto";
	document.getElementById("advanceduploader").style.visibility="hidden";
	document.getElementById("advanceduploader").style.height="0px";
	document.getElementById('uploaderlink').innerHTML = '<a href="#" onClick="ShowAdvancedPane();return false;">Looking for the advanced uploader?</a>';
	return false;
	
    }

    function ShowAdvancedPane(){

	document.getElementById("advanceduploader").style.visibility="visible";
	document.getElementById("advanceduploader").style.height="auto";
	document.getElementById("basicuploader").style.visibility="hidden";
	document.getElementById("basicuploader").style.height="0px";
	document.getElementById('uploaderlink').innerHTML = '<a href="#" onClick="ShowBasicPane();return false;">Looking for the basic uploader?</a>';
        return false;
    
    }

    extArray = new Array(".jpg", ".jpeg", ".gif", ".png");
    function LimitAttach(form, file) {
	
	allowSubmit = false;
	if (!file) return;
	while (file.indexOf("\\") != -1)
	file = file.slice(file.indexOf("\\") + 1);
	ext = file.slice(file.lastIndexOf(".")).toLowerCase();
	for (var i = 0; i < extArray.length; i++) {
	if (extArray[i] == ext) { allowSubmit = true; break; }
	}
	if (allowSubmit) return true;
	else
	alert("Please only upload files that end in types:  "
	+ (extArray.join("  ")) + "\nPlease select a new "
	+ "file to upload and submit again.");
	return false;
	
    }
    
    function checkform() {
    
	document.getElementById('basicindicator').style.visibility="visible";
	document.getElementById('basicindicator').style.border="1px solid #fff";
	document.getElementById('basicindicator').style.padding="5px";
	document.getElementById('basicindicator').style.margin="5px 0 5px 0";
	document.getElementById('basicindicator').innerHTML = "{/literal}{$smarty.const._HWDPS_INFO_PROCESSINGWAIT}{literal}";
	document.getElementById('uploadButton').disabled=true;
   
    }
    
    fields = 0;

    function addInput() {

	if (fields != 7) {
	var count   = fields+3;
	var innerID = "text_" + count;
	
	document.getElementById(innerID).innerHTML += "<input type='file' name='upfile_" + count + "' size='40' value='' /><br />";


	fields += 1;
	} else {
	document.getElementById('text_full').innerHTML += "<br />Only 10 upload fields allowed.";
	document.form_upload.add.disabled=true;
	}
	
    }
</script> 

{/literal}

<div style="text-align:right;padding:5px;">
<a href="{$link_editalbum}" title="{$smarty.const._HWDPS_EDITALBUM}">{$smarty.const._HWDPS_EDITALBUM}</a> | 
<a href="{$link_createalbum}" title="{$smarty.const._HWDPS_CNA}">{$smarty.const._HWDPS_CNA}</a> | 
<a href="{$link_viewalbums}" title="{$smarty.const._HWDPS_VA}">{$smarty.const._HWDPS_VA}</a> | 
<a href="{$link_albumprivacy}" title="{$smarty.const._HWDPS_ALBUMPRIVACY}">{$smarty.const._HWDPS_ALBUMPRIVACY}</a> 
</div>

<div class="standard">
  <h2>{$smarty.const._HWDPS_ADDPHOTOS} {$album_delete} {$album_edit} {$album_addphotos}</h2>
  
    <div class="padding">
    
    {if $show_applet}
      <div style="float:right" id="uploaderlink"><a href="#" onClick="ShowBasicPane();return false;">{$smarty.const._HWDPS_LFTBU}</a></div>
    {/if}   

    {$smarty.const._HWDPS_USAGE} {$users_storage}/{$users_limit}MB ({$users_percentage}%)<br />
    <div id="pb">
      <div class="progressBar">
        <span><em style="left:{$users_percentage}px">{$users_percentage}%</em></span>
      </div>
    </div>  
  
  </div>
</div>					

<div class="standard">

  {if $show_applet}
    <div id="advanceduploader">
      <div class="padding">{$smarty.const._HWDPS_NEEDJAVA}<br /><a href="#" onClick="ShowBasicPane();return false;">{$smarty.const._HWDPS_NOJAVA}</a></div>
                    
      <!-- InstanceBeginEditable name="doc_content" -->
      <div style=" height: 500px;">
        <applet name="jumpLoaderApplet"
	  code="jmaster.jumploader.app.JumpLoaderApplet.class"
	  archive="{$mosConfig_live_site}/components/com_hwdphotoshare/assets/uploads/jumpuploader/jumploader_z.jar"
	  width="100%"
	  height="500"
	  mayscript>
    	  <param name="uc_imageEditorEnabled" value="true"/>
	  <param name="uc_uploadUrl" value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=jumpupload&album_id={$album_id}"/>
	  <param name="uc_addImagesOnly" value="true"/>
	  <param name="ac_fireUploaderStatusChanged" value="true"/> 
	  <param name="vc_disableLocalFileSystem" value="false"/> 
	  <param name="vc_mainViewFileTreeViewVisible" value="true"/> 
	  <param name="vc_fileTreeViewShowFiles" value="true"/> 
	  <param name="vc_mainViewFileListViewVisible" value="true"/> 
        </applet>
      </div>
      <!-- InstanceEndEditable -->
                  
      {literal}
        <script type="text/javascript">
          var uploader = document.jumpLoaderApplet.getUploader();
          function uploaderStatusChanged( uploader ) {
            if (uploader.getStatus() == 0) {
              location.href = "{/literal}{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=editalbum&Itemid={$Itemid}&album_id={$album_id}&category_id={$category_id}{literal}";
            }
          }
        </script> 
      {/literal}
    
    </div>
  {/if} 

  {if $show_applet}
    <div id="basicuploader" style="visibility: hidden; height: 0px;">
  {/if}                    

  <div class="padding">
    
    <b>{$smarty.const._HWDPS_INFO_LIMUPLD} {$max_basic_upload}MB</b>

    <!-- Start Upload Form -->
    <form name="form_upload" method="post" enctype="multipart/form-data" action="{$PHPFORMURL}" style="margin: 0px; padding: 0px;" onsubmit="return checkform()">
	{$PHPHIDDENINPUTS}		
	<input type="file" name="upfile_0" size="40" value="" /><br />
	<input type="file" name="upfile_1" size="40" value="" /><br />
	<input type="file" name="upfile_2" size="40" value="" /><br />
	<div id="text_3"></div>
	<div id="text_4"></div>
	<div id="text_5"></div>
	<div id="text_6"></div>
	<div id="text_7"></div>
	<div id="text_8"></div>
	<div id="text_9"></div>
	<div id="text_full"></div>
	<input type="button" onclick="addInput()" name="add" value="Add more photos" />
	<div id="basicindicator"></div>
	<noscript><br /><input type="submit" name="no_script_submit" id="uploadButton" value="Upload" /></noscript>
	<br />
	<script language="javascript" type="text/javascript">
	    <!--
	    document.writeln('<input type="submit" name="no_script_submit" id="uploadButton" onclick="return LimitAttach(this.form, this.form.upfile_0.value)" class="inputbox" value="{$smarty.const._HWDPS_BUTTON_UPLOAD}">');
	    //-->
	</script>
    </form>		
    <!-- End Upload Form -->                    

  </div>

  {if $show_applet}
    </div>
  {/if}  

</div>	

{include file="footer.tpl"}





