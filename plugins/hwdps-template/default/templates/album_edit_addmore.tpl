{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{literal}
<style>
/* DEFINITION LIST PROGRESS BAR */

#pb dl, dt, dd{margin:0;padding:0;}

#pb dd{
	width:116px;
	height:22px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/bg_bar.gif) no-repeat 0 0;
	position:relative;
}
#pb dd span{
	position:absolute;
	display:block;
	width:100px;
	height:13px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/bar.gif) no-repeat 0 0;
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
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/bg_cover.gif) repeat-x;
	top:0;
}

/* SINGLE PROGRESS BAR */

#pb .progressBar{
	width:116px;
	height:22px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/bg_bar.gif) no-repeat 0 0;
	position:relative;
}
#pb .progressBar span{
	position:absolute;
	display:block;
	width:100px;
	height:13px;
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/bar.gif) no-repeat 0 0;
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
	background:url({/literal}{$mosConfig_live_site}{literal}/components/com_hwdphotoshare/images/bg_cover.gif) repeat-x 0 0;
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
</script>
{/literal}
					


    <div class="standard">
<div style="float:right" id="uploaderlink"><a href="#" onClick="ShowBasicPane();return false;">Looking for the basic uploader?</a></div>
        Your Usage is {$users_storage}MB out of {$users_limit}MB ({$users_percentage}%)<br />
        <div id="pb">
        <div class="progressBar">
	    <span><em style="left:{$users_percentage}px">{$users_percentage}%</em></span>
	</div>
	</div>
        
    </div>
    <div class="standard">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>

                
               
                    
<div id="advanceduploader">
<div class="javareq">The <b>Java Runtime Environment</a> is required to run the photo upload applet. If you do not have Java you please download and install from <a href="http://www.java.com/en/download/" target="_blank">Sun website</a>.
It is necessary to activate applet once it is loaded by clicking it, so don't get confused if your first input event will not success with expected action.
</div>
                    
 				  <!-- InstanceBeginEditable name="doc_content" -->
<div  style=" height: 500px;">
<applet name="jumpLoaderApplet"
	code="jmaster.jumploader.app.JumpLoaderApplet.class"
	archive="{$mosConfig_live_site}/components/com_hwdphotoshare/uploads/jumpuploader/jumploader_z.jar"
	width="100%"
	height="500"
	mayscript>
    	<param name="uc_imageEditorEnabled" value="true"/>
	<param name="uc_uploadUrl" value="{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=jumpupload&album_id={$album_id}"/>
	<param name="uc_addImagesOnly" value="true"/>
	<param name="ac_fireUploaderStatusChanged" value="true"/> 
</applet>
</div>				  <!-- InstanceEndEditable -->
                   
{literal}
<script type="text/javascript">
var uploader = document.jumpLoaderApplet.getUploader();
function uploaderStatusChanged( uploader ) {
if (uploader.getStatus() == 0) {
location.href = "{/literal}{$mosConfig_live_site}/index.php?option=com_hwdphotoshare&task=editalbum&Itemid={$Itemid}&album_id={$album_id}{literal}";
}
}
</script> 
{/literal}
</div>



<div id="basicuploader" style="visibility: hidden; height: 0px;">
                    {literal}
                    <script type="text/javascript">
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
                    function checkform()
                    {
                        document.getElementById('basicindicator').style.visibility="visible";
                        document.getElementById('basicindicator').style.border="1px solid #fff";
                        document.getElementById('basicindicator').style.padding="5px";
                        document.getElementById('basicindicator').style.margin="5px 0 5px 0";
                        document.getElementById('basicindicator').innerHTML = "{/literal}{$smarty.const._HWDPS_INFO_PROCESSINGWAIT}{literal}";
                        document.getElementById('uploadButton').disabled=true;
                    }
                    </script>
                    {/literal}
                    <div><b>{$smarty.const._HWDPS_INFO_LIMUPLD} {$max_basic_upload}MB</b></div>

                    <!-- Start Upload Form -->
                    <form name="form_upload" method="post" enctype="multipart/form-data" action="{$PHPFORMURL}" style="margin: 0px; padding: 0px;" onsubmit="return checkform()">
	                {$PHPHIDDENINPUTS}		
                        <input type="file" name="upfile_0" size="40" value="" /><br />
                        <input type="file" name="upfile_1" size="40" value="" /><br />
                        <input type="file" name="upfile_2" size="40" value="" /><br />
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
                    
                </td>
            </tr>
        </table>
    </div>