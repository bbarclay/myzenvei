// JavaScript Document

var playerTags = definePlayerTags();

var popHTML = '<p><a href="#" onclick="openFLVWindow(\'' + uniq_id + '\',\'' + encodeURI(playerTags) + '\');">Open this player</a> in a new window</p>';


if(hasRightVersion){
   document.write( popHTML );
}