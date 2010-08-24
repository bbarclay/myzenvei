<?php
/**
 * @version		$Id: view.raw.php 306 2010-01-11 16:09:17Z joomlaworks $
 * @package		K2
 * @author    JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewItem extends JView {

    function display($tpl = null) {
        $mainframe = &JFactory::getApplication();
        $user = &JFactory::getUser();
        $document = &JFactory::getDocument();
        $params = &JComponentHelper::getParams('com_k2');
        $limitstart = JRequest::getInt('limitstart', 0);
        $view = JRequest::getWord('view');
        $task = JRequest::getWord('task');
        
        $db = &JFactory::getDBO();
        $jnow = &JFactory::getDate();
        $now = $jnow->toMySQL();
        $nullDate = $db->getNullDate();
        
        $this->setLayout('item');
        
        //Add link
        if (K2HelperPermissions::canAddItem())
            $addLink = JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component');
        $this->assignRef('addLink', $addLink);
        
        //Get item
        $model = &$this->getModel();
        $item = $model->getData();
        
        //Prepare item
		if ($user->guest){
			$cache = &JFactory::getCache('com_k2_extended');
	        $hits = $item->hits;
	        $item->hits = 0;
	        $item = $cache->call(array('K2ModelItem', 'prepareItem'), $item, $view, $task);
	        $item->hits = $hits;
		}
		else {
			$item = $model->prepareItem($item, $view, $task);
		}

        
        //Access check
        if ($this->getLayout() == 'form') {
            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
        }
        if ($item->access > $user->get('aid', 0) || $item->category->access > $user->get('aid', 0)) {
            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
        }
        
        //Published check
        if (!$item->published || $item->trash) {
            JError::raiseError(404, JText::_("Item not found"));
        }
        
        if ($item->publish_up != $nullDate && $item->publish_up > $now) {
            JError::raiseError(404, JText::_("Item not found"));
        }
        
        if ($item->publish_down != $nullDate && $item->publish_down < $now) {
            JError::raiseError(404, JText::_("Item not found"));
        }
        
        if (!$item->category->published || $item->category->trash) {
            JError::raiseError(404, JText::_("Item not found"));
        }
        
        //Increase hits counter
        $model->hit($item->id);
        
        //Set default image	
		K2HelperUtilities::setDefaultImage($item, $view);
		
        //Comments
        $item->event->K2CommentsCounter = '';
        $item->event->K2CommentsBlock = '';
        if ($item->params->get('itemComments')) {
        	
        	//Trigger comments events
        	$dispatcher = &JDispatcher::getInstance();
			JPluginHelper::importPlugin ('k2');
			$results = $dispatcher->trigger('onK2CommentsCounter', array ( & $item, &$params, $limitstart));
			$item->event->K2CommentsCounter = trim(implode("\n", $results));
			$results = $dispatcher->trigger('onK2CommentsBlock', array ( & $item, &$params, $limitstart));
			$item->event->K2CommentsBlock = trim(implode("\n", $results));
        
			//Load K2 native comments system only if there are no plugins overriding it
			if(empty($item->event->K2CommentsCounter) && empty($item->event->K2CommentsBlock)){
				
	            //Load reCAPTCHA script
	            if (!JRequest::getInt('print') && ($item->params->get('comments') == '1' || ($item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($item->catid)))) {
	                if ($item->params->get('recaptcha')) {
	                    $document->addScript('http://api.recaptcha.net/js/recaptcha_ajax.js');
	                    $js = 'function showRecaptcha(){
								    Recaptcha.create("'.$item->params->get('recaptcha_public_key').'", "recaptcha", {
								        theme: "clean"
								    });
								}
								window.addEvent(\'load\', function(){
									showRecaptcha();
								})';
	                    $document->addScriptDeclaration($js);
	                }
	                
	                //Auto complete some fields for registered users
	                if (!$user->guest) {
	                    $js = "window.addEvent('domready', function(){
									$('userName').setProperty('value','".$user->name."');
									$('userName').setProperty('disabled','disabled');
									$('commentEmail').setProperty('value','".$user->email."');
									$('commentEmail').setProperty('disabled','disabled');
							
								})";
								
	                    $document->addScriptDeclaration($js);
	                    
	                }
	
	                
	            }
	
	            
	            $limit = $params->get('commentsLimit');
	            $comments = $model->getItemComments($item->id, $limitstart, $limit);
	            
	            for ($i = 0; $i < sizeof($comments); $i++) {
	            	
	            	$comments[$i]->commentText = nl2br($comments[$i]->commentText);
	                $comments[$i]->userImage = K2HelperUtilities::getAvatar($comments[$i]->userID, $comments[$i]->commentEmail, $params->get('commenterImgWidth'));
					if ($comments[$i]->userID>0)
						$comments[$i]->userLink = K2HelperRoute::getUserRoute($comments[$i]->userID);
					else
						$comments[$i]->userLink = $comments[$i]->commentURL;
	            }
	            
	            $item->comments = $comments;
	            
	            jimport('joomla.html.pagination');
	            $total = $item->numOfComments;
	            $pagination = new JPagination($total, $limitstart, $limit);
			}
            
        }
		
        //Author's latest items
        if ($params->get('itemAuthorLatest') && $item->created_by_alias == '') {
            $model = &$this->getModel('itemlist');
            $authorLatestItems = $model->getAuthorLatest($item->id, $params->get('itemAuthorLatestLimit'), $item->created_by);
            if (count($authorLatestItems)) {
                for ($i = 0; $i < sizeof($authorLatestItems); $i++) {
                    $authorLatestItems[$i]->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($authorLatestItems[$i]->id.':'.urlencode($authorLatestItems[$i]->alias), $authorLatestItems[$i]->catid.':'.urlencode($authorLatestItems[$i]->categoryalias))));
                }
                $this->assignRef('authorLatestItems', $authorLatestItems);
            }
        }
        
        //Related items
        if ($params->get('itemRelated') && isset($item->tags) && count($item->tags)) {
            $model = &$this->getModel('itemlist');
            $relatedItems = $model->getRelatedItems($item->id, $item->tags, $params->get('itemRelatedLimit'));
            if (count($relatedItems)) {
                for ($i = 0; $i < sizeof($relatedItems); $i++) {
                    $relatedItems[$i]->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($relatedItems[$i]->id.':'.urlencode($relatedItems[$i]->alias), $relatedItems[$i]->catid.':'.urlencode($relatedItems[$i]->categoryalias))));
                }
                $this->assignRef('relatedItems', $relatedItems);
            }
            
        }
        
        //Navigation (previous and next item)
        if ($params->get('itemNavigation')) {
            $model = &$this->getModel('item');
            
            $nextItem = $model->getNextItem($item->id, $item->catid, $item->ordering);
            if (!is_null($nextItem)) {
                $item->nextLink = urldecode(JRoute::_(K2HelperRoute::getItemRoute($nextItem->id.':'.urlencode($nextItem->alias), $nextItem->catid.':'.urlencode($item->category->alias))));
                $item->nextTitle = $nextItem->title;
            }
            
            $previousItem = $model->getPreviousItem($item->id, $item->catid, $item->ordering);
            if (!is_null($previousItem)) {
                $item->previousLink = urldecode(JRoute::_(K2HelperRoute::getItemRoute($previousItem->id.':'.urlencode($previousItem->alias), $previousItem->catid.':'.urlencode($item->category->alias))));
                $item->previousTitle = $previousItem->title;
            }
            
        }
        
        // Absolute URL
        $uri = &JURI::getInstance();
        $item->absoluteURL = $uri->_uri;
        
        //Email link
        $item->emailLink = JRoute::_('index.php?option=com_mailto&tmpl=component&link='.base64_encode($item->absoluteURL));
        
        //Twitter link
        if ($params->get('itemTwitterLink') && $params->get('twitterUsername')) {
            $itemURLForTwitter = ($params->get('tinyURL')) ? @file_get_contents('http://tinyurl.com/api-create.php?url='.$item->absoluteURL) : $item->absoluteURL;
            $item->twitterURL = 'http://twitter.com/home/?status='.urlencode('Reading @'.$params->get('twitterUsername').' '.$item->title.' '.$itemURLForTwitter);
        }
        
        //Social link
		$item->socialLink = urlencode($item->absoluteURL);

        //Look for template files in component folders
        $this->_addPath('template', JPATH_COMPONENT.DS.'templates');
        $this->_addPath('template', JPATH_COMPONENT.DS.'templates'.DS.'default');
        
        //Look for overrides in template folder (K2 template structure)
        $this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates');        
        $this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates'.DS.'default');
        
        //Look for overrides in template folder (Joomla! template structure)
        $this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'default');
        $this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2');
        
        //Look for specific K2 theme files 
        if ($params->get('theme')) {
            $this->_addPath('template', JPATH_COMPONENT.DS.'templates'.DS.$params->get('theme'));
            $this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates'.DS.$params->get('theme'));       
            $this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.$params->get('theme'));
        }
        
        //Assign data
        $this->assignRef('item', $item);
        $this->assignRef('user', $user);
        $this->assignRef('params', $item->params);
        $this->assignRef('pagination', $pagination);

        
        parent::display($tpl);
    }
    
}
