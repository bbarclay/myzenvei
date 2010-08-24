<?php
/**
 *
 * foobla TODO list for Joomla Backend
 * 
 * @version $Id: mod_foobla_todo.php, v 1.5.2.0 2009/09/01 15:46:04 $
 * @package mod_foobla_todo
 * @copyright Copyright (C) 2009 The foobla Team. All rights reserved.
 * @website http://www.foobla.com
 * @license GNU/GPL
 * NOTICE: this extension is based on HD TODO list from Hannes Papenberg 
 * 
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
JHTML::_('behavior.mootools');
global $mainframe;

?>
<script type="text/javascript">
<!--
	window.addEvent('domready', function(){
			$('search').addEvent('change', function(e){
				var usePriority	 = document.getElementById('usePriority').value; 
		        var useStatus	 = document.getElementById('useStatus').value; 
				var filterPri	 = '';
				var filterSta	 = '';
				if(usePriority == 1){
					var filterPri	= document.getElementById('todo_filter_priority').value;  
				}
				if(useStatus == 1){
					var filterSta	= document.getElementById('todo_filter_status').value;   
				}
         		window.location = 'index2.php?todo_action=search&search='+this.value+'&filterPri='+filterPri+'&filterSta='+filterSta;
				return;
	       	});
			$('buttonGo').addEvent('click', function(e){
				var search		 = document.getElementById('search').value;
				var usePriority	 = document.getElementById('usePriority').value; 
		        var useStatus	 = document.getElementById('useStatus').value; 
				var filterPri	 = '';
				var filterSta	 = '';
				if(usePriority == 1){
					var filterPri	= document.getElementById('todo_filter_priority').value;  
				}
				if(useStatus == 1){
					var filterSta	= document.getElementById('todo_filter_status').value;   
				}
         		window.location = 'index2.php?todo_action=search&search='+search+'&filterPri='+filterPri+'&filterSta='+filterSta;
				return;
	       	});
			$('buttonReset').addEvent('click', function(e){
         		window.location = 'index2.php?todo_action=search&search=&filterPri=&filterSta=';
				return;
	       	});
			if($('hideForm')) $('hideForm').addEvent('click', function(e){
           		document.getElementById('showFormNew').style.display = 'none';
             	document.getElementById('hideFormNew').style.display = 'block';
             	var ele =	document.getElementsByClassName('jpane-slider');
             	ele[0].style.height = 'auto';
                return;
            });
	          if($('showForm')) $('showForm').addEvent('click', function(e){
	         		document.getElementById('hideFormNew').style.display = 'none';
	           		document.getElementById('showFormNew').style.display = 'block';
	           		var ele =	document.getElementsByClassName('jpane-slider');
	             	ele[0].style.height = 'auto';
	             	return;
	      	   });
	          if($('button_help')) $('button_help').addEvent('click', function(e){
	        		document.getElementById('hideFormNew').style.display = 'none';
	          		document.getElementById('help').style.display = 'block';
	          		var ele =	document.getElementsByClassName('jpane-slider');
	            	ele[0].style.height = 'auto';
	            	return;
	     	   });
	          if($('backhelp')) $('backhelp').addEvent('click', function(e){
	        	   	document.getElementById('help').style.display = 'none';
	       			document.getElementById('hideFormNew').style.display = 'block';
	         		var ele =	document.getElementsByClassName('jpane-slider');
	           		ele[0].style.height = 'auto';
	           		return;
	    	   });
           if($('hideFormEdit')) $('hideFormEdit').addEvent('click', function(e){
				var search		 = document.getElementById('search').value;
				var usePriority	 = document.getElementById('usePriority').value; 
		        var useStatus	 = document.getElementById('useStatus').value; 
				var filterPri	 = '';
				var filterSta	 = '';
				if(usePriority == 1){
					var filterPri	= document.getElementById('todo_filter_priority').value;  
				}
				if(useStatus == 1){
					var filterSta	= document.getElementById('todo_filter_status').value;   
				}
        		window.location = 'index2.php?todo_action=cancelEdit&search='+search+'&filterPri='+filterPri+'&filterSta='+filterSta;
				return;
	       	});
      	  var search		= document.getElementById('search').value;
          var usePriority 	= document.getElementById('usePriority').value; 
          var useStatus 	= document.getElementById('useStatus').value; 
          if(usePriority == 1)$('todo_filter_priority').addEvent('change', function(e){
				if (useStatus == 1){
					var filterSta 	= document.getElementById('todo_filter_status').value;   
	            	window.location = 'index2.php?todo_action=filter&filterPri='+this.value+'&filterSta='+filterSta+'&search='+search;
				}else{
					window.location = 'index2.php?todo_action=filter&filterPri='+this.value+'&filterSta=noStatus&search='+search;
				}
	           	return;
    	  });
          if(useStatus == 1)$('todo_filter_status').addEvent('change', function(e){   
        	    if (usePriority == 1){ 
	        	 	var filterPri = document.getElementById('todo_filter_priority').value;         	 
	           		window.location = 'index2.php?todo_action=filter&filterPri='+filterPri+'&filterSta='+this.value+'&search='+search;
        	    }else{
        	    	window.location = 'index2.php?todo_action=filter&filterPri=noPriority&filterSta='+this.value+'&search='+search;
            	}
	           	return;
  		  });
	});
//-->
</script>



<?php 
modJLordToDoHelper::install();

$lang =& JFactory::getLanguage();
$langtag  = $lang->getTag();
$langlang = strtok($langtag, '-');
$pathLang = JPATH_ADMINISTRATOR . "/modules/mod_foobla_todo/todo/";
if( file_exists( $pathLang . $langtag . '.php' )){
	include_once( $pathLang . $langtag . '.php' );
} else {
	if( file_exists( $pathLang . $langlang . '.php' )){
		include_once( $pathLang . $langlang . '.php' );
	} else {
		include_once( $pathLang . 'english.php' );
	}
}

// set ordering equa 0
$database = &JFactory::getDBO();
$query = " SELECT ordering".
		 " FROM #__modules".
		 " WHERE module = 'mod_jlord_todo'";
$database->setQuery($query);
$ordering = $database->loadResult();
if ($ordering != 0 ){
	$database->setQuery("
	UPDATE `#__modules` SET `ordering` = '0' WHERE `module` = 'mod_jlord_todo';");
	$database->Query();
	$mainframe->redirect( 'index2.php');
}
// end set ordering

$action 	= JArrayHelper::getValue( $_REQUEST, 'todo_action', 'show' );
$todo_id	= JArrayHelper::getValue($_REQUEST, 'todo_id');
$filterPri	= JArrayHelper::getValue( $_REQUEST, 'filterPri');
$filterSta	= JArrayHelper::getValue( $_REQUEST, 'filterSta');
$search		= JArrayHelper::getValue( $_REQUEST, 'search');
switch( $action ) {
	case "add":
		modJLordToDoHelper::add($filterPri, JArrayHelper::getValue($_REQUEST, 'filterSta'), $search);
		break;
	case "remove":
		modJLordToDoHelper::remove();
		if ($filterPri != null || $filterSta != null || $search){
			$mainframe->redirect( 'index2.php?todo_action=filter&filterPri='.$filterPri.'&filterSta='.$filterSta.'&search='.$search, 'Entry removed!' );
		}else {
			$mainframe->redirect( 'index2.php', _TODO_REMOVE_ENTRY);
		}
		break;
	case "edit":
		modJLordToDoHelper::show($params, $todo_id, $filterPri, $filterSta, $search);
		break;
	case "search":
		modJLordToDoHelper::show($params, null, $filterPri, $filterSta, $search);
		break;
	case "filter":
		modJLordToDoHelper::show($params, null, $filterPri, $filterSta, $search);
		break;
	case "cancelEdit":
		modJLordToDoHelper::show($params, null, $filterPri, $filterSta, $search);
		break;
	case "show":
	default:
		modJLordToDoHelper::show($params);
		break;
}

require( JModuleHelper::getLayoutPath( 'mod_foobla_todo' ) );