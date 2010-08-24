<?php
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}

function replaceSelection (input, replaceString) {
	if (input.setSelectionRange) {
		var selectionStart = input.selectionStart;
		var selectionEnd = input.selectionEnd;
		input.value = input.value.substring(0, selectionStart)+ replaceString + input.value.substring(selectionEnd);
    
		if (selectionStart != selectionEnd){ 
			setSelectionRange(input, selectionStart, selectionStart + 	replaceString.length);
		}else{
			setSelectionRange(input, selectionStart + replaceString.length, selectionStart + replaceString.length);
		}

	}else if (document.selection) {
		var range = document.selection.createRange();

		if (range.parentElement() == input) {
			var isCollapsed = range.text == '';
			range.text = replaceString;

			 if (!isCollapsed)  {
				range.moveStart('character', -replaceString.length);
				range.select();
			}
		}
	}
}


// We are going to catch the TAB key so that we can use it, Hooray!
function catchTab(item,e){
	if(navigator.userAgent.match("Gecko")){
		c=e.which;
	}else{
		c=e.keyCode;
	}
	if(c==9){
		var offset = jQuery('#editFile').scrollTop();
		replaceSelection(item,String.fromCharCode(9));
		setTimeout("document.getElementById('"+item.id+"').focus();",0);
		
		jQuery('#editFile').scrollTop(offset);
		offset = offset *-1 ;
		offset = '0 '+ offset + 'px';
		jQuery(e).css('background-position', offset);
		
		return false;
	}
		    
}

function saveTemplate(){
	var val = jQuery('#editFile').val();
	var filename = jQuery('#fileData').val();
	jax.call('community', 'cxSaveFile', filename, val);
}

function loadTempData(ext){
	//editFile.edit(document.getElementById('tempText').innerHTML, ext);
	//jQuery('#editFile').val(unescape(document.getElementById('tempText').innerHTML));
}

function scrollEditor(e){
	var offset = jQuery(e).scrollTop();
	offset = offset *-1 ;
	offset = '0 '+ offset + 'px';
	jQuery(e).css('background-position', offset);

}

function teHideMessage(){
	jQuery('#msgDiv').fadeOut();
}

function teShowMessage(msg){
	var html = '<dl id="system-message">';
	html += '<dt class="message">Message</dt>';
	html += '<dd class="message message fade">';
	html += '<ul>';
	html += '<li>'+ msg +'</li>';
	html += '</ul>';
	html += '</dd>';
	html += '</dl>';
	
	jQuery('#msgDiv').html(html).show();
	setTimeout('teHideMessage()', 2500);
}

</script>
<div id="status"></div>
<table border="0" cellpadding="10px" width="100%">
	<tr>
		<td width="250" valign="top">
			<div>
				<div id="templates-list">
					<h3><?php echo JText::_('CC SELECT TEMPLATE'); ?></h3>
					<?php echo $this->getTemplatesListing();?>
				</div>
				
				<div id="templates-files-container"></div>
			</div>
		</td>
		<td valign="top">
			<div>
				<table class="adminform">
					<tbody>
					<tr>
						<th>
							<span id="filePath"></span>
						</th>
						<th width="5%" align="right">
							<button onclick="azcommunity.saveTemplateFile()">Save</button>
						</th>
					</tr>
					<tr>
						<td align="center" style="padding:10px;" >
							<div id="msgDiv" style="display:none"></div>
							<textarea wrap="off" spellcheck="false" onscroll="scrollEditor(this);" onkeydown="return catchTab(this,event)" class="inputbox php template-editor" id="data" name="data" rows="25" cols="110">
							</textarea>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</td>
	</tr>
</table>
<input type="hidden" value="" id="fileName" />
<input type="hidden" value="" id="templateName" />