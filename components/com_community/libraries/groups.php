<?php
/**
 * @category	Library
 * @package		JomSocial
 * @subpackage	Photos 
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class CGroups
{
	static function getActivityContentHTML($act)
	{
		// Ok, the activity could be an upload OR a wall comment. In the future, the content should
		// indicate which is which
		$html = '';
		$param = new JParameter( $act->params );
		$action = $param->get('action' , false);
		CFactory::load('models', 'groups');
		CFactory::load('models', 'discussions');
		
		if( $action == 'group.discussion.create' )
		{
			
			// Old discussion might not have 'action', and we can't display their
			// discussion summary
		
			$topicId = $param->get('topic_id', false);
			if( $topicId ){
				$groupModel		= CFactory::getModel( 'groups' );
				$group			= JTable::getInstance( 'Group' , 'CTable' );
				$discussion		= JTable::getInstance( 'Discussion' , 'CTable' );
				
				$group->load( $act->cid );
				$discussion->load( $topicId );
				
				$topic = strip_tags($discussion->message);
				
				$html  = JString::substr($topic, 0, STREAM_CONTENT_LENGTH);
			} 
						
		}
		
		
		return $html;
	}
}