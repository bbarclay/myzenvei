// JavaScript Document

var flvWindow;

function openFLVWindow(uniq_id, playerTags){
	try{ 
	    var currPlayer = document.getElementById(uniq_id);
		currPlayer.innerHTML = '';
	} catch(e){}
	flvWindow = window.open('', 'flvwin', 'height=300, width=300, resizable=yes');
	//var playerTags = definePlayerTags();
	flvWindow.document.write(decodeURI(playerTags));
	flvWindow.document.close();
	flvWindow.focus();	
			
}