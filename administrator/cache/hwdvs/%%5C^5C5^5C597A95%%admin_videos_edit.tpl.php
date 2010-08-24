<?php /* Smarty version 2.6.26, created on 2010-03-05 14:10:49
         compiled from admin_videos_edit.tpl */ ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
<?php echo '
<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton == \'cancelvid\') {
		submitform( pressbutton );
		return;
	}
	if (pressbutton == \'homepage\') {
		submitform( pressbutton );
		return;
	}
	// do field validation
	if (form.title.value == ""){
		alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOTITLE; ?>
<?php echo '" );
		return false;
	//} if (form.description.value == ""){
	//	alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NODESC; ?>
<?php echo '" );
	//	return false;
	//} if (form.tags.value == ""){
		alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOTAG; ?>
<?php echo '" );
		return false;
	} if (form.category_id.value == "-1"){
		alert( "'; ?>
<?php echo @_HWDVIDS_ALERT_NOCAT; ?>
<?php echo '" );
		return false;
	} else {
		submitform( pressbutton );
		return;
	}
}
</script>
'; ?>


<?php if ($this->_tpl_vars['print_pending']): ?>
<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td width="50%" style="width:50%;" valign="top">
      <div style="margin:5px;border:solid 1px #ff0000;padding:5px;width:100%:">
        <center><b>This video is <a href="index.php?option=com_hwdvideoshare&task=approvals">pending approval</a>.</b></center>        
      </div>
    </td>
  </tr>
</table>
<?php endif; ?>

<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td colspan="2">
      <h1>Edit Video Details</h1>
        <table cellpadding="4" cellspacing="0" border="0" width="100%">
          <tr>
            <td valign="top" align="left" width="60%">
              <table>
                <tr>
                  <td valign="top"><?php echo @_HWDVIDS_TITLE; ?>
</td>
                  <td><input name="title" value="<?php echo $this->_tpl_vars['title']; ?>
" size="55" maxlength="50"></td>
                </tr>
                <tr>
                  <td valign="top"><?php echo @_HWDVIDS_CATEGORY; ?>
</td>
                  <td><?php echo $this->_tpl_vars['categorylist']; ?>
</td>
                </tr>
                <tr>
                  <td valign="top"><?php echo @_HWDVIDS_TAGS; ?>
</td>
                  <td><input name="tags" value="<?php echo $this->_tpl_vars['tags']; ?>
" size="55" maxlength="500"></td>
                </tr>
                <tr>
                  <td valign="top"><?php echo @_HWDVIDS_DESC; ?>
</td>
                  <td><?php echo $this->_tpl_vars['description']; ?>
</td>
                </tr>
              </table>
            </td>
            <td valign="top" align="right" width="40%">
              <?php echo $this->_tpl_vars['startpane']; ?>

              <?php echo $this->_tpl_vars['starttab1']; ?>

              <table>
                <tr>
                  <td><?php echo @_HWDVIDS_PUB; ?>
</td>
                  <td><?php echo $this->_tpl_vars['published']; ?>
</td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_FEATURED; ?>
</td>
                  <td><?php echo $this->_tpl_vars['featured']; ?>
</td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_DATEUPLD; ?>
</td>
                  <td><input name="date_uploaded" value="<?php echo $this->_tpl_vars['dateuploaded']; ?>
" size="20" maxlength="50"></td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_LENGTH; ?>
</td>
                  <td><input name="video_length" value="<?php echo $this->_tpl_vars['duration']; ?>
" size="20" maxlength="50"></td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_THUMBPOS; ?>
</td>
                  <td><input name="thumb_snap" value="<?php echo $this->_tpl_vars['thumb_snap']; ?>
" size="20" maxlength="50"></td>
                </tr>                
                
                
