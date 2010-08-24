// JavaScript Document

function definePlayerTags()
{

  var playerTags = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="objectPlayer" '
    + 'width="100%" height="' + (playerHeight) + 'px"'
    + 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">'
    + '<param name="movie" value="' + playerMovie +'" /><param name="quality" value="high" /><param name="scale" value="scale" /><param name="wmode" value="transparent" /><param name="FlashVars" value="path=' + encodeURI(path) + '&amp;flvs=' + encodeURI(flvs) + '&amp;startPlay=' + autoStart + '&amp;autoReplay=' + autoReplay + '" />'
	+ '<param name="allowScriptAccess" value="sameDomain" />'
    + '<embed src="' + playerMovie +'" quality="high" id="embedPlayer"'
    + 'width="100%" height="' + (playerHeight) + 'px" name="objectPlayer" align="middle" '
    + 'play="true" scale="scale" '
    + 'loop="true" '
    + 'quality="high" '
    + 'allowScriptAccess="sameDomain" '
    + 'FlashVars="path=' + encodeURI(path) + '&amp;flvs=' + encodeURI(flvs) + '&amp;startPlay=' + autoStart + '&amp;autoReplay=' + autoReplay  + '" '
    + ' type="application/x-shockwave-flash" '
    + 'pluginspage="http://www.macromedia.com/go/getflashplayer">'
    + '<\/embed>'
    + '<\/object>';
	
	return playerTags;
	
}