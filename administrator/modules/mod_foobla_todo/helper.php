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
class modJLordToDoHelper
{
	function install() {
		$database = &JFactory::getDBO();
		$database->setQuery("
		CREATE TABLE IF NOT EXISTS `#__jlord_todo` (
			`id` int(11) NOT NULL auto_increment,
			`uid` int(11) NOT NULL default '0',
			`message` text NOT NULL,
			`msg_priority` tinyint(2) NOT NULL default '0',
			`msg_status` tinyint(2) NOT NULL default '0',
			PRIMARY KEY  (`id`)
		) TYPE=MyISAM AUTO_INCREMENT=1 ;");
		$database->Query();
	}

    function show( &$params, $id = NULL, $filterPri = null, $filterSta = null, $search = null) {
		global $mainframe;
		$database			= &JFactory::getDBO();
		$user				= &JFactory::getUser();
		$search 			= JString::strtolower( $search );
		$order_number		= $params->get('ordernumber', 0);
		$priority			= $params->get( 'prioritize', 0 );
		$status				= $params->get( 'use_status', 0 );
		$personified		= $params->get( 'personifiedlist', 0 );
		$allow_sadmin		= $params->get( 'superadmin', 0 );
		$priority_colors 	= array('#aaaaaa','#FF000A','#FF5F65','#DFB700','#5FFF84','#00BF2C');
		//$status_colors 		= array('#C9CCC4','#E3B7EB','#FCBDBD','#FFF6AF','#D2F5B0','#BAEF86');
		//$priority_colors 	= array('#DFDFDF','#FF9F9F','#FFBFBF','#FFF6AF','#D2F5B0','#BAEF86');
		$status_colors 		= array('#DFDFDF','#FF9F9F','#FFBFBF','#FFF6AF','#D2F5B0','#BAEF86');
		$priority_msgs 		= array(_TODO_PRIORITY_NONE, _TODO_PRIORITY_HIGHEST, _TODO_PRIORITY_HIGH, _TODO_PRIORITY_MEDIUM, _TODO_PRIORITY_LOW, _TODO_PRIORITY_LOWEST);
		$status_msgs		= array(_TODO_STATUS_NONE, _TODO_STATUS_ALERT, _TODO_STATUS_WARNING, _TODO_STATUS_NOT_STARTED, _TODO_STATUS_OK, _TODO_STATUS_COMPLETED);
		$isfilterPri 		= false;
		$isfilterSta 		= false;
   		$where 				= array();
		if ( $search ){
			$where[] = 'message like'.$database->Quote( '%'.$database->getEscaped( $search, true ).'%', false );
		}
		if ( $priority && $filterPri != 'noPriority' && $filterPri != null ){
			$where[] = 'msg_priority = '.$filterPri;
			$isfilterPri = true;
		}
  			if ($status && $filterSta != 'noStatus' && $filterSta != null){
			$where[] = 'msg_status = '.$filterSta;
  			$isfilterSta = true;
		}
		$showothers = $params->get('showothers', 0);
		if( !$showothers ){
			$where[] 		= 'uid in (0, '. $user->id .')'; 
		}
		$where 				= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
		$database->setQuery("SELECT * FROM #__jlord_todo".$where);
		$results = $database->loadAssocList();
		//BAOPV ADDSOME CODE HERE
		$output 		= '<div style="text-align: right; background-color: #FFFFFF;">';
		$useStatus 		= 0;
		$usePriority 	= 0;
		$output .= '<table><tr><td align="left" width="100%">'._TODO_FILTER.':&nbsp;
			<input type="text" name="search" id="search" value="'.$search.'" class="text_area"/>
			<button id="buttonGo">'._TODO_BUTTON_GO.'</button>
			<button id="buttonReset">'._TODO_BUTTON_RESET.'</button></td>';
		if( $priority ) {
			$output .= '<td nowrap="nowrap"><select name="todo_filter_priority" size="1" id="todo_filter_priority" ><option value="" >&nbsp;&#45;&nbsp;'._TODO_SELECT_PRIORITY.'&nbsp;&#45;&nbsp;</option>';
			for( $i = 0; $i <= 5; $i++) {
				if ($filterPri != null && $filterPri != 'noPriority' && $filterPri == $i){
					$output .= '<option value="'. $i .'" selected="selected" style="color:'. $priority_colors[$i] .'">'. $priority_msgs[$i] .'</option>';
				}else {
					$output .= '<option value="'. $i .'" style="color:'. $priority_colors[$i] .'">'. $priority_msgs[$i] .'</option>';
				}
			}
			$output .= '</select></td>';
			$usePriority = 1;
		}
		if( $status ) {
			if ($filterSta == 'noStatus'){
				$selected = 'selected="selected"';
			}else {
				$selected = '';
			}
			$output .= '<td nowrap="nowrap"><select name="todo_filter_status" id="todo_filter_status" size="1"><option value="" '.$selected.'>&nbsp;&#45;&nbsp;'._TODO_SELECT_STATUS.'&nbsp;&#45;&nbsp;</option>';
			for( $i = 0; $i <= 5; $i++) {
				if ($filterSta != null && $filterSta != 'noStatus' && intval($filterSta) == $i){
					$output .= '<option value="'. $i .'" selected="selected" style="background-color:'. $status_colors[$i] .'">'. $status_msgs[$i] .'</option>';
				}else {
					$output .= '<option value="'. $i .'" style="background-color:'. $status_colors[$i] .'">'. $status_msgs[$i] .'</option>';
				}
			}
			$output .= '</select></td>';
			$useStatus = 1;
		}	
		$output .= '<input type="hidden" id="useStatus" name="useStatus" value="'.$useStatus.'" />
					<input type="hidden" id="usePriority" name="usePriority" value="'.$usePriority.'" /></tr></table></div>';
		$output .= '<div><table class="adminlist" cellspacing="1" border="0"><thead><tr>';
		if ($order_number) {
			$output .= '<th class="title" width="5%"> # </th>';
		}
		$output .= '<th class="title" width="15%">'. _TODO_USER .'</th>
				<th class="title">'. _TODO_MESSAGE_TITLE .'</th>';
		$output .= '<th class="title" width="8%">'. _TODO_MESSAGE_ACTIONS .'</th></tr></thead>';

		if( isset($results[0]) ) {
			$database->setQuery('SELECT id, username FROM #__users WHERE gid > 22');
			$users = $database->loadAssocList('id');
			$j = 0;
			$i = 0;
			foreach( $results as $message ) {
				if( $message['uid'] == 0 ) {
					$usertodo = _TODO_ALL;
				} else {
					$usertodo = $users[$message['uid']]['username'];
				}
				if( $message['id'] == $id ) {
					$edit_message = $message;
				}
				
				$backgroundColorPriority = '';
				if( $priority ){
					$backgroundColorPriority = 'color:'. $priority_colors[$message['msg_priority']];
				}
				$backgroundColorStatus = '';
				if( $status ){
					$backgroundColorStatus = 'background-color:'. $status_colors[$message['msg_status']];
				}
				$output .= '<tr class="row'.$j.'">';
				if ($order_number){
					$output .= '<td valign="top" style="text-align:center;">'. ( $i+1 ) .'</td>';
				}
				$output .= '<td valign="top" style="text-align:center;  '.$backgroundColorPriority.'">'. $usertodo .'</td>
						<td valign="top" style="'.$backgroundColorStatus .'">'. stripslashes($message['message']) .'</td>';
				$output .= '
					<td valign="top" style="text-align:center;">
					<span title="Edit"><a  href="index2.php?todo_action=edit&todo_id='. $message['id'] .'&filterPri='.$filterPri.'&filterSta='.$filterSta.'&search='.$search.'">
					<img id="imgEdit" name="imgEdit" src="'. $mainframe->getSiteURL() .'/administrator/components/com_media/images/edit_pencil.gif" border="0"/>
					</a></span>
					<span title="Delete"><a href="index2.php?todo_action=remove&todo_id='. $message['id'] .'&filterPri='.$filterPri.'&filterSta='.$filterSta.'&search='.$search.'">
					<img src="'. $mainframe->getSiteURL() .'/administrator/images/publish_x.png" border="0"/>
					</a></span
					</td></tr>
				';
				$j = 1 - $j;
				$i++;
			}
			$output .= '</table></div>';
		} else {
			$output .= "<tr><td colspan=\"6\">No entry to show</td></tr></table></div>";
		}
		if( isset( $edit_message ) ) {
			$output .= '<div><table><tr><td ><form action="index2.php" method="post" name="todo_box">';
			$output .= _TODO_USER.':&nbsp;';
			if( $allow_sadmin && ( $user->gid == 25 ) ) {
				$database->setQuery("SELECT id, username FROM #__users WHERE gid > 22");
				$results = $database->loadAssocList();
				if( $edit_message['uid'] == 0 ) {
					$output .= '<select name="todo_uid" size="1"><option value="0" selected="selected">All</option>';
				} else {
					$output .= '<select name="todo_uid" size="1"><option value="0">All</option>';
				}
				foreach( $results as $result ) {
					if($edit_message['uid'] == $result['id']) {
						$output .= '<option value="'. $result['id'] .'" selected="selected">'. $result['username'] .'</option>';
					} else {
						$output .= '<option value="'. $result['id'] .'">'. $result['username'] .'</option>';
					}
				}
				$output .= '</select>';
			} else {
				$output .= '<select name="todo_uid" size="1">';
				if($edit_message['uid'] == 0) {
					$output .= '<option value="0" selected="selected">All</option>';
				} else {
					$output .= '<option value="0">All</option>';
				}
				if($edit_message['uid'] == $user->id) {
					$output .= '<option value="'. $user->id .'" selected="selected">'. $user->username .'</option></select>';
				} else {
					$output .= '<option value="'. $user->id .'">'. $user->username .'</option></select>';
				}
			}
			if( $priority ) {
				$output .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'._TODO_PRIORITY .':&nbsp;<select name="todo_priority" id="todo_priority" size="1">';
				for( $i = 0; $i <= 5; $i++ ) {
					$output .= '<option value="'. $i .'"';
					if( $edit_message['msg_priority'] == $i ) {
						$output .= ' selected="selected"';
					}
					$output .= ' style="color:'. $priority_colors[$i] .'">'. $priority_msgs[$i] .'</option>';
				}
				$output .= '</select>';
			}
			if( $status ) {
				$output .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'._TODO_STATUS .':&nbsp;<select name="todo_status" size="1">';
				for( $i = 0; $i <= 5; $i++ ) {
					$output .= '<option value="'. $i .'"';
					if( $edit_message['msg_status'] == $i ) {
						$output .= ' selected="selected"';
					}
					$output .= ' style="background-color:'. $status_colors[$i] .'">'. $status_msgs[$i] .'</option>';
				}
				$output .= '</select><br />';
			}
			$output .= '<textarea id="todo_message" name="todo_message" cols="80"  rows="5" >'. stripslashes($edit_message['message']) .'</textarea><br />';
			
			$output .= '<input type="submit" value="'. _TODO_BUTTON_SAVE.'">
				<input type="hidden" name="todo_id" value="'. $edit_message['id'] .'">
				<input type="hidden" name="todo_action" value="add">
				<input type="hidden" name="filterPri" value="'.$filterPri.'">
				<input type="hidden" name="filterSta" value="'.$filterSta.'">
				<input type="hidden" name="search" value="'.$search.'">
				<input type="button" name="hideFormEdit" id="hideFormEdit" value="'._TODO_BUTTON_CANCEL.'" /></form></td></tr></table></div>';
		} else {
			$output .= '<div id="showFormNew" style="display: none;"><table><tr><td><form action="index2.php" method="post" name="todo_box">';
			$output .= _TODO_USER.':&nbsp;';
			if( $allow_sadmin && ($user->gid == 25) ) {
				$database->setQuery("SELECT id, username FROM #__users WHERE gid > 22");
				$results = $database->loadAssocList();
				$output .= '<select name="todo_uid" size="1"><option value="0">All</option>';
				foreach($results as $result) {
					$output .= '<option value="'. $result['id'] .'">'. $result['username'] .'</option>';
				}
				$output .= '</select>';
			} else {
				$output .= '<select name="todo_uid" size="1"><option value="0">All</option>
					<option value="'. $user->id .'">'. $user->username .'</option></select>';
			}
			if( $priority ) {
				$output .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'._TODO_PRIORITY .':&nbsp;<select name="todo_priority" size="1">';
				for( $i = 0; $i <= 5; $i++) {
					$output .= '<option value="'. $i .'" style="color:'. $priority_colors[$i] .'">'. $priority_msgs[$i] .'</option>';
				}
				$output .= '</select>';
			}
			if( $status ) {
				$output .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'._TODO_STATUS .':&nbsp;<select name="todo_status" size="1">';
				for( $i = 0; $i <= 5; $i++) {
					$output .= '<option value="'. $i .'" style="background-color:'. $status_colors[$i] .'">'. $status_msgs[$i] .'</option>';
				}
				$output .= '</select><br />';
			}	
			
			$output .= '<textarea  id="todo_message" name="todo_message" cols="80" rows="5"></textarea><br />
						<input type="submit" id="add-submit" value="'. _TODO_BUTTON_SAVE .'">
						<input type="hidden" name="todo_action" value="add">
						<input type="hidden" name="filterPri" value="'.$filterPri.'">
						<input type="hidden" name="filterSta" value="'.$filterSta.'">
						<input type="hidden" name="search" value="'.$search.'">
						<input type="button" name="hideForm" id="hideForm" value="'._TODO_BUTTON_CANCEL.'" /></form></td></tr></table></div>';
			$output .= '<div  id="hideFormNew" ><button id="showForm">'._TODO_BUTTON_ADD_ENTRY.'</button>';
			if ( $priority || $status ){
				$output .= '<button id="button_help">'._TODO_BUTTON_HELP.'</button>';
			}
			$output .= '</div>';
			$output .= '<div id="help" style="display: none; background-color:#FFFFFF">';
			$output .= '<div><button id="backhelp">'._TODO_BUTTON_BACK_HELP.'</button></div>';
			$output .= '<div><table width="100%"><tbody>';
			if ( $priority ){
				$output .= '<tr><td colspan="6">'._TODO_HELP_PRIORITY.'</td></tr>';
				$output .= '<tr>'; 
				for ($i = 0; $i <= 5; $i++){
					$output .= '<td class="small-caption" width="16%" style="color:'. $priority_colors[$i] .'">'. $priority_msgs[$i] .'</td>';
				}
				$output .= '</tr>';
			}
			if ( $status ){
				$output .= '<tr><td colspan="6">'._TODO_HELP_STATUS.'</td></tr>';
				$output .= '<tr>'; 
				for ($i = 0; $i <= 5; $i++){
					$output .= '<td class="small-caption" width="16%" style="background-color:'. $status_colors[$i] .'">'. $status_msgs[$i] .'</td>';
				}
				$output .= '</tr>';
			}
			
			$output .= '</tbody></table></div>';
			$output .= '</div>';
		}
	echo $output;
	}

	function add($filterPri = null, $filterSta = null, $search) {
		global $mainframe;
		$database 	= &JFactory::getDBO();
		$user 		= &JFactory::getUser();
		$message 	= addslashes(JArrayHelper::getValue( $_REQUEST, "todo_message" ));
		$uid 		= JArrayHelper::getValue( $_REQUEST, "todo_uid", 0 );
		$priority 	= JArrayHelper::getValue( $_REQUEST, "todo_priority", 0 );
		$status 	= JArrayHelper::getValue( $_REQUEST, "todo_status", 0 );
		$id 		= JArrayHelper::getValue( $_REQUEST, "todo_id", 0 );
		if($id == 0) {
			$database->setQuery("INSERT INTO #__jlord_todo VALUES (0,". $uid .",'". $message ."',". $priority .",". $status .");");
			$mgs 	= _TODO_ADD_ENTRY;
			$error  = _TODO_ERROR_ADD_ENTRY;
		} else {
			$database->setQuery("UPDATE #__jlord_todo SET uid = ". $uid .", message = '". $message ."', msg_priority = ". $priority .", msg_status = ". $status ." WHERE id = ". $id);
			$mgs 	= _TODO_EDIT_ENTRY;
			$error  = _TODO_ERROR_EDIT_ENTRY;
		}
		if (!$database->Query()){
			$mainframe->redirect( 'index2.php', $error);
		}
		if ($filterPri != null || $filterSta != null || $search){
			$mainframe->redirect( 'index2.php?todo_action=filter&filterPri='.$filterPri.'&filterSta='.$filterSta.'&search='.$search, $mgs);
		}else {
			$mainframe->redirect( 'index2.php', $mgs );
		}
	}
	
	function remove() {
		$database 	= &JFactory::getDBO();
		$id 		= JArrayHelper::getValue( $_REQUEST, "todo_id" );
		if(isset($id)) {
			$database->setQuery("DELETE FROM #__jlord_todo WHERE id = ". $id );
			$database->Query();
		}
	}
}