<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxChangeUser(){

	document.getElementById(\'ajaxChangeUserResponse\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'ajaxChangeUserResponse\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=changeuserselect&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>

                <tr>
                  <td><?php echo @_HWDVIDS_UPLOADER; ?>
</td>
                  <td><div id="ajaxChangeUserResponse"><?php echo $this->_tpl_vars['user']; ?>
 <span onclick="ajaxChangeUser();" style="cursor:pointer;">[<?php echo @_HWDVIDS_CHANGEUSER; ?>
]</span></div></td>
                </tr>
              </table>
              <?php echo $this->_tpl_vars['endtab']; ?>

              <?php echo $this->_tpl_vars['starttab2']; ?>

              <table>
                <tr>
                  <td><?php echo @_HWDVIDS_ACCESS; ?>
</td>
                  <td><?php echo $this->_tpl_vars['public_private']; ?>
</td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_ACOMMENTS; ?>
</td>
                  <td><?php echo $this->_tpl_vars['allow_comments']; ?>
</td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_AEMBEDDING; ?>
</td>
                  <td><?php echo $this->_tpl_vars['allow_embedding']; ?>
</td>
                </tr>
                <tr>
                  <td><?php echo @_HWDVIDS_ARATINGS; ?>
</td>
                  <td><?php echo $this->_tpl_vars['allow_ratings']; ?>
</td>
                </tr>
              </table>
              <?php echo $this->_tpl_vars['endtab']; ?>

              <?php echo $this->_tpl_vars['endpane']; ?>

            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>

<?php echo $this->_tpl_vars['hidden_inputs']; ?>

</form>

<?php if ($this->_tpl_vars['remotevideo'] == 0): ?>
<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td width="50%" style="width:50%;" valign="top">
        <h2>Re-conversion Tools</h2>


<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxReconvertFLV(){

	document.getElementById(\'conversionUutput\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'conversionUutput\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=ajaxReconvertFLV&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>

<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxReconvertMP4(){

	document.getElementById(\'conversionUutput\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'conversionUutput\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=ajaxReconvertMP4&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>

<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxMoveMoovAtom(){

	document.getElementById(\'conversionUutput\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'conversionUutput\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=ajaxMoveMoovAtom&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>

<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxRecalculateDuration(){

	document.getElementById(\'conversionUutput\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'conversionUutput\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=ajaxRecalculateDuration&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>

<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxRegenerateImage(){

	document.getElementById(\'conversionUutput\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'conversionUutput\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=ajaxRegenerateImage&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>

<?php echo '
<script language="javascript" type="text/javascript">
<!--
//Browser Support Code
function ajaxReinsertMetaFLV(){

	document.getElementById(\'conversionUutput\').innerHTML = "<img src=\\"'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/components/com_hwdvideoshare/images/icons/loading.gif\\" border=\\"0\\" alt=\\"\\" title=\\"\\"> Loading...";
	
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
			document.getElementById(\'conversionUutput\').innerHTML = ajaxRequest.responseText;
		}
	}
	ajaxRequest.open("GET", "'; ?>
<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
<?php echo '/administrator/index.php?option=com_hwdvideoshare&task=ajaxReinsertMetaFLV&cid='; ?>
<?php echo $this->_tpl_vars['vid']; ?>
<?php echo '", true);
	ajaxRequest.send(null);
}

//-->
</script>
'; ?>



            <div onclick="ajaxReconvertFLV();" style="cursor:pointer;float:left;width:140px;text-align:center;">
                <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/cvtool_flv.png" border="0" alt="" title="" /><br />[ Re-convert FLV Video ]
            </div>

            <div onclick="ajaxReconvertMP4();" style="cursor:pointer;float:left;width:140px;text-align:center;">
                <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/cvtool_mp4.png" border="0" alt="" title="" /><br />[ Re-convert MP4 Video ]
            </div>

            <div onclick="ajaxMoveMoovAtom();" style="cursor:pointer;float:left;width:140px;text-align:center;">
            	<img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/cvtool_moovatom.png" border="0" alt="" title="" /><br />[ Move Moov Atom ]
            </div>            

            <div onclick="ajaxRecalculateDuration();" style="cursor:pointer;float:left;width:140px;text-align:center;">
                <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/cvtool_duration.png" border="0" alt="" title="" /><br />[ Re-calculate Duration ]
            </div> 

            <div onclick="ajaxRegenerateImage();" style="cursor:pointer;float:left;width:160px;text-align:center;">
                <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/cvtool_image.png" border="0" alt="" title="" /><br />[ Re-generate Thumbnail Image ]
            </div> 

            <div onclick="ajaxReinsertMetaFLV();" style="cursor:pointer;float:left;width:140px;text-align:center;">
                <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/cvtool_flvtool2.png" border="0" alt="" title="" /><br />[ Re-insert Meta Data ]
            </div> 

      	<div style="clear:both"></div>
      	<br /><br />
        <div id="conversionUutput"></div>
    </td>
  </tr>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['remotevideo'] == 1): ?>
<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <td width="50%" style="width:50%;" valign="top">

      <h2>Change Third Party Source</h2>

	<form action="index.php" method="post" enctype="multipart/form-data">
	<table cellpadding="4" cellspacing="1" border="0">
	  <tr>
	    <td valign="top" width="150">Video Type</td>
	    <td valign="top">
	      <select name="videotype">
	        <option value="1">Remote Video (Webpage URL) from a third party video website</option>
	        <option value="2">Remote Video (Static FLV URL)</option>
	      </select>
	    </td>
	  </tr>
	  <tr>
	    <td valign="top">Video URL</td>
	    <td valign="top"><input type="text" name="embeddump" value="" size="30"></td>
	  </tr>
	  <tr>
	    <td valign="top">Update video details</td>
	    <td valign="top"><input type="checkbox" name="updatedetails"></td>
	  </tr>
	  <tr>
	    <td valign="top" colspan="2" valign="top"><input type="submit" value="Update Now"></td>
	  </tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['vid']; ?>
" />
	<input type="hidden" name="option" value="com_hwdvideoshare" />
	<input type="hidden" name="task" value="updatevideosource" />
	<input type="hidden" name="hidemainmenu" value="0">
	</form>
    
      </div>
    </td>
  </tr>
</table>
<?php endif; ?>

<table cellpadding="4" cellspacing="1" border="1" class="adminform">
  <tr>
    <td style="width:50%;padding: 5px;" valign="top">
        <h2>Video Summary</h2>
        <h2><a href="<?php echo $this->_tpl_vars['link_live_video']; ?>
" target="_blank"><?php echo $this->_tpl_vars['title']; ?>
</a></h2>
        <b><?php echo @_HWDVIDS_CATEGORY; ?>
:</b> <?php echo $this->_tpl_vars['category']; ?>
<br />
        <b><?php echo @_HWDVIDS_TAGS; ?>
:</b> <?php echo $this->_tpl_vars['tags']; ?>
<br />
        <b><?php echo @_HWDVIDS_APPROVED; ?>
:</b> <?php echo $this->_tpl_vars['status']; ?>
<br />
        <b><?php echo @_HWDVIDS_FLOC; ?>
:</b> <?php echo $this->_tpl_vars['location']; ?>
<br />
        <center><h2><?php echo $this->_tpl_vars['missingfile']; ?>
</h2></center>

        <h2>Video Statistics</h2>
        <?php echo @_HWDVIDS_DATEUPLD; ?>
: <b><?php echo $this->_tpl_vars['dateuploaded']; ?>
</b><br />
        <?php echo @_HWDVIDS_LENGTH; ?>
: <b><?php echo $this->_tpl_vars['duration']; ?>
</b><br />
        <?php echo @_HWDVIDS_RATING; ?>
: <b><?php echo $this->_tpl_vars['rating']; ?>
</b><br />
        <?php echo @_HWDVIDS_ACCESS; ?>
: <b><?php echo $this->_tpl_vars['access']; ?>
</b><br />
        <?php echo @_HWDVIDS_APPROVED; ?>
: <b><?php echo $this->_tpl_vars['status']; ?>
</b><br />
        <?php echo @_HWDVIDS_VIEWS; ?>
: <b><?php echo $this->_tpl_vars['views']; ?>
</b><br />
        <?php echo @_HWDVIDS_UPLOADER; ?>
: <b><?php echo $this->_tpl_vars['user']; ?>
</b><br />
        <?php echo @_HWDVIDS_FAVOURED; ?>
: <b><?php echo $this->_tpl_vars['favoured']; ?>
</b> <?php echo @_HWDVIDS_DETAILS_TIMES; ?>
<br />
    </td>
    <td style="width:50%;padding: 5px;" valign="top">
        <h2>Video Thumbnail</h2>
        <div style="float:right;padding:5px;"><?php echo $this->_tpl_vars['thumbnail']; ?>
</div>
        <?php echo $this->_tpl_vars['thumbnail_form_code']; ?>


        <h2>Watch Video</h2>
        <center><?php echo $this->_tpl_vars['videoplayer']; ?>
</center>
    </td>
  </tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>