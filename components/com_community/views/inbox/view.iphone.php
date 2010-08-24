<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view');
jimport( 'joomla.utilities.arrayhelper');

require_once(JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'views' . DS . 'inbox' . DS . 'view.html.php' );

class CommunityViewIphoneInbox extends CommunityViewInbox
{

	function _addSubmenu(){}
	function showSubmenu(){}
	
	function inbox($data)
	{
		$document =& JFactory::getDocument();
		$document->addStylesheet( JURI::root() . 'components/com_community/templates/default/css/style.iphone.css' );	
	
		parent::inbox($data);
	}		
	/**
	 * Show the message reading window
	 */	 		
	function read($data)
	{
		$mainframe =& JFactory::getApplication();
		if(!$this->accessAllowed('registered'))
		{
			return;
		}

        //page title
		$document =& JFactory::getDocument();
		
		$this->showSubMenu();		
		
		$inboxModel = CFactory::getModel('inbox');
		$my			=& JFactory::getUser();
		$msgid		= JRequest::getVar('msgid', 0, 'REQUEST');
		
		if(!$inboxModel->canRead($my->id, $msgid))
		{
			$mainframe =& JFactory::getApplication();
			$mainframe->enqueueMessage(JText::_('CC PERMISSION DENIED'), 'error');
			return;
		}

        $pathway 	=& $mainframe->getPathway();

		$pathway->addItem( JText::_('CC INBOX TITLE'), CRoute::_('index.php?option=com_community&view=inbox') );
		 

		if(! empty($data->messages))
		{
			$document =& JFactory::getDocument();

			$html = '';
			
			$parentData = $data->messages[0];
			$pathway->addItem( JText::sprintf('CC VIEW MESSAGE TITLE' , $parentData->subject ) );
			$document->setTitle(JText::sprintf('CC VIEW MESSAGE TITLE' , $parentData->subject));
			
			//$content = '<strong>'.$parentData->subject.'</strong>';
			//$tableData[] = array('&nbsp;', 	$content, '');
			require_once( COMMUNITY_COM_PATH.DS.'libraries' . DS . 'apps.php' );			
			$appsLib	=& CAppPlugins::getInstance();
			$appsLib->loadApplications();
				
			foreach ($data->messages as $row){ 
				//$content    = '<p>'.$row->body.'</p>';
				
				// onMessageDisplay Event trigger
				$args = array();
				$args[]	=& $row;
				$appsLib->triggerEvent( 'onMessageDisplay' , $args );
				$user	= CFactory::getUser($row->from);

				//construct the delete link
		        $deleteLink = CRoute::_('index.php?option=com_community&view=inbox&task=remove&msgid='.$row->id);
				$authorLink	= CRoute::_('index.php?option=com_community&view=profile&userid=' . $user->id );
				
				$my			= CFactory::getUser();
				
				$tmpl = new CTemplate();
				$tmpl->set( 'user',  $user );
				$tmpl->set( 'msg', $row );
				$tmpl->set( 'isMine' 	, isMine($my->id, $user->id));
				$tmpl->set( 'removeLink', $deleteLink);
				$tmpl->set( 'authorLink'	, $authorLink );
				$html .= $tmpl->fetch( 'inbox.message' );
			}
			
			$defaultReply = JText::_('CC DEFAULT REPLY');
			$messageMissing = Jtext::_('CC MESSAGE MISSING');
			$js =<<<SHOWJS
			    function cAddReply() {
			        if(jQuery('textarea.replybox').val() == '$defaultReply' || jQuery('textarea.replybox').val() == '') {
			            alert('$messageMissing');
			            return;
					}
				    var html='<div class=\'ajax-wait\'>&nbsp;</div>';
				    jQuery('#community-wrap table tbody').append(html);				    
					jax.call('community', 'inbox,ajaxAddReply', $parentData->id, jQuery('textarea.replybox').val());
					jQuery('textarea.replybox').css('disabled', true);
				}
				
				function cReplyFocus(){
					if(jQuery('textarea.replybox').val() == '$defaultReply')
						jQuery('textarea.replybox').val(''); 
				}
				
				function cReplyBlur(){
					if(jQuery('textarea.replybox').val() == '')
						jQuery('textarea.replybox').val('$defaultReply');
				}
			
				function cAppendReply(html){
					jQuery('div.ajax-wait').remove();
					jQuery('textarea.replybox').val('');				
					jQuery('#community-wrap div#inbox-messages').append(html);
				}
				
				window.scrollTo(0, 1);
				
				jQuery(document).ready( function() {
					html = jQuery('#back-toolbar').html();
					jQuery('#back-toolbar-container').html( html ).addClass( 'black-button' );
					jQuery('#back-toolbar').hide();
				});				
SHOWJS;

			$document->addScriptDeclaration($js);
			
			//echo $cms->table->generate($tableData);
			echo '<div id="inbox-messages">';
			echo '<div class="black-button" id="back-toolbar">';
			echo '<a class="btn-blue btn-prev" href="'.CRoute::_('index.php?option=com_community&view=inbox').'">';
			echo '<span>' . JText::_('CC BACK TO INBOX') , '</span>';
			echo '</a>';
			echo '<div class="clr"></div>';
			echo '</div>';		
			echo $html; 
			echo '</div>';
			
			$replyForm  = '<a name="latest"></a><form action="" method="post" class="inbox-reply-form"><div class="inbox-reply"><textarea id="replybox" onfocus="cReplyFocus()" onblur="cReplyBlur()" class="replybox">'.$defaultReply.'</textarea></div>';
			$replyForm .= '<div><input type="hidden" name="action" value="doSubmit"/>';
			$replyForm .= '<button class="ajax-wait button" onclick="cAddReply();return false;">'.JText::_('CC BUTTON ADD REPLY').'</button>';
			$replyForm .= '</div></form>';
			
			echo $replyForm;
					
		} else {
		    ?>		
			<div class="column body">
				<div class="text"><?php echo JText::_('CC MESSAGE EMPTY'); ?></div>
			</div>
			<?php		
		}//end if		
			   
	
	}//end messages	
}
